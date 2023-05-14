<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class X_Ws_Forms extends \Bricks\Element {

  // Element properties
 	public $category     = 'extras';
	public $name         = 'xwsforms';
	public $icon         = 'ti-layout-media-overlay-alt-2';
	public $css_selector = '';

	public function __construct($element = null) {

		if( bricks_is_builder() ) {
			$this->scripts = ['wsf_form_init'];
		}

		parent::__construct($element);
	}

  
	public function get_label() {
		return esc_html__( 'WS Forms', 'extras' );
	}

	public function set_control_groups() {

		$this->control_groups['general_group'] = [
			'title' => esc_html__( 'General styles', 'extras' ),
			'tab'   => 'content',
		];

    	$this->control_groups['inputs_group'] = [
			'title' => esc_html__( 'Inputs / Labels', 'extras' ),
			'tab'   => 'content',
		];

		$this->control_groups['submit_group'] = [
			'title' => esc_html__( 'Buttons', 'extras' ),
			'tab'   => 'content',
		];

		$this->control_groups['checkbox_group'] = [
			'title' => esc_html__( 'Checkbox / Radio', 'extras' ),
			'tab'   => 'content',
		];

		$this->control_groups['range_group'] = [
			'title' => esc_html__( 'Range Slider', 'extras' ),
			'tab'   => 'content',
		];

		$this->control_groups['tab_group'] = [
			'title' => esc_html__( 'Tabs / Tab content', 'extras' ),
			'tab'   => 'content',
		];


		$this->control_groups['success_group'] = [
			'title' => esc_html__( 'Success / Validation Errors', 'extras' ),
			'tab'   => 'content',
		];

	}

	public function set_controls() {

		$formOptions = [];

		if ( method_exists('WS_Form_Common','get_forms_array') ) {
			$formOptions = WS_Form_Common::get_forms_array(false);
		}

		$this->controls['formSource'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Add form ID dynamically', 'bricks' ),
			'type'        => 'checkbox',
			'inline'      => true,
		];

		$this->controls['formSelect'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Select form', 'bricks' ),
			'type'        => 'select',
			'options' => $formOptions,
			'placeholder' => esc_html__( 'Select form', 'bricks' ),
			'default' => '1',
			'clearable' => false,
			'required' => ['formSource', '!=', true],
		];

		$this->controls['formID'] = [
			'tab' => 'content',
			'label' => esc_html__( 'Form ID', 'bricks' ),
			'type' => 'text',
			'required' => ['formSource', '=', true],
		];

		$inputsArray = [
			'.wsf-form input[type="date"].wsf-field',
			'.wsf-form input[type="datetime-local"].wsf-field',
			'.wsf-form input[type="month"].wsf-field',
			'.wsf-form input[type="password"].wsf-field', 
			'.wsf-form input[type="search"].wsf-field',
			'.wsf-form input[type="time"].wsf-field',
			'.wsf-form input[type="week"].wsf-field',
			'.wsf-form input[type="email"].wsf-field', 
			'.wsf-form input[type="number"].wsf-field', 
			'.wsf-form input[type="tel"].wsf-field',
			'.wsf-form input[type="text"].wsf-field', 
			'.wsf-form input[type="url"].wsf-field',
			'.wsf-form select.wsf-field',
			'.wsf-form select.wsf-field:not([multiple]):not([size])',
			'.wsf-form textarea.wsf-field',
			'[data-wsf-legal].wsf-field'
		];

		$inputsNotSelect = '.wsf-form input[type="date"].wsf-field, 
							.wsf-form input[type="datetime-local"].wsf-field, 
							
							.wsf-form input[type="month"].wsf-field, 
							.wsf-form input[type="password"].wsf-field, 
							.wsf-form input[type="search"].wsf-field, 
							.wsf-form input[type="time"].wsf-field,
							.wsf-form input[type="week"].wsf-field, 
							.wsf-form input[type="email"].wsf-field, 
							.wsf-form input[type="number"].wsf-field, 
							.wsf-form input[type="tel"].wsf-field, 
							.wsf-form input[type="text"].wsf-field, 
							.wsf-form input[type="url"].wsf-field, 
							.wsf-form textarea.wsf-field';

		$inputs = '';


		/* spacing */

		$this->controls['gridGutter'] = [
			'tab'   => 'content',
			'group' => 'general_group',
			'label' => esc_html__( 'Space between form elements', 'extras' ),
			'type' => 'number',
			'placeholder' => '20',
			'units'    => true,
			'css'   => [
				[
					'property' => '--xwsf-grid-gutter',
					'selector' => '.wsf-form',
				],
				[
					'property' => 'margin-bottom',
					'selector' => '.wsf-form .wsf-field-wrapper',
				],
				
			],
		];

		$this->controls['generalColorSep'] = [
			'tab'   => 'content',
			'group'  => 'general_group',
			'label' => esc_html__( 'Form wide colors', 'extras' ),
			'description' => esc_html__( 'Used in multiple places across the form, will override WS Form global styles', 'extras' ),
			'type'  => 'separator',
		];

		$defaultColorCSS = [
			[
			   'property' => 'color',
			   'selector' => '.wsf-form ul.wsf-group-tabs > li.wsf-tab-active > a', 
			],
			[
			   'property' => 'color',
			   'selector' => '.wsf-form ul.wsf-group-tabs > li > a:not(.wsf-tab-disabled)', 
			],
			[
			   'property' => 'color',
			   'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active ~ li > a:not(.wsf-tab-disabled):before', 
			],
			[
			   'property' => 'color',
			   'selector' => '.wsf-input-group-prepend, .wsf-input-group-append', 
			],
			[
			   'property' => 'color',
			   'selector' => 'input[type=radio].wsf-field + label.wsf-label', 
			],
			[
			   'property' => 'color',
			   'selector' => 'input[type=checkbox].wsf-field + label.wsf-label', 
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_label', 
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_calendar td', 
			   'important' => true
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_calendar th', 
			]
			
	   ];

	  
		$defaultColorCSS[] = \BricksExtras\Helpers::doCSSrules('color', $inputsArray);

		$this->controls['generaldefaultColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Default color', 'extras' ),
			'description'  => esc_html__( 'Labels and field values', 'extras' ),
			'css' => $defaultColorCSS
		];

		

		$invertedColorCSS = [
			[
			   'property' => 'color',
			   'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li > a:before', 
			],
			[
			   'property' => 'background-color',
			   'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active > a:before', 
			],
			[
			   'property' => 'background-color',
			   'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active ~ li > a:before', 
			],
			[
			   'property' => 'color',
			   'selector' => '[data-wsf-tooltip]:after', 
			],
			[
			   'property' => 'color',
			   'selector' => 'input[type=checkbox].wsf-field.wsf-button:checked + label.wsf-label,
			   input[type=radio].wsf-field.wsf-button:checked + label.wsf-label', 
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_label > .xdsoft_select > div > .xdsoft_option.xdsoft_current', 
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_label > .xdsoft_select > div > .xdsoft_option:hover'
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current',
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div.xdsoft_current',
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_calendar td:hover',
			],
			[
			   'property' => 'color',
			   'selector' => '.xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div:hover',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-primary',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-secondary',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-success',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-danger',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-primary:hover',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-primary:focus',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-success:hover',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-success:focus',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-information:hover',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-information:focus',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-warning:hover',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-warning:focus',
			],
			[
			   'property' => 'color',
			   'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-danger:hover',
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=radio].wsf-field + label.wsf-label:before',
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=checkbox].wsf-field + label.wsf-label:before',
			],
			[
				'property' => 'background-color',
				'selector' => '.xdsoft_datetimepicker',
			],
			[
				'property' => 'background-color',
				'selector' => '.xdsoft_datetimepicker .xdsoft_label',
			],

			[
				'property' => 'color',
				'selector' => '.xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current',
			],
			[
				'property' => 'color',
				'selector' => '.xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div.xdsoft_current',
				'important' => true
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-groups input[type=radio].wsf-field:checked + label.wsf-label:after',
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-groups input[type=checkbox].wsf-field:checked + label.wsf-label:after',
			]
			
		];

		$invertedColorCSS = array_merge( $invertedColorCSS, \BricksExtras\Helpers::doCSSrules('background-color', $inputsArray) );

		$this->controls['generaldefaultInvertedColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Inverted color', 'extras' ),
			'description'  => esc_html__( 'Field backgrounds and button text', 'extras' ),
			'css'  =>  $invertedColorCSS
		];

		$lightColorCSS = [
			[
				'property' => 'color',
				'selector' => '.wsf-form ul.wsf-group-tabs > li > a.wsf-tab-disabled'
			],
			[
				'property' => 'color',
				'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li > a.wsf-tab-disabled:before'
			],
			[
				'property' => 'color',
				'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active ~ li > a.wsf-tab-disabled:before'
			]
		];

		$this->controls['generalLightColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Light Color', 'extras' ),
			'description'  => esc_html__( 'Placeholders, help text, and disabled field values.', 'extras' ),
			'css'    => $lightColorCSS
		];

		$lighterColorCSS = [
			[
				'property' => 'border-color',
				'selector' => 'button.wsf-button'
			],
			[
				'property' => 'background-color',
				'selector' => 'button.wsf-button'
			],
			[
				'property' => 'border-color',
				'selector' => 'button.wsf-button:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'button.wsf-button:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active ~ li > a:after'
			],
			[
				'property' => 'border-color',
				'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active ~ li > a:before'
			],
			
			
		];

		$lighterColorCSS = array_merge( $lighterColorCSS, \BricksExtras\Helpers::doCSSrules('border-color', $inputsArray) );

		$this->controls['generalLighterColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Lighter Color', 'extras' ),
			'description'  => esc_html__( 'Field borders and buttons.', 'extras' ),
			'css'    => $lighterColorCSS
		];

		$lightestColorCSS = [
			[
				'property' => 'background-color',
				'selector' => 'input[type=range].wsf-field::-webkit-slider-runnable-track'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=range].wsf-field::-moz-range-track'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=range].wsf-field::-ms-track'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=file].wsf-field::file-selector-button'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=file].wsf-field::-webkit-file-upload-button'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=text].wsf-field ~ .dropzone .wsf-progress'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=text].wsf-field:disabled ~ .dropzone'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=text].wsf-field:disabled ~ canvas'
			],
			[
				'property' => 'background-color',
				'selector' => 'meter.wsf-meter::-webkit-meter-bar'
			],
			[
				'property' => 'background-color',
				'selector' => 'progress.wsf-progress[value]'
			],
			[
				'property' => 'background-color',
				'selector' => 'progress.wsf-progress[value]::-webkit-progress-bar'
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-alert'
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-input-group-prepend',
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-input-group-append'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=date].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=datetime-local].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=file].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=month].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=password].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=search].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=time].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=week].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=email].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=number].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=tel].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=text].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=url].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=tel].wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'select.wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'textarea.wsf-field:disabled'
			],
			[
				'property' => 'background-color',
				'selector' => 'select.wsf-field ~ .select2-container--default.select2-container--disabled .select2-selection--single,select.wsf-field ~ .select2-container--default.select2-container--disabled .select2-selection--multiple'
			],
			[
				'property' => 'background-color',
				'selector' => 'select.wsf-field ~ .select2-container--default .select2-selection--multiple .select2-selection__choice'
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-select2-dropdown .select2-results .select2-results__option[aria-selected=true]'
			],
			[
				'property' => 'background-color',
				'selector' => '.wsf-select2-dropdown .select2-results .select2-results__option[aria-selected=true]'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=checkbox].wsf-field:disabled + label.wsf-label:before'
			],
			[
				'property' => 'background-color',
				'selector' => 'input[type=radio].wsf-field:disabled + label.wsf-label:before'
			],
			[
				'property' => 'background-color',
				'selector' => '.xdsoft_datetimepicker .xdsoft_calendar td,body .xdsoft_datetimepicker .xdsoft_calendar th'
			],
			[
				'property' => '--wsf-color-upper-track',
				'selector' => 'input[type=range].wsf-field'
			],

		];
		
	

		$this->controls['generalLightestColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Lightest Color', 'extras' ),
			'description'  => esc_html__( 'Range slider backgrounds, progress bar backgrounds, and disabled field backgrounds.', 'extras' ),
			'css'    => $lightestColorCSS
		];

		$this->controls['generalPrimaryColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Primary Color', 'extras' ),
			'description'  => esc_html__( 'Checkboxes, radios, range sliders, progress bars, and submit buttons.', 'extras' ),
			'css'    => [
				 [
					'property' => 'border-color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li > a:before', 
				 ],
				 [
					'property' => 'color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active > a:before', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li.wsf-tab-active > a:before', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'button.wsf-button.wsf-button-primary', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-primary', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'input[type=radio].wsf-field:checked + label.wsf-label:before', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=radio].wsf-field:checked + label.wsf-label:before', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=radio].wsf-field:focus + label.wsf-label:before', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'input[type=checkbox].wsf-field:checked + label.wsf-label:before', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=checkbox].wsf-field:checked + label.wsf-label:before', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=checkbox].wsf-field:focus + label.wsf-label:before', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=date].wsf-field:focus', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=datetime-local].wsf-field:focus', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=file].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=month].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=password].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=search].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=time].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=week].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=email].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=number].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=tel].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=text].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'input[type=url].wsf-field:focus', 
				],
				 [
					'property' => 'border-color',
					'selector' => 'select.wsf-field:focus', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'textarea.wsf-field:focus', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => '.xdsoft_datetimepicker .xdsoft_calendar td:hover,.xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div:hover', 
					'important' => true
				 ],
				 [
					'property' => 'background-color',
					'selector' => '.xdsoft_datetimepicker .xdsoft_label > .xdsoft_select > div > .xdsoft_option.xdsoft_current', 
					'important' => true
				 ],
				 [
					'property' => 'background-color',
					'selector' => '.xdsoft_datetimepicker .xdsoft_label > .xdsoft_select > div > .xdsoft_option:hover',
					'important' => true
				 ],

				 [
					'property' => 'background-color',
					'selector' => '.xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current',
					'important' => true
				 ],
				 [
					'property' => 'background-color',
					'selector' => '.xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box>div>div.xdsoft_current',
					'important' => true
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'input[type=range].wsf-field::-webkit-slider-thumb',
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'input[type=range].wsf-field::-moz-range-thumb',
				 ],
				 [
					'property' => 'border-color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps > li > a:not(.wsf-tab-disabled):focus:before',
				 ]
			]
		];

		$this->controls['generalSecondaryColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Secondary Color', 'extras' ),
			'description'  => esc_html__( 'Secondary elements such as a reset button.', 'extras' ),
			'css'    => [
				 [
					'property' => 'border-color',
					'selector' => 'input[type=date].wsf-field', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-secondary', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'button.wsf-button.wsf-button-secondary', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-secondary:disabled', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'button.wsf-button.wsf-button-secondary:disabled', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-secondary', 
				 ],
				 [
					'property' => 'color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-secondary', 
				 ],

				 [
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-secondary:disabled', 
				 ],
				 [
					'property' => 'color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-secondary:disabled', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-secondary:focus', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-secondary:focus', 
				 ],
				 [
					'property' => 'color',
					'selector' => 'wsf-text-secondary collator_asort', 
				 ],

				 

				 
			]
		];

		$this->controls['generalSuccessColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Success Color', 'extras' ),
			'description'  => esc_html__( 'Completed progress bars, save buttons, and success messages.', 'extras' ),
			'css'    => [
				 [
					'property' => 'border-color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps.wsf-steps-success > li > a:before', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps.wsf-steps-success > li > a:before', 
				 ],
				 [
					'property' => 'background-color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps.wsf-steps-success > li > a:after', 
				 ],
				[
					'property' => 'border-color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps.wsf-steps-success > li > a:not(.wsf-tab-disabled):focus:before', 
				],
				[
					'property' => 'color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps.wsf-steps-success > li.wsf-tab-active > a:before', 
				],
				[
					'property' => 'color',
					'selector' => '.wsf-form ul.wsf-group-tabs.wsf-steps.wsf-steps-success > li.wsf-tab-active > a:before', 
				],
				[
					'property' => 'background-color',
					'selector' => 'input[type=text].wsf-field ~ .dropzone .wsf-progress.wsf-progress-success .wsf-upload', 
				],
				[
					'property' => 'background-color',
					'selector' => 'progress.wsf-progress.wsf-progress-success[value]::-webkit-progress-value', 
				],
				[
					'property' => 'background-color',
					'selector' => 'progress.wsf-progress.wsf-progress-success[value]::-moz-progress-bar', 
				],
				[
					'property' => 'background-color',
					'selector' => 'progress.wsf-progress.wsf-progress-success[value]::-ms-fill', 
				],
				[
					'property' => 'background-color',
					'selector' => 'meter.wsf-meter::-webkit-meter-optimum-value', 
				],
				[
					'property' => 'background-color',
					'selector' => 'meter.wsf-meter:-moz-meter-optimum::-moz-meter-bar', 
				],

				[
					'property' => 'background-color',
					'selector' => 'button.wsf-button.wsf-button-success', 
				 ],
				[
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-success', 
				],

				[
					'property' => 'background-color',
					'selector' => 'button.wsf-button.wsf-button-success:disabled', 
				 ],
				[
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-success:disabled', 
				],

				[
					'property' => 'border-color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-success:disabled', 
				 ],
				[
					'property' => 'color',
					'selector' => 'button.wsf-button.wsf-button-inverted.wsf-button-success:disabled', 
				],

				[
					'property' => 'color',
					'selector' => '.wsf-text-success', 
				]

				
			]
		];

		$this->controls['generalInformationColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Information Color', 'extras' ),
			'description'  => esc_html__( 'Information messages.', 'extras' ),
			'css'    => [
				 [
					'property' => 'border-color',
					'selector' => 'input[type=date].wsf-field', 
				 ],
				 [
					'property' => 'color',
					'selector' => '.wsf-alert.wsf-alert-information', 
				 ],
				 [
					'property' => 'border-color',
					'selector' => '.wsf-alert.wsf-alert-information', 
				 ],
			]
		];

		$this->controls['generalInformationBg'] = [ 
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Information Background', 'extras' ),
			'description'  => esc_html__( 'Information messages.', 'extras' ),
			'css'    => [
				 [
					'property' => 'background-color',
					'selector' => '.wsf-alert.wsf-alert-information', 
				 ],
			]
		];

		$this->controls['generalWarningColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Warning Color', 'extras' ),
			'description'  => esc_html__( 'Warning messages', 'extras' ),
			'css'    => [
				 [
					'property' => 'border-color',
					'selector' => 'input[type=date].wsf-field', 
				]
			]
		];

		$this->controls['generalDangerColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Danger Color', 'extras' ),
			'description'  => esc_html__( 'Required field labels, invalid field borders, invalid feedback, remove repeatable section buttons, and danger messages.', 'extras' ),
			'css'    => [
				 [
					'property' => 'border-color',
					'selector' => 'input[type=date].wsf-field', 
				 ],
				 [
					'property' => 'color',
					'selector' => '.wsf-invalid-feedback', 
				 ],
				 
			]
		];

		$this->controls['generalBorderColor'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'units' => true,
			'label'  => esc_html__( 'Border color', 'extras' ),
			'css'    => [
				[
					'property' => 'border-color',
					'selector' => 'input[type=date].wsf-field, 
								   input[type=datetime-local].wsf-field, 
								   input[type=file].wsf-field, 
								   input[type=month].wsf-field, 
								   input[type=password].wsf-field, 
								   input[type=search].wsf-field, 
								   input[type=time].wsf-field, 
								   input[type=week].wsf-field, 
								   input[type=email].wsf-field, 
								   input[type=number].wsf-field, 
								   input[type=tel].wsf-field, 
								   input[type=text].wsf-field, 
								   input[type=url].wsf-field, 
								   select.wsf-field, textarea.wsf-field'
				],
				[
					'property' => 'border-top-color',
					'selector' => '.wsf-form ul.wsf-group-tabs > li.wsf-tab-active > a'
				],
				[
					'property' => 'border-left-color',
					'selector' => '.wsf-form ul.wsf-group-tabs > li.wsf-tab-active > a'
				],
				[
					'property' => 'border-right-color',
					'selector' => '.wsf-form ul.wsf-group-tabs > li.wsf-tab-active > a'
				],
				[
					'property' => 'border-bottom-color',
					'selector' => '.wsf-form ul.wsf-group-tabs'
				],

				

			],
		];

		$this->controls['focusBoxShadow'] = [
			'tab'    => 'content',
			'group'  => 'general_group',
			'type'   => 'color',
			'label'  => esc_html__( 'Focus shadow color', 'extras' ),
			'css'    => [
				[
					'property' => '--xwsf-focus-shadow',
					'selector' => '.wsf-form'
				]
			]
		];

		$this->controls['spacing_sep'] = [
			'tab'   => 'content',
			'group'  => 'spacing_group',
			'type'  => 'separator',
		];

		


		

		/* inputs / labels */

	  
		 
		$this->controls['labelsSep'] = [
			'tab'   => 'content',
			'group'  => 'inputs_group',
			'label' => esc_html__( 'Labels', 'extras' ),
			'type'  => 'separator',
		  ];
	  

		  $labels = '.wsf-form label, 
			   .wsf-form label.wsf-label';
  
	 	 $this->controls['labelsTypography'] = [
			  'tab'    => 'content',
			  'group'  => 'inputs_group',
			  'type'   => 'typography',
			  'label'  => esc_html__( 'Typography', 'extras' ),
			  'css'    => [
				  [
					  'property' => 'font',
					  'selector' => $labels,
				  ],
			  ],
		  ];

		  $this->controls['asteriskColor'] = [
			'tab'      => 'content',
			'group'  => 'inputs_group',
			'label'    => esc_html__( 'Asterisk Color', 'extras' ),
			'type'     => 'color',
			'css'      => [
				[
					'property' => 'color',
					'selector' => '.wsf-required-wrapper .wsf-text-danger',
				],
			],
		];

		  $this->controls['labelMargin'] = [
			'tab'   => 'content',
			'group' => 'inputs_group',
			'label' => esc_html__( 'Margin', 'extras' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'margin',
					'selector' => $labels,
				],
			],
		];
  
	  
	  
		

			$this->controls['inputStyle_start'] = [
				'tab'   => 'content',
				'group'  => 'inputs_group',
				'label' => esc_html__( 'Inputs', 'extras' ),
				'type'  => 'separator',
		  	];
	  
			  $this->controls['inputTypography'] = [
				'tab'    => 'content',
				'group'  => 'inputs_group',
				'type'   => 'typography',
				'label'  => esc_html__( 'Field typography', 'extras' ),
				'css'    => [
					[
						'property' => 'font',
						'selector' => $inputs,
					],
				],
			];
	
		$this->controls['placeholderTypography'] = [
				'tab'    => 'content',
				'group'  => 'inputs_group',
				'type'   => 'typography',
				'label'  => esc_html__( 'Placeholder', 'extras' ),
				'css'    => [
					[
						'property' => 'font',
						'selector' => '.fluentform .ff-el-group input::-webkit-input-placeholder',
					],
					[
						'property' => 'font',
						'selector' => '.fluentform .ff-el-group textarea::-webkit-input-placeholder',
					],
				],
			];
			  
			//var_dump(\BricksExtras\doCSSruless('background-color', $inputsArray));
	  
			  $this->controls['inputBackgroundColor'] = [
				  'tab'    => 'content',
				  'group'  => 'inputs_group',
				  'type'   => 'color',
				  'label'  => esc_html__( 'Background', 'extras' ),
				  'css'    => [
					  [
						  'property' => 'background-color',
						  'selector' => $inputs,
					  ],
				  ],
			  ];
	  
			  $this->controls['inputBorder'] = [
				  'tab'    => 'content',
				  'group'  => 'inputs_group',
				  'type'   => 'border',
				  'label'  => esc_html__( 'Border', 'extras' ),
				  'css'    => [
					  [
						  'property' => 'border',
						  'selector' => $inputs
					  ],
				  ],
			  ];
	  
			  $this->controls['inputBoxShadow'] = [
				  'tab'    => 'content',
				  'group'  => 'inputs_group',
				  'label'  => esc_html__( 'Box Shadow', 'extras' ),
				  'type'   => 'box-shadow',
				  'css'    => [
					  [
						  'property' => 'box-shadow',
						  'selector' => $inputs,
					  ],
				  ],
			  ];
	  
			  $this->controls['inputPadding'] = [
				  'tab'   => 'content',
				  'group' => 'inputs_group',
				  'label' => esc_html__( 'Padding', 'extras' ),
				  'type'  => 'dimensions',
				  'css'   => [
					  [
						  'property' => 'padding',
						  'selector' => $inputsNotSelect,
					  ],
				  ],
			  ];


			 



			  /* submit */

			  $mainButton = '.wsf-form button.wsf-button';
		  
			$this->controls['submitPadding'] = [
				'tab'   => 'content',
				'group' => 'submit_group',
				'label' => esc_html__( 'Padding', 'extras' ),
				'type'  => 'dimensions',
				'css'   => [
					[
						'property' => 'padding',
						'selector' => $mainButton,
					],
				],
			];
		  
		  
			  $this->controls['submitWidth'] = [
					  'tab'   => 'content',
					  'group' => 'submit_group',
					  'label' => esc_html__( 'Width', 'extras' ),
					  'type' => 'number',
					  'units'    => true,
					  'css'   => [
						  [
							  'property' => 'width',
							  'selector' => $mainButton,
						  ],
					  ],
				  ];
		  
		  
			  $this->controls['inputTextAlign'] = array(
				'tab'         => 'content',
					  'group' => 'submit_group',
					  'label'       => esc_html__( 'Button align', 'extras' ),
					  'type'        => 'text-align',
					  'css'         => [
						  [
							  'property' => 'text-align',
							  'selector' => $mainButton
						  ],
					  ],
					  'inline'      => true,
					  'placeholder' => 'left',
				);

			 	 $this->controls['buttonTypography'] = [
					  'tab'    => 'content',
					  'group'  => 'submit_group',
					  'type'   => 'typography',
					  'label'  => esc_html__( 'Typography', 'extras' ),
					  'css'    => [
						  [
							  'property' => 'font',
							  'selector' => $mainButton
						  ],
					  ],
				  ];
		  
				  $this->controls['submitStyle_start'] = [
						'tab'   => 'content',
						'group'  => 'submit_group',
						'type'  => 'separator',
						'label'  => esc_html__( 'Submit Button', 'extras' ),
					];

			  	$submitButton = '.wsf-form button.wsf-button.wsf-button-primary';
				  
				  $this->controls['submitTypography'] = [
					'tab'    => 'content',
					'group'  => 'submit_group',
					'type'   => 'typography',
					'label'  => esc_html__( 'Typography', 'extras' ),
					'css'    => [
						[
							'property' => 'font',
							'selector' => $submitButton
						],
					],
				];
		  
				  $this->controls['submitBackgroundColor'] = [
					  'tab'    => 'content',
					  'group'  => 'submit_group',
					  'type'   => 'color',
					  'label'  => esc_html__( 'Background', 'extras' ),
					  'css'    => [
						  [
							  'property' => 'background-color',
							  'selector' => $submitButton,
						  ],
					  ],
				  ];
		  
				  $this->controls['submitBorder'] = [
					  'tab'    => 'content',
					  'group'  => 'submit_group',
					  'type'   => 'border',
					  'label'  => esc_html__( 'Border', 'extras' ),
					  'css'    => [
						  [
							  'property' => 'border',
							  'selector' => $submitButton
						  ],
					  ],
				  ];
		  
				  $this->controls['submitBoxShadow'] = [
					  'tab'    => 'content',
					  'group'  => 'submit_group',
					  'label'  => esc_html__( 'Box Shadow', 'extras' ),
					  'type'   => 'box-shadow',
					  'css'    => [
						  [
							  'property' => 'box-shadow',
							  'selector' => $submitButton,
						  ],
					  ],
				  ];

				  $this->controls['saveStyle_start'] = [
					'tab'   => 'content',
					'group'  => 'submit_group',
					'type'  => 'separator',
					'label'  => esc_html__( 'Save Button', 'extras' ),
				];

				  $saveButton = '.wsf-form button.wsf-button[data-action="wsf-save"]';
		  
				  $this->controls['saveTypography'] = [
					'tab'    => 'content',
					'group'  => 'submit_group',
					'type'   => 'typography',
					'label'  => esc_html__( 'Typography', 'extras' ),
					'css'    => [
						[
							'property' => 'font',
							'selector' => $saveButton
						],
					],
				];
		  
				  $this->controls['saveBackgroundColor'] = [
					  'tab'    => 'content',
					  'group'  => 'submit_group',
					  'type'   => 'color',
					  'label'  => esc_html__( 'Background', 'extras' ),
					  'css'    => [
						  [
							  'property' => 'background-color',
							  'selector' => $saveButton,
						  ],
					  ],
				  ];
		  
				  $this->controls['saveBorder'] = [
					  'tab'    => 'content',
					  'group'  => 'submit_group',
					  'type'   => 'border',
					  'label'  => esc_html__( 'Border', 'extras' ),
					  'css'    => [
						  [
							  'property' => 'border',
							  'selector' => $saveButton
						  ],
					  ],
				  ];
		  
				  $this->controls['saveBoxShadow'] = [
					  'tab'    => 'content',
					  'group'  => 'submit_group',
					  'label'  => esc_html__( 'Box Shadow', 'extras' ),
					  'type'   => 'box-shadow',
					  'css'    => [
						  [
							  'property' => 'box-shadow',
							  'selector' => $saveButton,
						  ],
					  ],
				  ];
			  




			/* checkbox */


			$checkbox_input = '.wsf-form input[type=checkbox].wsf-field + label.wsf-label:before';
			$radio_input = '.wsf-form input[type=radio].wsf-field + label.wsf-label:before';
			
			$checkbox_input_after = '.wsf-form input[type=checkbox].wsf-field + label.wsf-label:after';
			$radio_input_after = '.wsf-form input[type=radio].wsf-field + label.wsf-label:after';

			$checkbox_input_checked = '.wsf-form input[type=checkbox].wsf-field:checked + label.wsf-label:before';
			$radio_input_checked = '.wsf-form input[type=radio].wsf-field:checked + label.wsf-label:before';

			
			

			

				$this->controls['radioCheckboxSize'] = [
					'tab'      => 'content',
					'group'    => 'checkbox_group',
					'label'    => esc_html__( 'Size', 'extras' ),
					'type' => 'number',
					'units'    => true,
					'css'      => [
						[
							'property'  => 'width',
							'selector'  => $checkbox_input,
						],
						[
							'property' => 'width',
							'selector' => $radio_input,
						],
						[
							'property'  => 'width',
							'selector'  => $checkbox_input_after,
						],
						[
							'property' => 'width',
							'selector' => $radio_input_after,
						],
						[
							'property'  => 'height',
							'selector'  => $checkbox_input,
						],
						[
							'property' => 'height',
							'selector' => $radio_input,
						],
						[
							'property'  => 'height',
							'selector'  => $checkbox_input_after,
						],
						[
							'property' => 'height',
							'selector' => $radio_input_after,
						],
						[
							'property' => '--xwsf-checkbox-size',
							'selector' => '.wsf-form',
						]
						
					],
				];

				

				$this->controls['radioCheckboxMargin'] = [
					'tab'   => 'content',
					'group' => 'checkbox_group',
					'label' => esc_html__( 'Spacing', 'extras' ),
					'type'  => 'number',
					'css'   => [
						[
							'property'  => '-webkit-margin-end',
							'selector'  => '.wsf-inline',
						],
						[
							'property'  => 'margin-end',
							'selector'  => '.wsf-inline',
						],
						[
							'property'  => 'margin-bottom',
							'selector'  => 'input[type=checkbox].wsf-field + label.wsf-label',
						],

						
					],
				];

				$this->controls['radioCheckboxSpacing'] = [
					'tab'   => 'content',
					'group' => 'checkbox_group',
					'label' => esc_html__( 'Spacing', 'extras' ),
					'type'  => 'number',
					'css'   => [
						[
							'property'  => '--xwsf-checkbox-spacing',
							'selector'  => '.wsf-form',
						],
					],
				];

				$this->controls['radioCheckboxColor'] = [
					'tab'      => 'content',
					'group'    => 'checkbox_group',
					'label'    => esc_html__( 'Color', 'extras' ),
					'type'     => 'color',
					'css'      => [
						[
							'property' => 'background',
							'selector' => $checkbox_input,
						],
						[
							'property' => 'background',
							'selector' => $radio_input,
						],
					],
				];

				$this->controls['radioCheckboxColorChecked'] = [
					'tab'      => 'content',
					'group'    => 'checkbox_group',
					'label'    => esc_html__( 'Checked Color', 'extras' ),
					'type'     => 'color',
					'css'      => [
						[
							'property' => 'background',
							'selector' => $checkbox_input_checked
						],
						[
							'property' => 'background',
							'selector' => $radio_input_checked
						],
						[
							'property' => 'border-color',
							'selector' => $checkbox_input_checked
						],
						[
							'property' => 'border-color',
							'selector' => $radio_input_checked
						],
					],
				];

				



		/* tabs */

		$this->controls['tab_sep'] = [
			'tab'   => 'content',
			'group'  => 'tab_group',
			'label' => esc_html__( 'Tabs', 'extras' ),
			'type'  => 'separator',
		];
		
		$this->controls['tabPadding'] = [
			'tab'   => 'content',
			'group' => 'tab_group',
			'label' => esc_html__( 'Padding', 'extras' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.wsf-form ul.wsf-group-tabs > li > a',
				],
			],
		];

		$this->controls['tabTypography'] = [
			'tab'   => 'content',
			'group' => 'tab_group',
			'label' => esc_html__( 'Typography', 'extras' ),
			'type'  => 'font',
			'css'   => [
				[
					'selector' => '.wsf-form ul.wsf-group-tabs > li > a',
				],
			],
		];


		$this->controls['tab_content_sep'] = [
			'tab'   => 'content',
			'group'  => 'tab_group',
			'label' => esc_html__( 'Tab Content', 'extras' ),
			'type'  => 'separator',
		];
		
		$this->controls['tabContentPadding'] = [
			'tab'   => 'content',
			'group' => 'tab_group',
			'label' => esc_html__( 'Padding', 'extras' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.wsf-group',
				],
			],
		];


  }

  
  public function render() {

			if ( !defined( 'WS_FORM_NAME' ) ) {
				return $this->render_element_placeholder( [ 
			'title' => esc_html__( "WS Form isn't active.", 'bricksextras' )
			] );
			}

			$settings = $this->settings;

			if ( !isset( $settings['formSource'] ) ) {
				$formID = isset( $settings['formSelect'] ) ? $settings['formSelect'] : '';
			} else {
				$formID = strstr( $settings['formID'], '{') ? $this->render_dynamic_data_tag( $settings['formID'], 'text' ) : $settings['formID'];
			}

			if( $formID > 0 ) {

				echo "<div {$this->render_attributes('_root')}>";

					$bricks_iframe = (
						(function_exists('bricks_is_builder_preview') && bricks_is_builder_preview()) ||
						(function_exists('bricks_is_builder_iframe') && bricks_is_builder_iframe()) ||
						(function_exists('bricks_is_builder_call') && bricks_is_builder_call())
					);

					$visualBuilder = ( $bricks_iframe || bricks_is_ajax_call() ) ? ' visual_builder="true"' : '';

					$formShortcode = '[ws_form id="' . $formID . '" element_id="' . $formID . $visualBuilder . ']';

					echo do_shortcode($formShortcode);

				echo '</div>';

		} 

  }

}
