<?php

namespace Tribe\Project\ACF_Meta;

use Tribe\Project\Post_Types;

class Program {

	public function __construct() {

		if ( ! function_exists( 'register_field_group' ) ) {
			return;
		}

		add_action( 'init', [ $this, 'meta_for_programs' ] );
	}

	public function meta_for_programs() {
		if ( ! function_exists( 'register_field_group' ) ) {
			return;
		}

		register_field_group( array(
			'id'         => 'acf_program-information',
			'title'      => 'Program Information',
			'fields'     => array(
				array(
					'key'           => 'field_57af9350e1b5f',
					'label'         => 'Cost',
					'name'          => 'cost',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'            => 'field_57af9366e1b60',
					'label'          => 'Program Start Date',
					'name'           => 'program_start_date',
					'type'           => 'date_picker',
					'date_format'    => 'yymmdd',
					'display_format' => 'dd/mm/yy',
					'first_day'      => 1,
				),
				array(
					'key'            => 'field_57af937fe1b61',
					'label'          => 'Program End Date',
					'name'           => 'program_end_date',
					'type'           => 'date_picker',
					'date_format'    => 'yymmdd',
					'display_format' => 'dd/mm/yy',
					'first_day'      => 1,
				),
				array(
					'key'               => 'field_57af9399e1b62',
					'label'             => 'Date Display Format',
					'name'              => 'date_display_format',
					'type'              => 'radio',
					'choices'           => array(
						'months'          => 'Months',
						'months_and_days' => 'Months and Days',
					),
					'other_choice'      => 0,
					'save_other_choice' => 0,
					'default_value'     => 'months',
					'layout'            => 'vertical',
				),
				array(
					'key'            => 'field_57af93cee1b63',
					'label'          => 'Application Deadline',
					'name'           => 'application_deadline',
					'type'           => 'date_picker',
					'date_format'    => 'yymmdd',
					'display_format' => 'dd/mm/yy',
					'first_day'      => 1,
				),
			),
			'location'   => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => Post_Types\Program::NAME,
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options'    => array(
				'position'       => 'normal',
				'layout'         => 'default',
				'hide_on_screen' => array(),
			),
			'menu_order' => 0,
		) );
	}

}

new Program();
