<?php

// Найти и уведомить всех пользователей достигших уровня 1-3
function wp_ulike_mailing()
{
	wp_ulike_mailing_level(1);
	wp_ulike_mailing_level(2);
	wp_ulike_mailing_level(3);
}

// Найти и уведомить всех пользователей достигших уровня $level
function wp_ulike_mailing_level( $level ) {
	global $wp_ulike_class;

	$threshold = wp_ulike_get_setting( "wp_ulike_mailing_level_$level", 'top_users_threshold' );
	$step = wp_ulike_get_setting( 'wp_ulike_mailing_level_3', 'top_users_threshold_step' ); // Шаг для уровней выше 3

	// Определяем предел данного уровня
	if ( $level < 3 ) { // Предел уровня - начало следующего
		$cutoff = wp_ulike_get_setting( 'wp_ulike_mailing_level_' . ($level+1), 'top_users_threshold' );
	} else { // Уровень 3 и выше - предел получаем добавляя шаг уровня
		$cutoff = $threshold + $step;
	}

	if ( $threshold ) {
		$top_users = $wp_ulike_class->get_users_we_should_prize( $threshold, $cutoff, $level );
	} else {
		return;
	}

	if ( $top_users ) { // Есть кого уведомлять на этом уровне
		while ( list( $i, $top_user ) = each( $top_users ) ) {
			wp_ulike_prize_user( $top_user->user_id, $top_user->score, $level );
		}
	}
}

// Отправить уведомление выполнив подстановки шаблона
function wp_ulike_prize_user( $user_id, $user_score, $level )
{
	$user_ids = [ $user_id ];

	// Проверяем пользователя по чёрному списку
	$mail_ids = apply_filters( 'wp_ulike_mailing_ids', $user_ids );
	if ( !in_array( $user_id, $mail_ids ) ) { // Пользователь в чёрном списке?
		return;
	}
	// Оставляем только белый список
	$mail_ids = array_diff( $mail_ids, $user_ids );

	$site_url  = get_bloginfo( 'url' );
	$site_name = get_bloginfo( 'name' );
	$site_desc = get_bloginfo( 'description' );

	// Если уровень больше 3 используем настройки уровня 3
	$settings = ( $level < 4 ) ? "wp_ulike_mailing_level_$level" : "wp_ulike_mailing_level_3";

	$user_id    = stripslashes( $user_id );
	$user_score = stripslashes( $user_score );
	$user_info  = get_userdata( $user_id );
	if ( $user_info ) {
		$user_profile = bbp_get_user_profile_url( $user_id ); // url профиля пользователя

		$subject = wp_ulike_get_setting( $settings, 'top_user_mail_subject' );
		$subject = str_replace( [
			'%user_name%',
			'%user_id%',
			'%user_profile%',
			'%user_score%',
			'%user_level%',
			'%site_url%',
			'%site_name%',
		], [
			mb_convert_case( rtrim( $user_info->first_name ), MB_CASE_TITLE, 'UTF-8' ),
			$user_id,
			$user_profile,
			$user_score,
			$level,
			$site_url,
			$site_name,
		], $subject );

		$content = wp_ulike_get_setting( $settings, 'top_user_mail_template' );
		$content = str_replace( [
			'%user_name%',
			'%user_id%',
			'%user_profile%',
			'%user_score%',
			'%user_level%',
			'%site_url%',
			'%site_name%',
		], [
			mb_convert_case( rtrim( $user_info->first_name ), MB_CASE_TITLE, 'UTF-8' ),
			$user_id,
			$user_profile,
			$user_score,
			$level,
			$site_url,
			$site_name,
		], $content );

		$buf = ob_start();
		if ( $buf ) {
			include( plugin_dir_path( __FILE__ ) . 'mail-template.php' ); // Подключаем шаблон
			$mail_body = ob_get_clean();
			if ( $mail_body ) {
				$from = wp_ulike_get_setting( 'wp_ulike_general', 'mail_from' );
				if ( ! $from ) {
					$from = 'noreply@domain.com';
				}
				$headers = [
					'Content-Type: text/html; charset=UTF-8',
					'From: ' . $from
				];
				// Отправляем уведомление пользователю
				if ( wp_mail( $user_info->user_email, $subject, $mail_body, $headers ) ) {
					wp_ulike_mark_mailing_done( $user_id, $level );
				}
				// Отправляем копии по белому списку
				while ( list( $i, $id ) = each( $mail_ids ) ) {
					$user_info  = get_userdata( $id );
					if ( $user_info ) {
						wp_mail( $user_info->user_email, $subject, $mail_body, $headers );
					}
				}
			}
		}
	}
}

// Отметить, что уведомление послано
function wp_ulike_mark_mailing_done( $user_id, $level )
{
	for( ; $level>0; $level-- ) { // Отмечаем уровень и все уровни ниже данного как пройденные
		update_user_meta( $user_id, "_ulike_prized_$level", 'true' );
	}
}

// Фильтр id для рассылки
add_filter( 'wp_ulike_mailing_ids', 'apply_my_subscribers_black_and_white_lists' );
