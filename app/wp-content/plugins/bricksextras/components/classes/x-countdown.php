<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class X_Countdown extends \Bricks\Element {
	public $category     = 'general';
	public $name         = 'xcountdown';
	public $icon         = 'ti-time';
	public $css_selector = '.x-countdown_item';
	public $scripts      = [ 'xCountdown' ];

	public function get_label() {
		return esc_html__( 'Evergreen Countdown', 'bricks' );
	}

	public function enqueue_scripts() {
	    wp_enqueue_script( 'x-countdown', BRICKSEXTRAS_URL . 'components/assets/js/countdown.js', '', '1.0.0', true );
	}

	public function set_control_groups() {

		$this->control_groups['itemsGroup'] = [
				'title' => esc_html__( 'Items', 'bricks' ),
				'tab' => 'content',
		];

		$this->control_groups['seperatorsGroup'] = [
			'title' => esc_html__( 'Seperators', 'bricks' ),
			'tab' => 'content',
		];

	}

	public function set_controls() {

        /*$this->controls['mode'] = [
			'label'       => esc_html__( 'Countdown mode', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'fixed' => esc_html__( 'Fixed time', 'bricks' ),
				'evergreen' => esc_html__( 'Evergreen', 'bricks' ),
			],
			'placeholder' => esc_html__( 'Fixed time', 'bricks' ),
			'inline'      => true,
			'rerender'    => true,
		];*/


		
        $this->controls['fieldsSeparator'] = [
			'label' => esc_html__( 'Fields', 'bricks' ),
			'type'  => 'separator',
		];

		$this->controls['fields'] = [
			'type'          => 'repeater',
			'titleProperty' => 'format',
			'placeholder'   => esc_html__( 'Field', 'bricks' ),
			'fields'        => [
                'type' => [
					'label'  => esc_html__( 'Type', 'bricks' ),
					'type'   => 'select',
                    'options' => [
                        'days' => esc_html__( 'Days', 'bricks' ),
                        'hours' => esc_html__( 'Hours', 'bricks' ),
                        'minutes' => esc_html__( 'Minutes', 'bricks' ),
                        'seconds' => esc_html__( 'Seconds', 'bricks' )
                    ],
					'inline' => true,
                    
				],
                'value' => [
					'label'  => esc_html__( 'Value', 'bricks' ),
					'type'   => 'text',
					'inline' => true,
				],
				'format' => [
					'label'       => esc_html__( 'Format', 'bricks' ),
					'type'        => 'text',
					'placeholder' => '%D',
					'inline'      => true,
					'info'        => '%D, %H, %M, %S (' . esc_html__( 'Lowercase removes leading zeros', 'bricks' ) . ')',
				],
			],
			'default'       => [
				[ 'format' => '%D days',
                  'type' => 'days',
				  'value' => 3
                ],
				[ 'format' => '%H hours',
                'type' => 'hours' 
               ],
				[ 'format' => '%M minutes',
                'type' => 'minutes' 
               ],
				[ 'format' => '%S seconds',
                'type' => 'seconds'
               ],
			],
			'rerender'      => true,
		];

        $this->controls['actionSeparator'] = [
			'type'  => 'separator',
		];

        $this->controls['action'] = [
			'label'       => esc_html__( 'Action when countdown ends', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'countdown' => esc_html__( 'Countdown', 'bricks' ),
				'hide'      => esc_html__( 'Hide', 'bricks' ),
				'text'      => esc_html__( 'Custom text', 'bricks' ),
				'sync'      => esc_html__( 'Auto-close Modal/Notification', 'bricks' ),
			],
			'placeholder' => esc_html__( 'Countdown', 'bricks' ),
			'inline'      => true,
			'rerender'    => true,
		];


        $this->controls['actionText'] = [
			'label'    => esc_html__( 'Date Reached', 'bricks' ) . ': ' . esc_html__( 'Custom text', 'bricks' ),
			'type'     => 'editor',
			'required' => [ 'action', '=', 'text' ],
			'rerender' => true,
		];

        $this->controls['actionEndSeparator'] = [
			'type'  => 'separator',
		];

		$this->controls['flexDirectionFields'] = [
			'label'  => esc_html__( 'Direction', 'bricks' ),
			'type'   => 'direction',
			'css'    => [
				[
					'property' => 'flex-direction',
					'selector' => '',
				],
			],
			'inline' => true,
		];

		// items

		
		$this->controls['flexDirection'] = [
			'label'  => esc_html__( 'Direction', 'bricks' ),
			'type'   => 'direction',
			'css'    => [
				[
					'property' => 'flex-direction',
					'selector' => '.x-countdown_format',
				],
			],
			'inline' => true,
			'group' => 'itemsGroup',
			'placeholder' => 'column',
		];

		  $this->controls['itemGap'] = [
			'tab' => 'content',
			'label' => esc_html__( 'Item gap', 'bricks' ),
			'inline' => true,
			'type' => 'number',
			'units' => true,
			'placeholder' => '5px',
			'css'    => [
				[
					'property' => 'gap',
					'selector' => '',
				],
			],
			'group' => 'itemsGroup'
		  ];  


		  $this->controls['itemBackgroundColor'] = [
			'tab'    => 'content',
			'type'   => 'color',
			'label'  => esc_html__( 'Background', 'extras' ),
			'css'    => [
				[
					'property' => 'background-color',
					'selector' => '.x-countdown_item',
				],
			],
			'group' => 'itemsGroup'
		];
	
		$this->controls['itemBorder'] = [
			'tab'    => 'content',
			'type'   => 'border',
			'label'  => esc_html__( 'Border', 'extras' ),
			'css'    => [
				[
					'property' => 'border',
					'selector' => '.x-countdown_item',
				],
			],
			'group' => 'itemsGroup'
		];
	
		$this->controls['itemBoxShadow'] = [
			'tab'    => 'content',
			'label'  => esc_html__( 'Box Shadow', 'extras' ),
			'type'   => 'box-shadow',
			'css'    => [
				[
					'property' => 'box-shadow',
					'selector' => '.x-countdown_item',
				],
			],
			'group' => 'itemsGroup'
		];

		$this->controls['itemPadding'] = [
			'tab'   => 'content',
			'label' => esc_html__( 'Padding', 'extras' ),
			'type'  => 'dimensions',
			'css'   => [
			  [
				'property' => 'padding',
				'selector' => '.x-countdown_item',
			  ],
			],
			'group' => 'itemsGroup'
		  ];


		  $this->controls['itemWidth'] = [
			'tab'   => 'content',
			'label' => esc_html__( 'Width', 'extras' ),
			'type' => 'number',
			'units' => true,
			'css'   => [
			  [
				'property' => 'width',
				'selector' => '.x-countdown_item',
			  ],
			],
			'group' => 'itemsGroup'
		  ];

		  


		unset( $this->controls['_typography'] );

		$this->controls['typography'] = [
			'tab'   => 'style',
			'group' => '_typography',
			'label' => esc_html__( 'Typography', 'bricks' ),
			'type'  => 'typography',
			'css'   => [
				[
					'property' => 'font',
				],
			],
		];

		$this->controls['numberTypography'] = [
			'tab'   => 'style',
			'group' => '_typography',
			'label' => esc_html__( 'Typography', 'bricks' ) . ' (' . esc_html__( 'Number', 'bricks' ) . ')',
			'type'  => 'typography',
			'css'   => [
				[
					'property' => 'font',
					'selector' => '.x-countdown_number',
				],
			],
		];


		$this->controls['maybeSeperator'] = [
			'tab'   => 'style',
			'group' => 'seperatorsGroup',
			'label' => esc_html__( 'Show seperators', 'bricks' ),
			'type'  => 'select',
			'inline'	=> true,
			'options'   => [
				'disable' => esc_html__( 'Disable', 'bricks' ),
				'enable' => esc_html__( 'Enable', 'bricks' ),
			],
			'placeholder' => esc_html__( 'Enable', 'bricks' ),
		];

		$this->controls['seperator'] = [
			'tab'   => 'style',
			'group' => 'seperatorsGroup',
			'label' => esc_html__( 'Seperator', 'bricks' ),
			'type'  => 'text',
			'inline'	=> true,
			'placeholder' => ':',
			'required' => ['maybeSeperator', '!=', 'disable'],
		];

		$this->controls['seperatorTypography'] = [
			'tab'    => 'content',
			'type'   => 'typography',
			'label'  => esc_html__( 'Typography', 'extras' ),
			'css'    => [
				[
					'property' => 'font',
					'selector' => '.x-countdown_seperator',
				],
			],
			'group' => 'seperatorsGroup',
		];

	}

	public function render() {
		$settings    = $this->settings;
        $mode        = isset( $settings['mode'] ) ? $settings['mode'] : 'fixed';
		$date        = ! empty( $settings['date'] ) ? $settings['date'] : false;
		$fields      = ! empty( $settings['fields'] ) ? $settings['fields'] : false;
		$action      = ! empty( $settings['action'] ) ? $settings['action'] : 'countdown';
		$action_text = ! empty( $settings['actionText'] ) ? $settings['actionText'] : '';
		$maybeSeperator = isset( $settings['maybeSeperator'] ) ? 'enable' === $settings['maybeSeperator'] : true;
		$seperator = isset( $settings['seperator'] ) ? $settings['seperator'] : ':';

		if ( ! $fields ) {
			return $this->render_element_placeholder( [ 'title' => esc_html__( 'No date/fields set.', 'bricks' ) ] );
		}

        $config = [
            'fields'     => $fields,
            'action'     => $action,
            'actionText' => $action_text,
        ];

        if ( $maybeSeperator ) {
			$config['seperator']  = $seperator;
		} 

		$outputConfig = $this->render_dynamic_data( wp_json_encode($config), 'text' );

		$this->set_attribute( '_root', 'role', 'timer');
		$this->set_attribute( '_root', 'aria-atomic', 'true');
		$this->set_attribute( '_root', 'data-x-countdown', $outputConfig);

        $loopIndex = false;

		if ( method_exists('\Bricks\Query','is_any_looping') ) {

			$query_id = \Bricks\Query::is_any_looping();
	
			if ( $query_id ) {
				
				if ( BricksExtras\Helpers::get_bricks_looping_parent_query_id_by_level(2) ) {
					$loopIndex = \Bricks\Query::get_query_for_element_id( \Bricks\Query::get_query_element_id( BricksExtras\Helpers::get_bricks_looping_parent_query_id_by_level(2) ) )->loop_index . '_' . \Bricks\Query::get_query_for_element_id( \Bricks\Query::get_query_element_id( BricksExtras\Helpers::get_bricks_looping_parent_query_id_by_level(1) ) )->loop_index . '_' . \Bricks\Query::get_loop_index();
				} else {
					if ( BricksExtras\Helpers::get_bricks_looping_parent_query_id_by_level(1) ) {
						$loopIndex = \Bricks\Query::get_query_for_element_id( \Bricks\Query::get_query_element_id( BricksExtras\Helpers::get_bricks_looping_parent_query_id_by_level(1) ) )->loop_index . '_' . \Bricks\Query::get_loop_index();
					} else {
						$loopIndex = \Bricks\Query::get_loop_index();
					}
				}			
	
				$this->set_attribute( '_root', 'data-x-id', $this->id . '_' . $loopIndex );
				
			} else {
				$this->set_attribute( '_root', 'data-x-id', $this->id );
			}
	
		} 

		echo "<div {$this->render_attributes( '_root' )}></div>";
	}
}
