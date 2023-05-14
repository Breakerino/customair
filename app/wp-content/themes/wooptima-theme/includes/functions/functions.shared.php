<?php

/* ----------------------------------------------------------------------------------------
 * Functions
 * ----------------------------------------------------------------------------------------
 * @enviroment	production
 * @version			1.0.0
 * @updated 		11/08/2022
 * ----------------------------------------------------------------------------------------
 */

defined('ABSPATH') || exit;

/**
 * ----------------------------------------------------------------------------------------
 * [FUNCTIONALITY_NAME]
 * ----------------------------------------------------------------------------------------
 * @author [AUTHOR]
 * @version [VERSION]
 * @updated 11/08/2022
 * @status [STATUS]
 * ----------------------------------------------------------------------------------------
 * @return void
 * ----------------------------------------------------------------------------------------
 */
// function wa_theme_sample_function() {}

// add_action('wa_theme_sample_action_hook', 'wa_theme_sample_function');

/**
 * ----------------------------------------------------------------------
 * [FUNCTIONALITY_NAME]
 * ----------------------------------------------------------------------
 * @author [AUTHOR]
 * @version [VERSION]
 * @updated 11/08/2022
 * @status [STATUS]
 * ----------------------------------------------------------------------
 */
//wa_add_filter('wa_theme_sample_filter_hook', ['value' => 'sample_value']);

/**
 * ----------------------------------------------------------------------
 * Disable zoom scale on mobile devices
 * ----------------------------------------------------------------------
 */
//function lit_change_viewport() {
//	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">';
//}

// NOTE: Adjust in header.php
//add_action('wp_head', 'lit_change_viewport');

add_filter('rank_math/sitemap/remove_credit', '__return_true');
add_filter('rank_math/link/remove_class', '__return_true');

function wa_shortcode_template_view($atts) {
	$atts = shortcode_atts([
		'id' => null,
		'data' => []
	], $atts);

	if (empty($atts['id'])) {
		return null;
	}

	$templateViewPath = sprintf('%s/includes/views/%s.php', WA_BASE_PATH, $atts['id']);

	if (!file_exists($templateViewPath)) {
		return '** BLOCK NOT FOUND **';
	}

	//
	$data = $atts['data'];

	return (function () use ($data, $templateViewPath) {
		ob_start();
		include $templateViewPath;
		return ob_get_clean();
	})();
}

add_shortcode('wooptima-block', 'wa_shortcode_template_view');

/**
 * Unregister some of Bricks features
 *
 * @return void
 */
function wa_handle_unregister_bricks_features() {
	if (!class_exists('\Bricks\Theme')) {
		return;
	}

	$bricksTheme = \Bricks\Theme::instance();

	if ($bricksTheme->frontend instanceof \Bricks\Frontend) {
		remove_action('bricks_after_site_wrapper', [$bricksTheme->frontend, 'add_photoswipe_html']);
	}
}

add_action('init', 'wa_handle_unregister_bricks_features');