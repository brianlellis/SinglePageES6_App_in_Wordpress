<?php

namespace Tribe\Project\Taxonomies;

use Tribe\Project\Post_Types;

/**
 * Contains methods to construct taxonomy mappings.
 */

class Area_Of_Interest {

	const NAME = 'program_area_of_interest';

	public function __construct() {
		add_action( 'init', [ $this, 'register_taxonomy' ], 10 );
		add_action( 'init', [ $this, 'register_taxonomy_for_type' ], 10 );
	}

	/**
	 * Registers the events taxonomy
	 */
	public function register_taxonomy() {

		$labels = [
			'name'              => _x( 'Area of Interest', 'taxonomy general name' ),
			'singular_name'     => _x( 'Area of Interest', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Area of Interests' ),
			'all_items'         => __( 'All Area of Interests' ),
			'parent_item'       => __( 'Parent Area of Interest' ),
			'parent_item_colon' => __( 'Parent Area of Interest:' ),
			'edit_item'         => __( 'Edit Area of Interest' ),
			'update_item'       => __( 'Update Area of Interest' ),
			'add_new_item'      => __( 'Add New Area of Interest' ),
			'new_item_name'     => __( 'New Area of Interest Name' ),
			'menu_name'         => __( 'Area of Interest' ),
			'not_found'         => __( 'No Area of Interests found.' ),
		];

		$args = [
			'public'            => true,
			'hierarchical'      => true,
			'exclusive'         => false,
			'meta_box'          => 'simple',
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => [
				'slug'         => 'aoi',
				'with_front'   => false,
				'hierarchical' => true,
			],
		];

		register_taxonomy(
			self::NAME,
			[
				Post_Types\Program::NAME,
			],
			$args
		);
	}

	public function register_taxonomy_for_type() {

		register_taxonomy_for_object_type( self::NAME, Post_Types\Program::NAME );
	}

}

new Area_Of_Interest();
