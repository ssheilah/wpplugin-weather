<?php
/*
Plugin Name: WSUWP Weather
Version: 0.0.1
Description: A WordPress plugin to insert local weather conditions using shortcode.
Author: washingtonstateuniversity, ssheilah
Author URI: https://web.wsu.edu/
Plugin URI: https://github.com/ssheilah/wpplugin-weather
Text Domain: [Plugin Text Domain]
Domain Path: /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// The core plugin class.
require dirname( __FILE__ ) . '/includes/class-wsuwp-weather.php';

add_action( 'after_setup_theme', 'WSUWP_Weather' );
/**
 * Start things up.
 *
 * @return \WSUWP_Weather
 */
function WSUWP_Weather() {
	return WSUWP_Weather::get_instance();
}