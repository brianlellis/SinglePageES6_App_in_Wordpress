<?php

namespace Tribe\Project\Taxonomies;

use Tribe\Project\Post_Types;

/**
 * Contains methods to construct taxonomy mappings.
 */

class Destination {

	const NAME = 'program_destination';

	public function __construct() {
		add_action( 'init', [ $this, 'register_taxonomy' ], 10 );
		add_action( 'init', [ $this, 'register_taxonomy_for_type' ], 10 );
	}

	/**
	 * Registers the events taxonomy
	 */
	public function register_taxonomy() {

		$labels = [
			'name'              => _x( 'Destination', 'taxonomy general name' ),
			'singular_name'     => _x( 'Destination', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Destinations' ),
			'all_items'         => __( 'All Destinations' ),
			'parent_item'       => __( 'Parent Destination' ),
			'parent_item_colon' => __( 'Parent Destination:' ),
			'edit_item'         => __( 'Edit Destination' ),
			'update_item'       => __( 'Update Destination' ),
			'add_new_item'      => __( 'Add New Destination' ),
			'new_item_name'     => __( 'New Destination Name' ),
			'menu_name'         => __( 'Destination' ),
			'not_found'         => __( 'No destinations found.' ),
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
				'slug'         => 'destination',
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

new Destination();
