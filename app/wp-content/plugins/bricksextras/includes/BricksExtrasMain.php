<?php

namespace BricksExtras;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( class_exists( 'BricksExtrasMain' ) ) {
	return;
}

if ( ! class_exists( 'BricksExtrasInteractive' ) ) {
	require_once 'BricksExtrasInteractive.php';
}

if ( ! class_exists( 'BricksExtrasHeaderExtras' ) ) {
	require_once 'BricksExtrasHeaderExtras.php';
}



if ( ! class_exists( 'BricksExtrasHelpers' ) ) {
	require_once 'BricksExtrasHelpers.php';
}

if ( ! class_exists( 'BricksExtrasProviders' ) ) {
	require_once 'Providers/BricksExtrasProviders.php';
	require_once 'Providers/Provider_Extras.php';
}

class BricksExtrasMain {
	public $elements = array();
	public $prefix = '';
	public $version= '';

	/**
	 * Main class constructor
	 */
	public function __construct( $prefix, $version ) {
		if ( true !== BricksExtrasLicense::is_activated_license() ) {
			return;
		}

		$this->prefix = $prefix;
		$this->version = $version;

		$this->set_files();

		add_action( 'admin_init', array( $this, 'register_options' ) );

		add_action( $this->prefix . 'form_options', array( $this, 'options_form' ) );

		if ( !class_exists("\Bricks\Elements") || !get_option( $this->prefix . 'license_key' ) ) { 
			return;
		}

		$this->load_files();

		if ( bricks_is_frontend() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'conditional_default_CSS' ) );

			// frontend Scripts
			add_action( 'bricks_after_footer', array( $this, 'frontend_scripts' ), 200 );
		}

		if ( bricks_is_builder_main() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'builder_scripts' ) );
		}

		if ( get_option( $this->prefix . 'header_row') ) {
			(new HeaderExtras())->init();
		}
		

	}

	function sanitize_enable( $enable ) {

		if ( is_numeric( $enable ) && intval( $enable ) === 1 ) {
			return 1;
		}

		return 0; // default
	}

	function set_files() {
		$this->elements = [
			'back_to_top' => [
				'title' => 'Back to Top',
				'file_name' => 'x-back-to-top',
				'docs_slug' => 'back-to-top'
			],
			'before_after_image' => [
				'title' => 'Before / After Image',
				'file_name' => 'x-before-after-image',
				'docs_slug' => 'before-after-image'
			],
			'burger_trigger' => [
				'title' => 'Burger Trigger',
				'file_name' => 'x-burger-trigger',
				'docs_slug' => 'burger-trigger'
			],
			'content_switcher' =>[
				'title' => 'Content Switcher',
				'file_name' => 'x-content-switcher',
				'docs_slug' => 'content-switcher'
			],
			'content_timeline' => [
				'title' => 'Content Timeline',
				'file_name' => 'x-content-timeline',
				'docs_slug' => 'content-timeline'
			],
			'dynamic_chart' => [
				'title' => 'Dynamic Chart',
				'file_name' => 'x-dynamic-chart',
				'docs_slug' => 'dynamic-chart'
			],
			'dynamic_lightbox' => [
				'title' => 'Dynamic Lightbox',
				'file_name' => 'x-dynamic-lightbox',
				'docs_slug' => 'dynamic-lightbox'
			],
			'dynamic_table' => [
				'title' => 'Dynamic Table',
				'file_name' => 'x-dynamic-table',
				'docs_slug' => 'dynamic-table'
			],
			/*
			'dynamic_tabs' => [
				'title' => 'Dynamic Tabs',
				'file_name' => 'x-dynamic-tabs',
				'docs_slug' => 'dynamic-tabs'
			],
			*/
			'countdown' =>[
				'title' => 'Evergreen Countdown',
				'file_name' => 'x-countdown',
				'docs_slug' => 'evergreen-countdown'
			],
			'fluent_form' => [
				'title' => 'Fluent Form',
				'file_name' => 'x-fluent-form',
				'docs_slug' => 'fluent-form'
			],
			'notification_bar' =>[
				'title' => 'Header Notification Bar',
				'file_name' => 'x-notification-bar',
				'docs_slug' => 'header-notification-bar'
			],
			'header_row' => [
				'title' => 'Header Extras / Rows',
				'file_name' => 'x-header-row',
				'docs_slug' => 'header-extras'
			],
			'header_search' => [
				'title' => 'Header Search',
				'file_name' => 'x-header-search',
				'docs_slug' => 'header-search'
			],
			'image_hotspots' => [
				'title' => 'Image Hotspots',
				'file_name' => 'x-image-hotspots',
				'docs_slug' => 'image-hotspots'
			],
			'interactive_cursor' => [
				'title' => 'Interactive Cursor',
				'file_name' => 'x-interactive-cursor',
				'docs_slug' => 'interactive-cursor'
			],
			'lottie' =>[
				'title' => 'Lottie',
				'file_name' => 'x-lottie',
				'docs_slug' => 'lottie',
			],
			'pro_modal' =>[
				'title' => 'Modal (template)',
				'file_name' => 'x-pro-modal',
				'docs_slug' => 'modal'
			],
			'pro_modal_nestable' =>[
				'title' => 'Modal',
				'file_name' => 'x-pro-modal-nestable',
				'docs_slug' => 'modal',
				'stylesheet' => 'promodal'
			],
			'offcanvas' =>[
				'title' => 'Offcanvas (template)',
				'file_name' => 'x-offcanvas',
				'docs_slug' => 'offcanvas'
			],
			'offcanvas_nestable' =>[
				'title' => 'Offcanvas',
				'file_name' => 'x-offcanvas-nestable',
				'docs_slug' => 'offcanvas',
				'stylesheet' => 'offcanvas'
			],
			'popover' =>[
				'title' => 'Popover / Tooltips',
				'file_name' => 'x-popover',
				'docs_slug' => 'popovers-tooltips'
			],
			'pro_accordion' =>[
				'title' => 'Pro Accordion',
				'file_name' => 'x-pro-accordion',
				'docs_slug' => 'pro-accordion'
			],
			'pro_alert' =>[
				'title' => 'Pro Alert',
				'file_name' => 'x-pro-alert',
				'docs_slug' => 'pro-alert'
			],
			'pro_slider' =>[
				'title' => 'Pro Slider',
				'file_name' => 'x-pro-slider',
				'docs_slug' => 'pro-slider'
			],
			'pro_slider_control' =>[
				'title' => 'Pro Slider Control',
				'file_name' => 'x-pro-slider-control',
				'docs_slug' => 'pro-slider',
			],
			'pro_slider_gallery' =>[
				'title' => 'Pro Slider Gallery',
				'file_name' => 'x-pro-slider-gallery',
				'docs_slug' => 'pro-slider',
				'stylesheet' => false
			],
			'query_loop_extras' =>[
				'title' => 'Query Loop Extras',
				'file_name' => 'x-query-loop-extras',
				'docs_slug' => 'query-loop-extras',
				'stylesheet' => false,
				'element' => false,
			],
			'reading_progress_bar' =>[
				'title' => 'Reading Progress Bar',
				'file_name' => 'x-reading-progress-bar',
				'docs_slug' => 'reading-progress-bar'
			],
			'read_more_less' =>[
				'title' => 'Read More / Less',
				'file_name' => 'x-read-more-less',
				'docs_slug' => 'read-more-less'
			],
			'shortcode_wrapper' =>[
				'title' => 'Shortcode Wrapper',
				'file_name' => 'x-shortcode-wrapper',
				'docs_slug' => 'shortcode-wrapper',
				'stylesheet' => false
			],
			'breadcrumbs' => [
				'title' => 'Site Breadcrumbs',
				'file_name' => 'x-breadcrumbs',
				'docs_slug' => 'site-breadcrumbs'
			],
			'slide_menu' =>[
				'title' => 'Slide menu',
				'file_name' => 'x-slide-menu',
				'docs_slug' => 'slide-menu'
			],
			'social_share' =>[
				'title' => 'Social Share',
				'file_name' => 'x-social-share',
				'docs_slug' => 'social-share'
			],
			'star_rating' =>[
				'title' => 'Star Rating',
				'file_name' => 'x-star-rating',
				'docs_slug' => 'star-rating'
			],
			'table_of_contents' =>[
				'title' => 'Table of Contents',
				'file_name' => 'x-table-of-contents',
				'docs_slug' => 'table-of-contents'
			],
			'toggle_switch' =>[
				'title' => 'Toggle Switch',
				'file_name' => 'x-toggle-switch',
				'docs_slug' => 'toggle-switch'
			],
			/*
			'wp_forms' =>[
				'title' => 'WS Forms',
				'file_name' => 'x-ws-forms',
				'docs_slug' => 'ws-forms'
			],
			*/
			'x_ray' =>[
				'title' => 'X-Ray Mode',
				'file_name' => 'x-ray-mode',
				'docs_slug' => 'x-ray-mode',
				'element' => false,
			],
			
		];
	}

	function register_options() {
		foreach ( $this->elements as $key => $element ) {

				add_option( $this->prefix . $key, 0 );
				register_setting( $this->prefix . 'settings', $this->prefix . $key, array( $this, 'sanitize_enable' ) );
			
		}
	}

	function options_form() {

		foreach ( $this->elements as $key => $element ) {  ?>
			
			<tr valign="top"<?php echo get_option( $this->prefix . $key ) === '1' ? ' class="active"' : ' class="inactive"'; ?>>
				<th class="check-column">
					<input id="<?php echo $this->prefix . $key; ?>" name="<?php echo $this->prefix . $key; ?>" type="checkbox" value="1" <?php checked( get_option( $this->prefix . $key ), 1 ); ?> />
				</th>
				<td class="plugin-title column-primary">
					<?php echo '<strong>' . $element['title'] . '</strong>'; ?>
				</td>
				<th class="doc-link-th" style="text-align: right; padding-right: 10px;">
					<?php echo '<p class="doc-link"><a target="_blank" href="https://bricksextras.com/docs/' . $element['docs_slug'] . '/">Doc</a></p>'; ?>
				</th>
			</tr>
			<?php 
		}

	}

	function load_files() {

		$element_dir = BRICKSEXTRAS_PATH . 'components/classes/';

		foreach ( $this->elements as $key => $element ) {
			
			if ( 0 === intval( get_option( $this->prefix . $key, 0 ) ) ) {
				continue;
			}

			if ( isset( $element['element'] ) ) {
				continue;
			}

			$file = $element_dir . $element['file_name'] . '.php';
			$name = str_replace( '-', '', $element['file_name'] );
			$class_name = str_replace( '-', '_', $element['file_name'] );
			$class_name = ucwords( $class_name, '_' );

			/* Example output for each element for Bricks' register_element() function ..

				$file = BRICKSEXTRAS_PATH . 'components/classes/x-burger-trigger.php';
				$name = xburgertrigger ( this is the $name from the element class, no dashes )
				$class_name = X_Burger_Trigger ( the Class of the element, always capitalized, underscore not dashes )

			*/

			// Register all elements in builder & frontend 
			\Bricks\Elements::register_element( $file, $name, $class_name );

			/* include styles in builder */
			if ( bricks_is_builder_iframe() ) {

				if ( !isset( $element['stylesheet'] ) ) {
					$element['stylesheet'] = true;
				}

				if ( true === $element['stylesheet'] ) {
					$stylesheet = ltrim( str_replace( '-', '', $element['file_name'] ) , "x");
				} else if ( false !== $element['stylesheet'] ) {
					$stylesheet = $element['stylesheet'];
				}

				if ( !!$element['stylesheet'] ) {

					if ('xmodalnestable' === $name) {
						$handle = 'x-modal';
					} else if ('xoffcanvasnestable' === $name) {
						$handle = 'x-offcanvas';
					} else {
						$handle = $element['file_name'];
					}

					wp_enqueue_style( $element['file_name'], BRICKSEXTRAS_URL . 'components/assets/css/' . $stylesheet . '.css', [], $this->version );

				}

			}

		}

		BricksExtrasInteractive::init();

		if ( get_option( $this->prefix . 'query_loop_extras') ) {
			if ( ! class_exists( 'BricksExtrasQueryLoop' ) ) {
				require_once 'BricksExtrasQueryLoop.php';
			}
	
			(new BricksExtrasQueryLoop())->init();
		}

		

		$providers = [
			'extras'
		];

		if ( class_exists("\Bricks\Integrations\Dynamic_Data\Providers\Base") ) {
			BricksExtrasProviders::register($providers);
		}

		if ( ! class_exists( 'BricksExtrasHelpers' ) ) {
			require_once BRICKSEXTRAS_PATH . '/includes/BricksExtrasHelpers.php';
		}
		
	}


	function conditional_default_CSS( $version ) {	

			$templateTypes = [
				'header',
				'content',
				'footer'
			];

			if ( ! method_exists( '\Bricks\Database', 'get_template_data' ) || 
				 ! method_exists( '\Bricks\Database', 'get_setting' ) || 
				 ! method_exists( '\Bricks\Assets', 'minify_css' ) ||
				 ! method_exists( '\Bricks\Helpers', 'get_file_contents' ) ||
				 ! method_exists( '\Bricks\Query', 'is_any_looping' ) ||
				 ! method_exists( '\Bricks\Query', 'get_query_object_type' ) || 
				 ! method_exists( '\Bricks\Helpers', 'get_template_setting' ) ) {
				return;
			}

			$elementsOnPageArray = [];
	
			foreach ($templateTypes as $templateType) {
	
				$templateData = \Bricks\Database::get_template_data( $templateType );
	
				if ( !!$templateData ) {

					foreach ($templateData as $templateElements) {
						$elementsOnPageArray[] = $templateElements;
					}

				}
	
			};

			$templateIDs = [];

			/* find elements inside templates, post content, shortcodes */

			foreach ($elementsOnPageArray as $elementOnPage) {

				if ( isset( $elementOnPage['settings']['template'] ) ) {
					$templateIDs[] = ! empty( $elementOnPage['settings']['template'] ) ? intval( $elementOnPage['settings']['template'] ) : 0;
				}

				if ( isset( $elementOnPage['settings']['offcanvas_template'] ) ) {
					$templateIDs[] = ! empty( $elementOnPage['settings']['offcanvas_template'] ) ? intval( $elementOnPage['settings']['offcanvas_template'] ) : 0;
				}

				if ( isset( $elementOnPage['settings']['modal_template'] ) ) {
					$templateIDs[] = ! empty( $elementOnPage['settings']['modal_template'] ) ? intval( $elementOnPage['settings']['modal_template'] ) : 0;
				}

				if ( isset( $elementOnPage['settings']['templateId'] ) ) {
					$templateIDs[] = ! empty( $elementOnPage['settings']['templateId'] ) ? intval( $elementOnPage['settings']['templateId'] ) : 0;
				}

				if ( isset( $elementOnPage['settings']['shortcode'] ) ) {
					$templateIDs[] = strstr( $elementOnPage['settings']['shortcode'], '[bricks_template') ? (int) filter_var($elementOnPage['settings']['shortcode'], FILTER_SANITIZE_NUMBER_INT) : 0;
				}

				if ( isset( $elementOnPage['settings']['dataSource'] ) ) {

					if ( 'bricks' === $elementOnPage['settings']['dataSource'] ) {

						$post_id = get_the_ID();

						if ( ! empty( $post_id ) ) {
							$templateIDs[] = $post_id;
						}

					}

				}

			}

			foreach ($templateIDs as $templateID) {
				
				$templateElements = get_post_meta( $templateID, BRICKS_DB_PAGE_CONTENT, true );

				if ( !empty( $templateElements ) ) {
					foreach ($templateElements as $templateElement) {
						array_push( $elementsOnPageArray, $templateElement);
					}
				}
				
			}

			$elementsOnPageNames = array_column($elementsOnPageArray, 'name');
				
					// find all the active elements
					foreach ( $this->elements as $key => $element ) {

						if ( 0 === intval( get_option( $this->prefix . $key, 0 ) ) ) {
							continue;
						}

						$name = str_replace( '-', '', $element['file_name'] );

						// check if our elements are being used on the page
						if ( in_array( $name, $elementsOnPageNames ) )  {

							// enqueue neccessary styles in head for that page

							if ( !isset( $element['stylesheet'] ) ) {
								$element['stylesheet'] = true;
							}

							if ( true === $element['stylesheet'] ) {
								$stylesheet = ltrim( str_replace( '-', '', $element['file_name'] ) , "x");
							} else if ( false !== $element['stylesheet'] ) {
								$stylesheet = $element['stylesheet'];
							}

							if ( !!$element['stylesheet'] ) {
						
								// make sure the new versions of modal/offcanvas use the same CSS as the older ones.
								if ('xpromodalnestable' === $name) {
									$handle = 'x-modal';
								} else if ('xoffcanvasnestable' === $name) {
									$handle = 'x-offcanvas';
								} else {
									$handle = $element['file_name'];
								}

								if ( \Bricks\Database::get_setting( 'cssLoading' ) === 'file' ) {
									wp_enqueue_style( $handle, BRICKSEXTRAS_URL . 'components/assets/css/' . $stylesheet . '.css', [], $this->version );
								} else {
									$minified_css = \Bricks\Assets::minify_css( \Bricks\Helpers::get_file_contents( BRICKSEXTRAS_URL . 'components/assets/css/' . $stylesheet . '.css' ) );
									if ( $minified_css ) {
										wp_add_inline_style( 'bricks-frontend', $minified_css );
									} else {
										wp_enqueue_style( $handle, BRICKSEXTRAS_URL . 'components/assets/css/' . $stylesheet . '.css', [], $this->version );
									}
								}

							}

						}

				}
	}


	function frontend_scripts() {

		/* WPGridbuilder facet support */
		if ( defined( 'WPGB_VERSION' ) ) {
			wp_enqueue_script( 'wpgb-extras', BRICKSEXTRAS_URL . 'includes/js/wpgb-extras.js', ['wpgb-facets'], '1.0.0', true );
		}

		/* Jet Smart Filters support */
		if ( class_exists( 'Jet_Smart_Filters' ) ) {
			wp_enqueue_script( 'jsf-extras', BRICKSEXTRAS_URL . 'includes/js/jsf-extras.js', ['jet-smart-filters'], '1.0.0', true );
		}

		/* Piotnet Grid Filters support */
		if ( class_exists( 'piotnetgrid' ) ) {
			wp_enqueue_script( 'piotnet-extras', BRICKSEXTRAS_URL . 'includes/js/piotnet-extras.js', ['piotnetgrid-script'], '1.0.0', true );
		}
	}

	function builder_scripts() {

		if ( get_option( $this->prefix . 'x_ray') ) {
			wp_enqueue_script( 'bricks-editor', BRICKSEXTRAS_URL . 'includes/js/editor.js', [], '1.0.0', true );
		}

	}

}