<?php

namespace Tribe\Project\ACF_Meta;

class Page {

	public function __construct() {

		if ( ! function_exists( 'register_field_group' ) ) {
			return;
		}

		add_action( 'init', [ $this, 'meta_for_pages' ] );
	}

	public function meta_for_pages() {
		if ( ! function_exists( 'register_field_group' ) ) {
			return;
		}

		register_field_group( array(
			'id'         => 'acf_page-header',
			'title'      => 'Page Header',
			'fields' => array(
				array(
					'key'           => 'field_57af8f00d369e',
					'label'         => 'Color Overlay',
					'name'          => 'color_overlay',
					'type'          => 'select',
					'choices'       => array(
						'none'          => 'None',
						'blue_violet'   => 'Blue to Violet',
						'blue_green'    => 'Blue to Green',
						'orange_pink'   => 'Orange to Pink',
						'pink_violet'   => 'Pink to Violet',
						'yellow_orange' => 'Yellow to Orange',
						'green_teal'    => 'Green to Teal',
					),
					'default_value' => '',
					'allow_null'    => 0,
					'multiple'      => 0,
				),
				array(
					'key'          => 'field_57af90ced369f',
					'label'        => 'Banner Image',
					'name'         => 'banner_image',
					'type'         => 'image',
					'save_format'  => 'object',
					'preview_size' => 'medium',
					'library'      => 'all',
				),
				array(
					'key'               => 'field_57af90e5d36a0',
					'label'             => 'Banner Height',
					'name'              => 'banner_height',
					'type'              => 'radio',
					'choices'           => array(
						'tall'         => 'Tall',
						'short' => 'Short',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => 'tall',
					'layout'            => 'vertical',
				),
				array(
					'key'               => 'field_57af9125d36a1',
					'label'             => 'Page Title Font',
					'name'              => 'page_title_font',
					'type'              => 'radio',
					'choices'           => array(
						'default' => 'Default',
						'lato'    => 'Lato',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => 'default',
					'layout'            => 'vertical',
				),
				array(
					'key'           => 'field_57af919cd36a5',
					'label'         => 'Call to Action Link',
					'name'          => 'call_to_action_link',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'none',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_57af91bfd36a6',
					'label'         => 'Call to Action Text',
					'name'          => 'call_to_action_text',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
			),
			'location'   => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array(
				'position'       => 'normal',
				'layout'         => 'default',
				'hide_on_screen' => array(),
			),
			'menu_order' => 0,
		) );
	}
}

new Page();
