<?php

namespace Tribe\Project\Taxonomies;

use Tribe\Project\Post_Types;

/**
 * Contains methods to construct taxonomy mappings.
 */

class Age {

	const NAME = 'program_age';

	public function __construct() {
		add_action( 'init', [ $this, 'register_taxonomy' ], 10 );
		add_action( 'init', [ $this, 'register_taxonomy_for_type' ], 10 );
	}

	/**
	 * Registers the events taxonomy
	 */
	public function register_taxonomy() {

		$labels = [
			'name'              => _x( 'Age Type', 'taxonomy general name' ),
			'singular_name'     => _x( 'Age Type', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Age Types' ),
			'all_items'         => __( 'All Age Types' ),
			'parent_item'       => __( 'Parent Age Type' ),
			'parent_item_colon' => __( 'Parent Age Type:' ),
			'edit_item'         => __( 'Edit Age Type' ),
			'update_item'       => __( 'Update Age Type' ),
			'add_new_item'      => __( 'Add New Age Type' ),
			'new_item_name'     => __( 'New Age Type Name' ),
			'menu_name'         => __( 'Age' ),
			'not_found'         => __( 'No ages found.' ),
		];

		$args = [
			'public'            => true,
			'hierarchical'      => true,
			'exclusive'         => true,
			'meta_box'          => 'radio',
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => [
				'slug'         => 'age',
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

new Age();
