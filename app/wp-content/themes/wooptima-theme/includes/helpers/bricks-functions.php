<?php

/* ----------------------------------------------------------------------------------------
 * Bricks Functions
 * ----------------------------------------------------------------------------------------
 * @enviroment	production
 * @version			1.0.0
 * @updated 		09/02/2023
 * ----------------------------------------------------------------------------------------
 */

defined('ABSPATH') || exit;

define('WA_SOCIAL_SITES', [
	'facebook',
	'instagram',
	'linkedin',
	'twitter',
	'youtube',
	'pinterest'
]);

define('WA_SITE_SETTINGS_ID', 'wooptima_settings');
define('WA_SITE_SOCIAL_META_PREFIX', 'wa_settings_');


function wa_get_site_setting($key) {
	return rwmb_meta($key, ['object_type' => 'setting'], WA_SITE_SETTINGS_ID);
}

/**
 * Bricks helper function for mapping meta value
 * to truthy/falsy value
 * 
 * @param string $field (meta key)
 * @param string $truthy (return value if meta value is truthy)
 * @param string $falsy (return value if meta value is truthy)
 * @param string $source (post,term,setting)
 * @param string $object (post_id,term_id,settings_page_id)
 * @return string
 */
function wa_bricks_get_ternary_field_value($field, $truthy, $falsy, $source = 'post', $object = null) {
	if ( ! function_exists('rwmb_meta') ) {
		return null;
	}
	
	$value = rwmb_meta($field, ['object_type' => in_array($source, ['post', 'term', 'user', 'setting']) ? $source : 'post'], $object);
	
	return (bool) $value ? $truthy : $falsy;
}