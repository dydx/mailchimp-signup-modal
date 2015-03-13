<?php

	/**
	 * Plugin Name: MailChimp Signup Modal
	 * Plugin URI: http://github.com/dydx/mailchimp-signup-modal
	 * Description: Timed popup for MailChimp signup boxes
	 * Version: 0.1
	 * Author: Joshua Sandlin
	 * Author URI: http://thenullbyte.org
	 * License: GPLv2
	 */

	define( "VERSION", "0.1" );

	register_activation_hook( __FILE__, 
		'mcsm_set_default_options' );

	function mcsm_set_default_options() {
		if( get_option( 'mcsm_options' ) === false ) {
			$new_options['mcsm_mailchimp_popup_code'] = '';
			$new_options['version'] = VERSION;
			add_option( 'mcsm_options', $new_options );
		}
	}

	add_action( 'admin_init', 'mcsm_admin_init' );

	/**
	 * Register settings and whatnot
	 */
	function mcsm_admin_init() {
		register_setting( 'mcsm_settings',
			'mcsm_options', 'mcsm_validate_options'); 

		add_settings_section( 'mcsm_main_section',
			'Main Settings',
			'mcsm_main_settings_section_callback',
			'mcsm_settings_section'
		);

		add_settings_field( 'mcsm_mailchimp_popup_code', 'Popup Code',
			'mcsm_display_text_box',
			'mcsm_settings_section',
			'mcsm_main_section',
			array( 'name' => 'mcsm_mailchimp_popup_code')
		);
	}

	function mcsm_validate_options( $input ) {
		$input['version'] = VERSION;
		return $input;
	}

	/**
	 * create admin settings menu and page form
	 */
	function mcsm_main_settings_section_callback() {
		require_once( __DIR__ . '/pages/main_settings_section_callback.php' );
	}

	function mcsm_display_text_box( $data = array() ) {
		extract( $data );
		$options = get_option( 'mcsm_options' );
		require_once( __DIR__ . '/pages/display_text_box.php' );
	}

	add_action( 'admin_menu', 'mcsm_settings_menu' );

	function mcsm_settings_menu() {
		add_options_page( 'MailChimp Popup Box Configuration',
			'MailChimp Popup',
			'manage_options',
			'mailchimp-popup-box-configuration',
			'mcsm_config_page'
		);
	}

	function mcsm_config_page() {
		require_once( __DIR__ . '/pages/config_page.php' );
	}

	/**
	 * render bits that get put onto the front-end
	 */
	add_action( 'wp_head', 'mcsm_header_output' );

	function mcsm_header_output() {
		$options = get_option( 'mcsm_options' );
		echo $options['mcsm_mailchimp_popup_code'];
	}

?>