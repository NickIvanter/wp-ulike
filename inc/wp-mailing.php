<?php

function wp_ulike_mailing() {
	global $wp_ulike_class;

	$threshold = wp_ulike_get_setting( 'wp_ulike_mailing', 'top_users_threshold' );
	if ( $threshold ) {
		$top_users = $wp_ulike_class->get_users_we_should_prize( $threshold );
	} else {
		return;
	}

	$site_url  = get_bloginfo( 'url' );
	$site_name = get_bloginfo( 'name' );
	$site_desc = get_bloginfo( 'description' );
	if ( $top_users ) {
		while ( list( $i, $top_user ) = each( $top_users ) ) {
			$user_id    = stripslashes( $top_user->user_id );
			$user_score = stripslashes( $top_user->score );
			$user_info  = get_userdata( $user_id );
			if ( $user_info ) {
				$user_profile = bbp_get_user_profile_url( $user_id );

				$subject = wp_ulike_get_setting( 'wp_ulike_mailing', 'top_user_mail_subject' );
				$subject = str_replace( [
					'%user_name%',
					'%user_id%',
					'%user_profile%',
					'%user_score%',
					'%site_url%',
					'%site_name%',
				], [
					$user_info->display_name,
					$user_id,
					$user_profile,
					$user_score,
					$site_url,
					$site_name,
				], $subject );

				$content = wp_ulike_get_setting( 'wp_ulike_mailing', 'top_user_mail_template' );
				$content = str_replace( [
					'%user_name%',
					'%user_id%',
					'%user_profile%',
					'%user_score%',
					'%site_url%',
					'%site_name%',
				], [
					$user_info->display_name,
					$user_id,
					$user_profile,
					$user_score,
					$site_url,
					$site_name,
				], $content );

				$buf = ob_start();
				if ( $buf ) {
					include( plugin_dir_path( __FILE__ ) . 'mail-template.php' );
					$mail_body = ob_get_clean();
					if ( $mail_body ) {
						$headers = [
							'Content-Type: text/html; charset=UTF-8',
						];
						if ( wp_mail( $user_info->user_email, $subject, $mail_body, $headers ) ) {
							wp_ulike_mark_mailing_done( $user_id );
						}
					}
				}
			}
		}
	}
}

function wp_ulike_mark_mailing_done( $user_id ) {
	update_user_meta( $user_id, '_ulike_prized', 'true' );
}
