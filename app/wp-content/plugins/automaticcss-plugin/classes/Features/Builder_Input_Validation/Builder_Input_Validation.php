<?php
/**
 * Automatic.css Builder Input Validation class file.
 *
 * @package Automatic_CSS
 */

namespace Automatic_CSS\Features\Builder_Input_Validation;

use Automatic_CSS\Features\Base;

/**
 * Builder Input Validation class.
 */
class Builder_Input_Validation extends Base {

	/**
	 * Initialize the feature.
	 */
	public function __construct() {
		add_action( 'acss/oxygen/in_builder_context', array( $this, 'enqueue_scripts' ) );
		add_action( 'acss/bricks/in_builder_context', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts for the builder input validation feature.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		$path = '/Builder_Input_Validation/js';
		$filename = 'builder-input-validation.js';
		wp_enqueue_script(
			'builder-input-validation',
			ACSS_FEATURES_URL . "{$path}/{$filename}",
			array(),
			filemtime( ACSS_FEATURES_DIR . "{$path}/{$filename}" ),
			true
		);
	}
}
