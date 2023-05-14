<?php

/* ----------------------------------------------------------------------------------------
 * WordPress Functions
 * ----------------------------------------------------------------------------------------
 * @enviroment	production
 * @version			1.0.0
 * @updated 11/08/2022
 * ----------------------------------------------------------------------------------------
 */

defined('ABSPATH') || exit;

/**
 * ----------------------------------------------------------------------------------------
 * Get user roles list
 * ----------------------------------------------------------------------------------------
 * @author Matúš Mendel
 * @version		1.0.0
 * @updated 11/08/2022
 * ----------------------------------------------------------------------------------------
 * @return array
 * ----------------------------------------------------------------------------------------
 */
function wa_get_user_roles_list() {
	$editableRoles = \get_editable_roles();
	$userRoles = [];

	foreach ($editableRoles as $role => $data) {
		$userRole = \esc_attr($role);
		$userRoles[$userRole] = \translate_user_role($data['name']);
	}
	
	return $userRoles;
}

/**
 * ----------------------------------------------------------------------------------------
 * Get uploads base dir, returns baseDir by default
 * ----------------------------------------------------------------------------------------
 * @author Matúš Mendel
 * @version		1.0.0
 * @updated 11/08/2022
 * ----------------------------------------------------------------------------------------
 * @return string
 * ----------------------------------------------------------------------------------------
 */
function wa_get_uploads_dir($prop = 'basedir') {
	$uploadsDir = \wp_get_upload_dir();
	return array_key_exists($prop, $uploadsDir) ? $uploadsDir[$prop] : $uploadsDir['basedir'];
}

/**
 * ----------------------------------------------------------------------------------------
 * Check if current user is certain role
 * ----------------------------------------------------------------------------------------
 * @author Matúš Mendel
 * @version		1.0.0
 * @updated 11/08/2022
 * ----------------------------------------------------------------------------------------
 * @param string $role
 * @return string
 * ----------------------------------------------------------------------------------------
 */
function wa_is_user_a(string $role) {
	if ( ! \is_user_logged_in() ) {
		return false;
	}
	$currentUser = \wp_get_current_user();
	return in_array($role, $currentUser->roles);
}