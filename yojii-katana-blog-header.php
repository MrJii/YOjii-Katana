<?php
/**
 * Loads the yojii-katana environment and template.
 *
 * @package yojii-katana
 */

if ( !isset($wp_did_header) ) {

	$wp_did_header = true;

	require_once( dirname(__FILE__) . '/yojii-katana-load.php' );

	wp();

	require_once( ABSPATH . WPINC . '/template-loader.php' );

}
