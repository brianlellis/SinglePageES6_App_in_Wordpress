<?php

namespace Tribe\Project\Taxonomies;

use Tribe\Project\Post_Types;

/**
 * Contains methods to construct taxonomy mappings.
 */

class Duration {

	const NAME = 'program_duration';

	public function __construct() {
		add_action( 'init', [ $this, 'register_taxonomy' ], 10 );
		add_action( 'init', [ $this, 'register_taxonomy_for_type' ], 10 );
	}

	/**
	 * Registers the events taxonomy
	 */
	public function register_taxonomy() {

		$labels = [
			'name'              => _x( 'Duration', 'taxonomy general name' ),
			'singular_name'     => _x( 'Duration', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Durations' ),
			'all_items'         => __( 'All Durations' ),
			'parent_item'       => __( 'Parent Duration' ),
			'parent_item_colon' => __( 'Parent Duration:' ),
			'edit_item'         => __( 'Edit Duration' ),
			'update_item'       => __( 'Update Duration' ),
			'add_new_item'      => __( 'Add New Duration' ),
			'new_item_name'     => __( 'New Duration Name' ),
			'menu_name'         => __( 'Duration' ),
			'not_found'         => __( 'No durations found.' ),
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

new Duration();
