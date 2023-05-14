<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class X_Pro_Slider_Gallery extends \Bricks\Element {

    public $category     = 'extras';
	public $name         = 'xproslidergallery';
	public $icon         = 'ti-layout-column3';
	public $css_selector = '';

	public function get_label() {
		return esc_html__( 'Pro Slider Gallery', 'bricks' );
	}

	public function enqueue_scripts() {

		$link_to = ! empty( $this->settings['link'] ) ? $this->settings['link'] : false;

		if ( $link_to === 'lightbox' ) {
			wp_enqueue_script( 'bricks-photoswipe' );
			wp_enqueue_style( 'bricks-photoswipe' );
		}
	}

	public function set_control_groups() {

        $this->control_groups['captions'] = [
			'title' => esc_html__( 'Captions', 'bricks' ),
			'required'    => [ 'caption', '=', true ],
		];

	}

	public function set_controls() {
		$this->controls['_border']['css'][0]['selector']    = 'img';
		$this->controls['_boxShadow']['css'][0]['selector'] = 'img';

		$this->controls['intro'] = [
			'tab'         => 'content',
			'description'    => esc_html__( 'This element should be placed inside of a Pro Slider element, to dynamically add new slides', 'bricks' ),
			'type'     => 'separator',
		];

		$this->controls['items'] = [
			'tab'  => 'content',
			'type' => 'image-gallery',
		];


		

		// Settings
		
		$this->controls['link'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Link to', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				//'dynamiclightbox'   => esc_html__( 'Dynamic lightbox', 'bricks' ),
				'lightbox'   => esc_html__( 'Lightbox', 'bricks' ),
				'attachment' => esc_html__( 'Attachment Page', 'bricks' ),
				'media'      => esc_html__( 'Media File', 'bricks' ),
				'custom'     => esc_html__( 'Custom URL', 'bricks' ),
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'None', 'bricks' ),
		];

		$this->controls['lightboxImageSize'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Image size', 'bricks' ),
			'type'        => 'select',
			'options'     => $this->control_options['imageSizes'],
			'placeholder' => esc_html__( 'Full', 'bricks' ),
			'required'    => [ 'link', '=', 
				[
					'dynamiclightbox',
					'lightbox',
					'media'
				] 
			],
		];

		$this->controls['linkCustom'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Custom links', 'bricks' ),
			'type'        => 'repeater',
			'fields'      => [
				'link' => [
					'label'   => esc_html__( 'Link', 'bricks' ),
					'type'    => 'link',
					'exclude' => [
						'lightboxImage',
						'lightboxVideo',
					],
				],
			],
			'placeholder' => esc_html__( 'Custom link', 'bricks' ),
			'required'    => [ 'link', '=', 'custom' ],
		];

		

		$this->controls['objectFit'] = [
			'tab'         => 'content',
			'label'       => esc_html__( 'Object fit', 'bricks' ),
			'type'        => 'select',
			'options'     => [
				'fill'       => esc_html__( 'Fill', 'bricks' ),
				'contain'    => esc_html__( 'Contain', 'bricks' ),
				'cover'      => esc_html__( 'Cover', 'bricks' ),
				'none'       => esc_html__( 'None', 'bricks' ),
				'scale-down' => esc_html__( 'Scale down', 'bricks' ),
				'fill'       => esc_html__( 'Fill', 'bricks' ),
			],
			'css'         => [
				[
					'property' => 'object-fit',
					'selector' => 'img',
				],
			],
			'inline'      => true,
			'placeholder' => esc_html__( 'Fill', 'bricks' ),
		];

		// @since 1.3.7
		$this->controls['objectPosition'] = [
			'tab'            => 'content',
			'label'          => esc_html__( 'Object position', 'bricks' ),
			'type'           => 'text',
			'css'            => [
				[
					'property' => 'object-position',
					'selector' => 'img',
				],
			],
			'inline'         => true,
			'placeholder'    => '50% 50%',
			'hasDynamicData' => false,
			'required'       => [ 'objectFit' ],
		];

		$this->controls['maybeSRCSET'] = [
			'tab'   => 'content',
			'label' => esc_html__( 'Srcset', 'bricks' ),
			'type'  => 'select',
			'inline'      => true,
			'options'     => [
				'disable'	=> esc_html__( 'Disable', 'bricks' ),
				'enable'   => esc_html__( 'Enable', 'bricks' ),
			],
			'placeholder' => esc_html__( 'Disable', 'bricks' )
		];


		/* caption */

		$this->controls['caption'] = [
			'tab'   => 'content',
			'label' => esc_html__( 'Caption', 'bricks' ),
			'type'  => 'checkbox',
		];

		

		$this->controls['captionBackground'] = [
			'group' => 'captions',
			'label' => esc_html__( 'Background', 'bricks' ),
			'type' => 'background',
			'css' => [
			  [
				'property' => 'background',
				'selector' => '.x-slider_slide-caption',
			  ],
			],
		  ];

		$this->controls['captionBorder'] = [
			'group'    => 'captions',
			'label'    => esc_html__( 'Border', 'bricks' ),
			'type'     => 'border',
			'css'      => [
				[
					'property' => 'border',
					'selector' => '.x-slider_slide-caption',
				],
			],
		];

		$this->controls['captionTypography'] = [
			'group'    => 'captions',
			'label'    => esc_html__( 'Typography', 'bricks' ),
			'type'     => 'typography',
			'css'      => [
				[
					'property' => 'font',
					'selector' => '.x-slider_slide-caption',
				],
			],
		];

		$this->controls['captionTop'] = [
			'group'    => 'captions',
			'label'    => esc_html__( 'Top', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'top',
					'selector' => '.x-slider_slide-caption',
				],
			],
		];

		$this->controls['captionRight'] = [
			'group'    => 'captions',
			'label'    => esc_html__( 'Right', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'right',
					'selector' => '.x-slider_slide-caption',
				],
			],
		];

		$this->controls['captionBottom'] = [
			'group'    => 'captions',
			'label'    => esc_html__( 'Bottom', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'bottom',
					'selector' => '.x-slider_slide-caption',
				],
			],
		];

		$this->controls['captionLeft'] = [
			'group'    => 'captions',
			'label'    => esc_html__( 'Left', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'left',
					'selector' => '.x-slider_slide-caption',
				],
			],
		];

		$this->controls['captionWidth'] = [
			'group'    => 'captions',
			'label'    => esc_html__( 'Width', 'bricks' ),
			'type'     => 'number',
			'units'    => true,
			'css'      => [
				[
					'property' => 'width',
					'selector' => '.x-slider_slide-caption',
				],
			],
		];


		$this->controls['captionPadding'] = [
			'group' => 'captions',
			'label' => esc_html__( 'Caption padding', 'bricks' ),
			'type'  => 'dimensions',
			'css'   => [
				[
					'property' => 'padding',
					'selector' => '.x-slider_slide-caption',
				],
			],
			'placeholder' => [
				'top'    => '10px',
				'right'  => '15px',
				'bottom' => '10px',
				'left'   => '15px',
			],
		];

		/* lazy */

		$this->controls['lazyLoadSupport'] = [
			'tab'   => 'content',
			'label' => esc_html__( 'Support lazy load', 'bricks' ),
			'type'  => 'select',
			'inline'      => true,
			'options'     => [
				'none'	=> esc_html__( 'None', 'bricks' ),
				'splide'   => esc_html__( 'Splide lazy load', 'bricks' ),
				'bricks' => esc_html__( 'Bricks Lazy load', 'bricks' ),
			],
			'placeholder' => esc_html__( 'Splide lazy load', 'bricks' )
		];

		

		$this->controls['tagsSep'] = [
			'type'     => 'separator',
		];

		$this->controls['listTag'] = [
			'label'       => esc_html__( 'List HTML tag', 'bricks' ),
			'type'        => 'text',
			'hasDynamicData' => false,
			'inline'      => true,
			'placeholder' => 'ul',
		];

		$this->controls['slideTag'] = [
			'label'       => esc_html__( 'Slide HTML tag', 'bricks' ),
			'type'        => 'text',
			'hasDynamicData' => false,
			'inline'      => true,
			'placeholder' => 'li',
		];
	}

	public function get_normalized_image_settings( $settings ) {
		$items = isset( $settings['items'] ) ? $settings['items'] : [];

		$size = ! empty( $items['size'] ) ? $items['size'] : BRICKS_DEFAULT_IMAGE_SIZE;

		// Dynamic Data
		if ( ! empty( $items['useDynamicData'] ) ) {
			$items['images'] = [];

			$images = $this->render_dynamic_data_tag( $items['useDynamicData'], 'image' );

			if ( is_array( $images ) ) {
				foreach ( $images as $image_id ) {
					$items['images'][] = [
						'id'   => $image_id,
						'full' => wp_get_attachment_image_url( $image_id, 'full' ),
						'url'  => wp_get_attachment_image_url( $image_id, $size )
					];
				}
			}
		}

		// Either empty OR old data structure used before 1.0 (images were saved as one array directly on $items)
		if ( ! isset( $items['images'] ) ) {
			$images = ! empty( $items ) ? $items : [];

			unset( $items );

			$items['images'] = $images;
		}

		// Get 'size' from first image if not set (previous to 1.4-RC)
		$first_image_size = ! empty( $items['images'][0]['size'] ) ? $items['images'][0]['size'] : false;
		$size             = empty( $items['size'] ) && $first_image_size ? $first_image_size : $size;

		// Calculate new image URL if size is not the same as from the Media Library
		if ( $first_image_size && $first_image_size !== $size ) {
			foreach ( $items['images'] as $key => $image ) {
				$items['images'][ $key ]['size'] = $size;
				$items['images'][ $key ]['url']  = wp_get_attachment_image_url( $image['id'], $size );
			}
		}

		$settings['items'] = $items;

		$settings['items']['size'] = $size;

		return $settings;
	}

	public function render() {

		$settings = $this->get_normalized_image_settings( $this->settings );

		$images   = ! empty( $settings['items']['images'] ) ? $settings['items']['images'] : false;
		$size     = ! empty( $settings['items']['size'] ) ? $settings['items']['size'] : BRICKS_DEFAULT_IMAGE_SIZE;
		$link_to  = ! empty( $settings['link'] ) ? $settings['link'] : false;

		$listTag = isset( $settings['listTag'] ) ? esc_html($settings['listTag']) : 'ul';
		$slideTag = isset( $settings['slideTag'] ) ? esc_html($settings['slideTag']) : 'li';

		$lazyLoad = isset( $settings['lazyLoadSupport'] ) ? esc_html( $settings['lazyLoadSupport'] ) : 'splide';
		$maybeSRCSET = isset( $settings['maybeSRCSET'] ) ? esc_html( $settings['maybeSRCSET'] ) : 'disable';

		// Return placeholder
		if ( ! $images ) {
			if ( ! empty( $settings['items']['useDynamicData'] ) ) {
				if ( BRICKS_DB_TEMPLATE_SLUG !== get_post_type( $this->post_id ) ) {
					/*return $this->render_element_placeholder(
						[
							'title' => esc_html__( 'Dynamic data is empty.', 'bricks' )
						]
					);*/
				}
			} else {
				/*return $this->render_element_placeholder(
					[
						'title' => esc_html__( 'No image selected.', 'bricks' ),
					]
				);*/
			}
		}

		$root_classes = [
			'splide__list',
			'x-splide__list',
			'x-slider-gallery'
		];

		$lightbox_id = \Bricks\Helpers::generate_random_id( false );

		$this->set_attribute( '_root', 'class', $root_classes );

		if ( $images ) {
			foreach ( $images as $index => $item ) {
				$item_classes  = [ 'x-slider_slide splide__slide' ];
				$image_styles  = [];
				$image_classes = [];

				$this->set_attribute( "item-{$index}", 'class', $item_classes );

				// Get image url, width and height (Fallback: Placeholder image)
				if ( isset( $item['id'] ) ) {
					$image_src = wp_get_attachment_image_src( $item['id'], $size );
				} elseif ( isset( $item['url'] ) ) {
					$image_src = [ $item['url'], 800, 600 ];
				}

				$image_src = ! empty( $image_src ) && is_array( $image_src ) ? $image_src : [ \Bricks\Builder::get_template_placeholder_image(), 800, 600 ];

				$image_url    = ! empty( $image_src[0] ) ? $image_src[0] : ( isset( $item['url'] ) ? $item['url'] : '' );
				$image_width  = ! empty( $image_src[1] ) ? $image_src[1] : 200;
				$image_height = ! empty( $image_src[2] ) ? $image_src[2] : 200;

				if ( $image_width ) {
					$this->set_attribute( "img-$index", 'width', $image_width );
				}

				if ( $image_height ) {
					$this->set_attribute( "img-$index", 'height', $image_height );
				}


				$this->set_attribute( "img-$index", 'class', $image_classes );
				$this->set_attribute( "img-$index", 'src', $image_url );
			}
		}


		if ( defined('BRICKS_DB_CUSTOM_FONT_FACE_RULES') ) {
			$bricksLightboxUpdate = true;
		} else {
			$bricksLightboxUpdate = false;
		}
		

		echo "<" . $listTag . " {$this->render_attributes( '_root' )}>";

		if ( $images ) {
			foreach ( $images as $index => $item ) {

				$image_classes = [];

				$image_atts = [];

				$close_a_tag = false;
				$caption     = isset( $settings['caption'] ) && isset( $item['id'] ) ? wp_get_attachment_caption( $item['id'] ) : false;

				$image_correct_size = wp_get_attachment_image_src( $item['id'], $size );

				$lightbox_image_size = ! empty( $settings['lightboxImageSize'] ) ? $settings['lightboxImageSize'] : 'full';
				$lightbox_image      = wp_get_attachment_image_src( $item['id'], $lightbox_image_size );
				$lightbox_image      = ! empty( $lightbox_image ) && is_array( $lightbox_image ) ? $lightbox_image : [ $item['url'], 800, 600 ];

				if ( $bricksLightboxUpdate ) {
					if ( $link_to === 'lightbox' ) {
						$this->set_attribute( "item-$index", 'class', 'bricks-lightbox' );
					}
				}

				echo "<" . $slideTag . " {$this->render_attributes( "item-{$index}" )}>";

				if ( $link_to === 'attachment' && isset( $item['id'] ) ) {
					$close_a_tag = true;

					echo '<a href="' . get_permalink( $item['id'] ) . '" target="_blank">';
				} elseif ( $link_to === 'media' ) {
					$close_a_tag = true;

					echo '<a href="' . esc_url( $lightbox_image[0] ) . '" target="_blank">';
				} elseif ( $link_to === 'custom' && isset( $settings['linkCustom'][ $index ]['link'] ) ) {
					
					$close_a_tag = true;

					$this->set_link_attributes( "a-$index", $settings['linkCustom'][ $index ]['link'] );

					echo "<a {$this->render_attributes( "a-$index" )}>";
				} 
				
				// Lightbox attributes
				elseif ( $link_to === 'dynamiclightbox' ) {

					$close_a_tag = true;

					echo '<a href="' . $lightbox_image[0] . '" ';
					
					//echo 'data-title="' . wp_get_attachment_caption( $item['id'] ) . '"';
					
					echo '>';
				}

				elseif ( $link_to === 'lightbox' ) {

					if ( ! empty( $lightbox_image ) ) {

						if ( !$bricksLightboxUpdate ) {

							$image_classes[] = 'bricks-lightbox';
						
							$image_atts['data-bricks-lightbox-index']  = $index;
							$image_atts['data-bricks-lightbox-id']     = $lightbox_id;
							$image_atts['data-bricks-lightbox-source'] = $lightbox_image[0];
							$image_atts['data-bricks-lightbox-width']  = $lightbox_image[1];
							$image_atts['data-bricks-lightbox-height'] = $lightbox_image[2];
						
						} else {

							$this->set_attribute( "a-$index", 'src', $lightbox_image[0] );
							$this->set_attribute( "a-$index", 'data-pswp-src', $lightbox_image[0] );
							$this->set_attribute( "a-$index", 'data-pswp-width', $lightbox_image[1] );
							$this->set_attribute( "a-$index", 'data-pswp-height', $lightbox_image[2] );

							$close_a_tag = true;

							echo "<a {$this->render_attributes( "a-$index" )}>";

						}

					}

				}

				$image_atts['class'] = implode( ' ', $image_classes );

				$this->set_attribute( "x-slider_slide-image-$index", 'class', 'x-slider_slide-image' );

				echo "<div {$this->render_attributes( "x-slider_slide-image-$index" )}>";

					if ( 'splide' === $lazyLoad && ! BricksExtras\Helpers::maybePreview() ) {

						$image_atts['loading'] = 'eager';

						$image_atts['src'] = "data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20$lightbox_image[1]%20$lightbox_image[2]'%3E%3C/svg%3E";
						$image_atts['srcset'] = "data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20$lightbox_image[1]%20$lightbox_image[2]'%3E%3C/svg%3E";
						
						$srcset = wp_get_attachment_image_srcset( $item['id'], $size );
						$sizes = wp_get_attachment_image_sizes( $item['id'], $size );

						if ( !!$srcset && !!$sizes && 'disable' !== $maybeSRCSET ) {
							$image_atts['data-splide-lazy'] = $image_correct_size[0];
							$image_atts['data-splide-lazy-srcset'] = $srcset;
							$image_atts['sizes'] = $sizes;
						} else {
							$image_atts['data-splide-lazy']  = $image_correct_size[0];
						}
					} elseif ( 'none' === $lazyLoad ) {
						$image_atts['loading'] = 'eager';
					} else {

					}

					if ( 'disable' === $maybeSRCSET ) {
						add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
					}

					echo wp_get_attachment_image( $item['id'], $size, false, $image_atts );

					if ( 'disable' === $maybeSRCSET ) {
						remove_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
					}

					if ( $caption ) {
						echo '<div class="x-slider_slide-caption">' . $caption . '</div>';
					}

				echo "</div>";

				if ( $close_a_tag ) {
					echo '</a>';
				}

				echo "</" . $slideTag . ">";
			}
		}

		echo "</" . $listTag . ">";
	}
}
