<?php

namespace BricksExtras;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Helpers {

	/*
     Get most relavent setting from template settings or overriding page settings currently active
    */
	public static function getCurrentTemplateSetting( $key,$default = false) {

		$headerSetting = \Bricks\Templates::get_templates_by_type( 'header' ) ? \Bricks\Helpers::get_template_setting( $key, \Bricks\Templates::get_templates_by_type( 'header' )[0] ) : false;
		$contentSetting = \Bricks\Database::$active_templates[ 'content' ] ? \Bricks\Helpers::get_template_setting( $key, \Bricks\Database::$active_templates[ 'content' ] ) : false;
		$pageSetting = isset( \Bricks\Database::$page_settings[$key] ) ? \Bricks\Database::$page_settings[$key] : false;

        if ( !!$pageSetting ) {
			return $pageSetting;
		} elseif ( !!$contentSetting ) {
			return $contentSetting;
		} elseif ( !!$headerSetting ) {
			return $headerSetting;
		} else {
			return $default;
		}
		
	}


	/* 
	 Get looping parent query Id by level - https://itchycode.com/bricks-builder-useful-functions-and-tips/
	*/
	public static function get_bricks_looping_parent_query_id_by_level( $level = 1 ) {
		
		global $bricks_loop_query;
	
		if ( empty( $bricks_loop_query ) || $level < 1 ) {
			return false;
		}
	
		$current_query_id = \Bricks\Query::is_any_looping();
		
		if ( !$current_query_id ) { 
			return false;
		}
		
		if ( !isset( $bricks_loop_query[ $current_query_id ] ) ) {
			return false;
		}
	
		$query_ids = array_reverse( array_keys( $bricks_loop_query ) );
	
		if ( !isset( $query_ids[ $level ] )) {
			return false;
		}
	
		if ( $bricks_loop_query[ $query_ids[ $level ] ]->is_looping ) {
			return $query_ids[ $level ];
		}
	
		return false;
	}


	/* 
	 True if we are viewing inside builder
	*/
	public static function maybePreview() {

		$builder = isset( $_GET["bricks"] ) ? strstr( $_GET["bricks"], 'run' ) : false;
		$referrer = isset( $_SERVER['HTTP_REFERER'] ) ? strstr( $_SERVER['HTTP_REFERER'], 'brickspreview' ) : false;

		return ( $builder || $referrer );
	}


	/* 
	 Create CSS settings
	*/
	public static function doCSSRules($property, array $selectors) {

		$output = [];

		foreach( $selectors as $selector ) {
			$output[] = [
				'property' => $property,
				'selector' => $selector, 
			];
		}

		return $output;
	}
	

}
