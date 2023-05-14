<?php

defined('ABSPATH') || exit;

/**
 * ----------------------------------------------------------------
 * Constants
 * ----------------------------------------------------------------
 */
define('WA_SCORG_SYNC_CODE_BLOCK_ACTION_NAME', 'wa_scorg_sync_code_block');

/**
 * ----------------------------------------------------------------
 * Hooks
 * ----------------------------------------------------------------
 */
add_action('admin_post_' . WA_SCORG_SYNC_CODE_BLOCK_ACTION_NAME, 'wa_handle_sync_scorg_code_block');
add_action('admin_post_nopriv_' . WA_SCORG_SYNC_CODE_BLOCK_ACTION_NAME, 'wa_handle_sync_scorg_code_block');

/**
 * ----------------------------------------------------------------
 * Functions
 * ----------------------------------------------------------------
 */
function wa_scorg_clean_scss_file_from_imports($partials, $code){
	if(is_array($partials) && count($partials) > 0){
		$code = str_replace($partials, '', $code);
	}

	return $code;
}

function wa_scorg_sync_scss_code_block($codeBlockID){
	$post_id = $codeBlockID;
	$SCORG_partials = get_post_meta($post_id, 'SCORG_partials');
	$partials = array();
	if(is_array($SCORG_partials)){
		foreach($SCORG_partials as $partial){
			$editor_scss_file = SCORG_UPLOADS_DIR_SCSS.'/_'.$partial.'.scss';
			if(file_exists($editor_scss_file)){
				$partials[] = "@import '_".$partial.".scss'; \n";
				$editor_scss = file_get_contents($editor_scss_file);
				update_post_meta($post_id, 'SCSS_scss_scripts', base64_encode($editor_scss));
			}
		}
	}
	$SCORG_header_mode = get_post_meta($post_id, 'SCORG_header_mode', true);
	$SCORG_footer_mode = get_post_meta($post_id, 'SCORG_footer_mode', true);
	switch($SCORG_header_mode){
		case 'scss';
			$header_scss_file = SCORG_UPLOADS_DIR_SCSS.'/'.$post_id.'-header.scss';
			if(file_exists($header_scss_file)){
				$header_code = wa_scorg_clean_scss_file_from_imports($partials, file_get_contents($header_scss_file));
				update_post_meta($post_id, 'SCORG_header_script', base64_encode($header_code));
			}
			break;
		case 'css';
			$header_css_file = SCORG_UPLOADS_DIR_CSS.'/'.$post_id.'-header.css';
			if(file_exists($header_css_file)){
				$header_code = file_get_contents($header_css_file);
				update_post_meta($post_id, 'SCORG_header_script', base64_encode($header_code));
			}
			break;
		case 'javascript';
			$header_js_file = SCORG_UPLOADS_DIR_JS.'/'.$post_id.'-header.js';
			if(file_exists($header_js_file)){
				$header_code = file_get_contents($header_js_file);
				update_post_meta($post_id, 'SCORG_header_script', base64_encode($header_code));
			}
			break;
	}

	switch($SCORG_footer_mode){
		case 'scss';
			$footer_scss_file = SCORG_UPLOADS_DIR_SCSS.'/'.$post_id.'-footer.scss';
			if(file_exists($footer_scss_file)){
				$footer_code = wa_scorg_clean_scss_file_from_imports($partials, file_get_contents($footer_scss_file));
				update_post_meta($post_id, 'SCORG_footer_script', base64_encode($footer_code));
			}
			break;
		case 'css';
			$footer_css_file = SCORG_UPLOADS_DIR_CSS.'/'.$post_id.'-footer.css';
			if(file_exists($footer_css_file)){
				$footer_code = file_get_contents($footer_css_file);
				update_post_meta($post_id, 'SCORG_footer_script', base64_encode($footer_code));
			}
			break;
		case 'javascript';
			$footer_js_file = SCORG_UPLOADS_DIR_JS.'/'.$post_id.'-footer.js';
			if(file_exists($footer_js_file)){
				$footer_code = file_get_contents($footer_js_file);
				update_post_meta($post_id, 'SCORG_footer_script', base64_encode($footer_code));
			}
			break;
	}

	$php_script_file = SCORG_UPLOADS_DIR.'/'.$post_id.'.php';
	if(file_exists($php_script_file)){
		$php_script = file_get_contents($php_script_file);
		$php_script = str_replace("<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>", "", $php_script);
		update_post_meta($post_id, 'SCORG_php_script', base64_encode($php_script));
	}
	
	return 'done';
}

function wa_scorg_regenerate_code_block_scripts($codeBlockID) {
	$header_script = SCORG_is_base64(get_post_meta($codeBlockID, 'SCORG_header_script', true));
	$footer_script = SCORG_is_base64(get_post_meta($codeBlockID, 'SCORG_footer_script', true));
	$params = array(
		'SCORG_header_mode' => get_post_meta($codeBlockID, 'SCORG_header_mode', true),
		'SCORG_footer_mode' => get_post_meta($codeBlockID, 'SCORG_footer_mode', true)
	);
	
	//SCORG_create_SCSS_file_on_load($codeBlockID, 'header');
	$result = SCORG_create_header_footer_file($codeBlockID, $header_script, $footer_script, $params, false);
	return empty($result) ? 'done' : $result;
}

/**
 * ----------------------------------------------------------------
 * Handler
 * ----------------------------------------------------------------
 */
/**
 * Bulk processor
 *
 * @return void
 */
function wa_handle_sync_scorg_code_block() {
	if ( ! isset($_GET['code_block_id']) || ! isset($_GET['code_block_type'])) {
		echo 'skipping...';
		return;
	}
	
	
	$codeBlockID = $_GET['code_block_id'];
	$codeBlockType = $_GET['code_block_type'];
	
	echo sprintf('processing block #%s: %s', $codeBlockID, $codeBlockType) . '<br>';
	
	switch ($codeBlockType) {
		case 'scss':
			echo 'sync result: ' . wa_scorg_sync_scss_code_block($codeBlockID) . '<br>';
			echo 'regenerate result: ' . wa_scorg_regenerate_code_block_scripts($codeBlockID) . '<br>';
			break;
	}
}