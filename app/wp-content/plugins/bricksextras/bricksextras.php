<?php
/*
Plugin Name: BricksExtras
Description: Element Library for Bricks.
Version: 1.2.6
Author: BricksExtras
Author URI: https://bricksextras.com
*/

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

if ( ! defined( 'BRICKSEXTRAS_BASE' ) ) {
	define( 'BRICKSEXTRAS_BASE', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'BRICKSEXTRAS_PATH' ) ) {
	define( 'BRICKSEXTRAS_PATH', plugin_dir_path(__FILE__) );
}

if ( ! defined( 'BRICKSEXTRAS_URL' ) ) {
	define( 'BRICKSEXTRAS_URL', plugin_dir_url(__FILE__) );
}

require dirname( __FILE__ ) . '/includes/Plugin.php';
new BricksExtras\Plugin();