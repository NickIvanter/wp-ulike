<?php

	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) ) exit;

	/*******************************************************
     mailing Settings
	*******************************************************/

	$wp_ulike_mailing	= array();
	// if (function_exists('is_bbpress')){
	$wp_ulike_mailing	= array(
		'title'  			=> '<i class="dashicons-before"></i>' . ' ' . __( 'Mailing',WP_ULIKE_SLUG ),
		'fields' 	=> array(
		  'top_users_threshold' => array(
			'type'  		=> 'number',
			'default'		=> 100,
			'label' 		=> __( 'Likes threshold for top users', WP_ULIKE_SLUG),
			'description'	=> __('Number of likes collected by user to be recognized as a top user', WP_ULIKE_SLUG)
		  ),
		  'top_user_mail_subject'  => array(
			'type'  		=> 'text',
			'default'		=> 'You have scored %user_score% likes',
			'label' 		=> __('Mail subject', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%site_url%</code> <code>%site_name%</code>',
		  ),
		  'top_user_mail_template'  => array(
			'type'  		=> 'textarea',
			'default'		=> '',
			'label' 		=> __('Mail content', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%site_url%</code> <code>%site_name%</code>',
			'attributes'	=> ['rows' => 10],
		  ),
		)
	  );//end wp_ulike_buddypress
	// }