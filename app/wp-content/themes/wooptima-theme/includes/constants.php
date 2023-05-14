<?php

/**
 * ----------------------------------------------------------------------------------------
 * Wooptima Theme
 * ----------------------------------------------------------------------------------------
 * @version				1.0.0
 * @updated 			09/02/2023
 * @textdomain		wooptima-theme
 * ----------------------------------------------------------------------------------------
 */

defined('ABSPATH') || exit;

/**
 * ----------------------------------------------------------------------------------------
 * Constants
 * ----------------------------------------------------------------------------------------
 */

// TODO: Move to root

# Site
define('WA_SITE_LOCALE', 'sk');
define('WA_SITE_ENV', 'development');
define('WA_SITE_ID', 'customair');
define('WA_SITE_NAME', 'customair.eu');
define('WA_SITE_VERSION', '1.0.0');

# Helpers
define('WA_ACTIVE_HELPERS', [
	'wa-functions',
	'wp-functions',
	'bricks-functions'
]);

# Modules
define('WA_ACTIVE_MODULES', [
	'scorg-code-block-sync'
]);