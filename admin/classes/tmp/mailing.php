<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$wp_ulike_mailing_levels = [];

/*******************************************************
     mailing level 1 Settings
*******************************************************/

$wp_ulike_mailing_levels[1] = [
	'title'  			=> '<i class="dashicons-before"></i>' . ' ' . __( 'Mailing Level 1',WP_ULIKE_SLUG ),
	'fields' 	=> [
		'top_users_threshold' => [
			'type'  		=> 'number',
			'default'		=> 5,
			'label' 		=> __( 'Likes threshold for top users', WP_ULIKE_SLUG),
			'description'	=> __('Number of likes collected by user to be recognized as a top user', WP_ULIKE_SLUG),
		],
		'top_user_mail_subject' => [
			'type'  		=> 'text',
			'default'		=> 'You have scored %user_score% likes',
			'label' 		=> __('Mail subject', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%site_url%</code> <code>%site_name%</code>',
		],
		'top_user_mail_template' => [
			'type'  		=> 'textarea',
			'default'		=> '',
			'label' 		=> __('Mail content', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%site_url%</code> <code>%site_name%</code>',
			'attributes'	=> ['rows' => 10],
		],
	]
];

/*******************************************************
     mailing level 2 Settings
*******************************************************/

$wp_ulike_mailing_levels[2] = [
	'title'  			=> '<i class="dashicons-before"></i>' . ' ' . __( 'Mailing Level 2',WP_ULIKE_SLUG ),
	'fields' 	=> [
		'top_users_threshold' => [
			'type'  		=> 'number',
			'default'		=> 10,
			'label' 		=> __( 'Likes threshold for top users', WP_ULIKE_SLUG),
			'description'	=> __('Number of likes collected by user to be recognized as a top user', WP_ULIKE_SLUG),
		],
		'top_user_mail_subject' => [
			'type'  		=> 'text',
			'default'		=> 'You have scored %user_score% likes',
			'label' 		=> __('Mail subject', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%site_url%</code> <code>%site_name%</code>',
		],
		'top_user_mail_template' => [
			'type'  		=> 'textarea',
			'default'		=> '',
			'label' 		=> __('Mail content', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%site_url%</code> <code>%site_name%</code>',
			'attributes'	=> ['rows' => 10],
		],
	]
];


/*******************************************************
     mailing level 3 Settings
*******************************************************/

$wp_ulike_mailing_levels[3] = [
	'title'  			=> '<i class="dashicons-before"></i>' . ' ' . __( 'Mailing Level 3',WP_ULIKE_SLUG ),
	'fields' 	=> [
		'top_users_threshold' => [
			'type'  		=> 'number',
			'default'		=> 20,
			'label' 		=> __( 'Likes threshold for top users', WP_ULIKE_SLUG),
			'description'	=> __('Number of likes collected by user to be recognized as a top user', WP_ULIKE_SLUG),
		],
		'top_user_mail_subject' => [
			'type'  		=> 'text',
			'default'		=> 'You have scored %user_score% likes',
			'label' 		=> __('Mail subject', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%user_level%</code> <code>%site_url%</code> <code>%site_name%</code>',
		],
		'top_user_mail_template' => [
			'type'  		=> 'textarea',
			'default'		=> '',
			'label' 		=> __('Mail content', WP_ULIKE_SLUG),
			'description' 	=> __('Allowed Variables:', WP_ULIKE_SLUG) . ' <code>%user_name%</code> <code>%user_id%</code> <code>%user_profile%</code> <code>%user_score%</code> <code>%user_level%</code> <code>%site_url%</code> <code>%site_name%</code>',
			'attributes'	=> ['rows' => 10],
		],
	]
];
