<?php 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class X_Slide_Menu extends \Bricks\Element {

  // Element properties
  public $category     = 'extras';
	public $name         = 'xslidemenu';
	public $icon         = 'ti-view-list-alt';
	public $css_selector = '';
	public $scripts      = ['xSlideMenu'];
	public $nestable = true;

	// Methods: Builder-specific
	public function get_label() {
		return esc_html__( 'Slide menu', 'extras' );
	}
  public function set_control_groups() {

	$this->control_groups['menu'] = [
		'title' => esc_html__( 'Menu items', 'extras' ),
		'tab' => 'content',
	];

	$this->control_groups['sub-menu'] = [
		'title' => esc_html__( 'Sub menu items', 'extras' ),
		'tab' => 'content',
	];

	$this->control_groups['state'] = [
		'title' => esc_html__( 'Default state', 'extras' ),
		'tab' => 'content',
	];

  }

  public function set_controls() {

	$nav_menus = [];

	if ( bricks_is_builder() ) {
		foreach ( wp_get_nav_menus() as $menu ) {
			$nav_menus[ $menu->term_id ] = $menu->name;
		}
	}

	$this->controls['menuSource'] = [
		'tab' => 'content',
		'label' => esc_html__( 'Menu source', 'bricks' ),
		'type' => 'select',
		'options' => [
		  'dropdown' => esc_html__( 'Select menu', 'bricks' ),
		  'dynamic' => esc_html__( 'Dynamic data', 'bricks' ),
		],
		'inline'      => true,
		'clearable' => false,
		'placeholder' => esc_html__( 'Choose a menu', 'bricks' ),
	  ];

	  $this->controls['menu_id'] = [
		'tab' => 'content',
		'label' => esc_html__( 'Menu name, menu slug or menu ID', 'bricks' ),
		'type' => 'text',
		//'inline' => true,
		'placeholder' => esc_html__( '', 'bricks' ),
		'required' => ['menuSource', '=', 'dynamic'],
	  ];

	$this->controls['menu'] = [
		'tab'         => 'content',
		'label'       => esc_html__( 'Select Menu..', 'bricks' ),
		'type'        => 'select',
		'options'     => $nav_menus,
		'placeholder' => esc_html__( 'Select nav menu', 'bricks' ),
		'description' => sprintf( '<a href="' . admin_url( 'nav-menus.php' ) . '" target="_blank">' . esc_html__( 'Manage my menus in WordPress.', 'bricks' ) . '</a>' ),
		'required' => ['menuSource', '!=', 'dynamic'],
	];

	$this->controls['menu_width'] = [
		'tab' => 'content',
		'label' => esc_html__( 'Width', 'extras' ),
		'inline' => true,
		'type' => 'number',
		'units'    => true,
		'placeholder' => '100%',
		'css' => [
		  [
			'selector' => '',  
			'property' => 'width',
		  ],
		],
	  ];


	  $this->controls['slideDuration'] = [
		'tab' => 'content',
		'label' => esc_html__( 'Slide duration (ms)', 'bricks' ),
		'type' => 'number',
		'min' => 0,
		'max' => 1000,
		'step' => 1, // Default: 1
		'inline' => true,
		'placeholder' => esc_html__( '400', 'bricks' ),
	  ];

	  
	  $this->controls['maybeNestable'] = [
		'tab' => 'content',
		'label' => esc_html__( 'Nest elements: ', 'bricks' ),
		'type' => 'select',
		'inline' => true,
		'options' => [
		  'disable' => esc_html__( 'Disable', 'bricks' ),
		  'above' => esc_html__( 'Before menu', 'bricks' ),
		  'below' => esc_html__( 'After menu', 'bricks' ),
		],
		'clearable' => false,
		'placeholder' => esc_html__( 'Disable', 'bricks' ),
	  ];


	  /* menu items */

	  $menu_item_link_selector = '.menu-item a';

	  $this->controls['menu_sep'] = [
		'tab'   => 'content',
		'group'	=> 'menu',
		'type'  => 'separator',
		'label' => esc_html__( 'Menu links', 'bricks' ),
	  ];
	  
		

		$this->controls['menuBackground'] = [
			'tab'    => 'content',
			'group'  => 'menu',
			'type'   => 'background',
			'label'  => esc_html__( 'Background', 'bricks' ),
			'css'    => [
				[
					'property' => 'background',
					'selector' => $menu_item_link_selector,
				],
			],
		];

		$this->controls['menuBorder'] = [
			'tab'   => 'content',
			'group' => 'menu',
			'type'  => 'border',
			'label' => esc_html__( 'Border', 'bricks' ),
			'css'   => [
				[
					'property' => 'border',
					'selector' => $menu_item_link_selector,
				],
			],
		];

		$this->controls['menuTypography'] = [
			'tab'    => 'content',
			'group'  => 'menu',
			'type'   => 'typography',
			'label'  => esc_html__( 'Typography', 'bricks' ),
			'css'    => [
				[
					'property' => 'font',
					'selector' => $menu_item_link_selector,
				],
			],
		];

		$this->controls['menuActiveBackground'] = [
			'tab'    => 'content',
			'group'  => 'menu',
			'label'  => esc_html__( 'Active background', 'bricks' ),
			'type'   => 'background',
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.x-slide-menu_list > .current-menu-item > a, .x-slide-menu_list > .current-menu-ancestor > a, .x-slide-menu_list > .current-menu-parent > a',
				],
			],
		];

		$this->controls['menuActiveBorder'] = [
			'tab'   => 'content',
			'group' => 'menu',
			'label' => esc_html__( 'Active border', 'bricks' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.x-slide-menu_list > .current-menu-item > a, .x-slide-menu_list > .current-menu-ancestor > a, .x-slide-menu_list > .current-menu-parent > a',
				],
			],
		];

		$this->controls['menuActiveTypography'] = [
			'tab'    => 'content',
			'group'  => 'menu',
			'label'  => esc_html__( 'Active typography', 'bricks' ),
			'type'   => 'typography',
			'css'    => [
				[
					'property' => 'font',
					'selector' => '.x-slide-menu_list > .current-menu-item > a, .x-slide-menu_list > .current-menu-ancestor > a, .x-slide-menu_list > .current-menu-parent > a',
				],
			],
		];

		

		$this->controls['menuPadding'] = [
			'tab'   => 'content',
			'group' => 'menu',
			'label' => esc_html__( 'Padding', 'bricks' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => $menu_item_link_selector,
				]
			],
		];

		$this->controls['menuMargin'] = [
			'tab'         => 'content',
			'group'       => 'menu',
			'label'       => esc_html__( 'Margin', 'bricks' ),
			'type'        => 'dimensions',
			'css'         => [
				[
					'property' => 'margin',
					'selector' => $menu_item_link_selector,
				]
			],
			'placeholder' => [
				'top'    => 0,
				'right'  => 0,
				'bottom' => 0,
				'left'   => 30,
			],
		];


		/* sub menu */

		// Sub menu - Item
		$this->controls['subMenuItemSeparator'] = [
			'tab'   => 'content',
			'group' => 'sub-menu',
			'label' => esc_html__( 'Sub menu links', 'bricks' ),
			'type'  => 'separator',
		];

		$this->controls['subMenuArrowSize'] = [
			'tab'   => 'content',
			'group' => 'sub-menu',
			'type' => 'number',
			'min' => 0,
			'max' => 10,
			'step' => '.1',
			'units' => 'em',
			'label' => esc_html__( 'Sub menu toggle size', 'bricks' ),
			'placeholder' => '1em',
			'css'   => [
				[
					'property' => 'font-size',
					'selector' => '.x-slide-menu_dropdown-icon',
				],
			],
		];

		$this->controls['subMenuAriaLabel'] = [
			'tab'   => 'content',
			'group' => 'sub-menu',
			'label' => esc_html__( 'Sub menu toggle aria-label', 'bricks' ),
			'type'  => 'text',
			'placeholder' => 'Toggle sub menu',
		];

		$this->controls['subMenuBackground'] = [
			'tab'    => 'content',
			'group'  => 'sub-menu',
			'type'   => 'background',
			'label'  => esc_html__( 'Background', 'bricks' ),
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.x-slide-menu_list .sub-menu li.menu-item > a',
				]
			],
		];

		$this->controls['subMenuActiveBackground'] = [
			'tab'    => 'content',
			'group'  => 'sub-menu',
			'type'   => 'background',
			'label'  => esc_html__( 'Active background', 'bricks' ),
			'css'    => [
				[
					'property' => 'background',
					'selector' => '.x-slide-menu_list .sub-menu > li.current-menu-item > a',
				]
			],
		];

		$this->controls['subMenuItemBorder'] = [
			'tab'   => 'content',
			'group' => 'sub-menu',
			'label' => esc_html__( 'Border', 'bricks' ),
			'type'  => 'border',
			'css'   => [
				[
					'property' => 'border',
					'selector' => '.x-slide-menu_list .sub-menu > li > a',
				],
			],
		];

		$this->controls['subMenuTypography'] = [
			'tab'    => 'content',
			'group'  => 'sub-menu',
			'type'   => 'typography',
			'label'  => esc_html__( 'Typography', 'bricks' ),
			'css'    => [
				[
					'property' => 'font',
					'selector' => '.x-slide-menu_list .sub-menu > li.menu-item > a',
				],
			],
		];

		$this->controls['subMenuActiveTypography'] = [
			'tab'    => 'content',
			'group'  => 'sub-menu',
			'label'  => esc_html__( 'Active typography', 'bricks' ),
			'type'   => 'typography',
			'css'    => [
				[
					'property' => 'font',
					'selector' => '.x-slide-menu_list .sub-menu > .current-menu-item > a',
				],
			],
		];

		$this->controls['subMenuTextIndent'] = [
			'tab'   => 'content',
			'group' => 'sub-menu',
			'type' => 'number',
			'step' => '1',
			'units' => 'px',
			'label' => esc_html__( 'Sub menu text indent', 'bricks' ),
			'placeholder' => '',
			'css'   => [
				[
					'property' => '--x-slide-menu-indent',
					'selector' => '.x-slide-menu_list',
				],
			],
		];

		$this->controls['subMenuPadding'] = [
			'tab'   => 'content',
			'group' => 'sub-menu',
			'type'  => 'dimensions',
			'label' => esc_html__( 'Link padding', 'bricks' ),
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.x-slide-menu_list .sub-menu > li.menu-item > a',
				],
			],
		];


		/* state */

		$this->controls['defaultState'] = [
			'tab' => 'content',
			'label' => esc_html__( 'Default state', 'bricks' ),
			'description' => esc_html__( 'Set to hidden if needing to reveal the menu as a dropdown after clicking an element (for eg for a mobile menu in the header)', 'bricks' ),
			'group'  => 'state',
			'type' => 'select',
			'options' => [
			  'open' => esc_html__( 'Open', 'bricks' ),
			  'hidden' => esc_html__( 'Hidden', 'bricks' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Open', 'bricks' ),
			'clearable' => false,
		  ];

		  $this->controls['clickSelector'] = [
			'tab' => 'content',
			'label' => esc_html__( 'Click selector', 'bricks' ),
			'group'	=> 'state',
			'type' => 'text',
			'inline' => true,
			'placeholder' => esc_html__( '.my-element', 'bricks' ),
			'required' => ['defaultState', '=', 'hidden'],
			'hasDynamicData' => false,
		  ];

		  $this->controls['builderPreview'] = [
			'tab' => 'content',
			'label' => esc_html__( 'State in builder', 'bricks' ),
			'group'  => 'state',
			'type' => 'select',
			'options' => [
			  'open' => esc_html__( 'Open', 'bricks' ),
			  'hidden' => esc_html__( 'Hidden', 'bricks' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Hidden', 'bricks' ),
			'clearable' => false,
			'required' => ['defaultState', '=', 'hidden'],
		  ];

	  

  }

  // Methods: Frontend-specific
  public function enqueue_scripts() {

	wp_enqueue_script( 'x-frontend', BRICKSEXTRAS_URL . 'components/assets/js/frontend.js', '', '1.0.0', true );
	wp_enqueue_script( 'x-slide-menu', BRICKSEXTRAS_URL . 'components/assets/js/slidemenu.js', ['x-frontend'], '1.0.1', true );

  }

  public function render() {

	$menuSource = isset( $this->settings['menuSource'] ) ? $this->settings['menuSource'] : 'dropdown';
	$maybeNestable = isset( $this->settings['maybeNestable'] ) ? $this->settings['maybeNestable'] : 'disable';
	$subMenuAriaLabel = isset( $this->settings['subMenuAriaLabel'] ) ? $this->settings['subMenuAriaLabel'] : 'Toggle sub menu';

	if ( 'dropdown' === $menuSource) {
		$menu  = ! empty( $this->settings['menu'] ) ? $this->settings['menu'] : '';

		if ( ! $menu || ! is_nav_menu( $menu ) ) {
			// Use first registered menu
			foreach ( wp_get_nav_menus() as $menu ) {
				$menu = $menu->term_id;
			}
	
			if ( ! $menu || ! is_nav_menu( $menu ) ) {
				return $this->render_element_placeholder(
					[
						'title' => esc_html__( 'No nav menu found.', 'bricks' ),
					]
				);
			}
		}

	} else {
		$menu  = ! empty( $this->settings['menu_id'] ) ? strstr( $this->settings['menu_id'], '{') ? $this->render_dynamic_data_tag( $this->settings['menu_id'], 'text' ) : $this->settings['menu_id'] : '';
	}

	

	$defaultState = isset( $this->settings['defaultState'] ) ? $this->settings['defaultState'] : 'open';
	$builderPreview = isset( $this->settings['builderPreview'] ) ? $this->settings['builderPreview'] : 'hidden';

	$menu_config = [
		'slideDuration' => ! empty( $this->settings['slideDuration'] ) ? $this->settings['slideDuration'] : 400,
		'subMenuAriaLabel' => $subMenuAriaLabel
	];

	if ( 'hidden' === $defaultState ) {

		$menu_config += [
			'clickSelector' => !empty( $this->settings['clickSelector'] ) ? $this->settings['clickSelector'] : null
		];

    }

    if ( 'hidden' !== $builderPreview ) {

		$menu_config += [
			'hidden' => 'true'
		];
	
	}

   $this->set_attribute( '_root', 'data-x-slide-menu', wp_json_encode( $menu_config ) );

   if ( $menu && is_nav_menu( $menu ) ) {

	$output = '';

	$output .= "<nav {$this->render_attributes( '_root' )}>";

		if ( 'above' === $maybeNestable ) {
			if ( method_exists('\Bricks\Frontend','render_children') ) {
				$output .= \Bricks\Frontend::render_children( $this );
			}
		}

		ob_start();

		wp_nav_menu( [
			'menu'           => $menu,
			'menu_class'     => 'x-slide-menu_list',
			'container'		 => 'false',
		] );

		$nav_menu_output = ob_get_clean();

        $output .= $nav_menu_output;

		if ( 'below' === $maybeNestable ) {
			if ( method_exists('\Bricks\Frontend','render_children') ) {
				$output .=  \Bricks\Frontend::render_children( $this );
			}
		}

		$output .=  "</nav>";

	echo $output;

	}
    
  }


}