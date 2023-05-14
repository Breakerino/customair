<?php

/**
 * ----------------------------------------------------------------------------------------
 * Wooptima Theme | Boostrap
 * ----------------------------------------------------------------------------------------
 * @enviroment		development
 * @version				1.0.0
 * @updated 			11/08/2022
 * @textdomain		wooptima-theme
 * ----------------------------------------------------------------------------------------
 */

defined('ABSPATH') || exit;

/**
 * ----------------------------------------------------------------------------------------
 * Config
 * ----------------------------------------------------------------------------------------
 */

# Environment config
require_once sprintf('%s/config/config.%s.php', __DIR__, 'shared');
//require_once sprintf('%s/config/config.%s.php', __DIR__, WA_SITE_ID);

/**
 * ----------------------------------------------------------------------------------------
 * Functions
 * ----------------------------------------------------------------------------------------
 */

# Load active helpers
foreach (WA_ACTIVE_HELPERS as $helperFile) {
	require_once sprintf('%s/helpers/%s.php', __DIR__, $helperFile);
}

# Enviroment functions
//require_once sprintf('%s/functions/functions.%s.php', __DIR__, WA_SITE_ENV);
require_once sprintf('%s/functions/functions.%s.php', __DIR__, 'shared');

/**
 * ----------------------------------------------------------------------------------------
 * Modules
 * ----------------------------------------------------------------------------------------
 */

# Load active modules
foreach (WA_ACTIVE_MODULES as $moduleFile) {
	require_once sprintf('%s/modules/%s.php', __DIR__, $moduleFile);
}

/**
 * ----------------------------------------------------------------------------------------
 * Translations
 * ----------------------------------------------------------------------------------------
 */

# Load theme text domain
function wa_load_child_theme_textdomain() {
	load_child_theme_textdomain('wooptima-theme', get_stylesheet_directory() . '/languages');
}

add_action('after_setup_theme', 'wa_load_child_theme_textdomain');