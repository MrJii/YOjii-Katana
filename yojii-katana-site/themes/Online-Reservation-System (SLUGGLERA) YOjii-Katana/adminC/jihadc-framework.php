<?php
/**
 * JihadC Framework
 *
 * @package   JihadC Framework
 * @author    YO Jii <saaduddinj@gmail.com>
 * @license   GPL-2.0+
 * @link      https://github.com/MrJii?tab=activity
 * @copyright 2014-2016 YOjii
 *
 * @wordpress-plugin
 * Plugin Name: JihadC Framework
 * Plugin URI:  https://github.com/MrJii?tab=activity
 * Description: A framework for designing options.
 * Version:     1.8.0
 * Author:      YO Jii
 * Author URI:  https://github.com/MrJii?tab=activity
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: jihadcframework
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Don't load if jihadcframework_init is already defined
if (is_admin() && ! function_exists( 'jihadcframework_init' ) ) :

function jihadcframework_init() {

	//  If user can't edit theme options, exit
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	// Loads the required JihadC Framework classes.
	require plugin_dir_path( __FILE__ ) . 'includes/class-jihadc-framework.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-jihadc-framework-admin.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-jihadc-interface.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-jihadc-media-uploader.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-jihadc-sanitization.php';

	// Instantiate the main plugin class.
	$jihadc_framework = new jihadc_Framework;

	// Instantiate the options page.
	$jihadc_framework_admin = new jihadc_Framework_Admin;
	$jihadc_framework_admin->init();

	// Instantiate the media uploader class
	$jihadc_framework_media_uploader = new jihadc_Framework_Media_Uploader;
	$jihadc_framework_media_uploader->init();

}

add_action( 'init', 'jihadc_framework_init', 20 );

endif;


/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if ( ! function_exists( 'of_get_option' ) ) :
function of_get_option( $name, $default = false ) {

	$option_name = '';

	// Gets option name as defined in the theme
	if ( function_exists( 'jihadcframework_option_name' ) ) {
		$option_name = jihadcframework_option_name();
	}

	// Fallback option name
	if ( '' == $option_name ) {
		$option_name = get_option( 'stylesheet' );
		$option_name = preg_replace( "/\W/", "_", strtolower( $name ) );
	}

	// Get option settings from database
	$options = get_option( $option_name );

	// Return specific option
	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}
endif;