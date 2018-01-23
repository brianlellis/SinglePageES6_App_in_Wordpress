<?php

namespace Tribe\Project\Taxonomies;

use Tribe\Project\Post_Types;

/**
 * Contains methods to construct taxonomy mappings.
 */

class Top_Picks {

	const NAME = 'program_top_picks';

	public function __construct() {
		add_action( 'init', [ $this, 'register_taxonomy' ], 10 );
		add_action( 'init', [ $this, 'register_taxonomy_for_type' ], 10 );
	}

	/**
	 * Registers the events taxonomy
	 */
	public function register_taxonomy() {

		$labels = [
			'name'              => _x( 'Top Picks', 'taxonomy general name' ),
			'singular_name'     => _x( 'Top Picks', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Top Picks' ),
			'all_items'         => __( 'All Top Pickss' ),
			'parent_item'       => __( 'Parent Top Picks' ),
			'parent_item_colon' => __( 'Parent Top Picks:' ),
			'edit_item'         => __( 'Edit Top Picks' ),
			'update_item'       => __( 'Update Top Picks' ),
			'add_new_item'      => __( 'Add New Top Picks' ),
			'new_item_name'     => __( 'New Top Picks Name' ),
			'menu_name'         => __( 'Top Picks' ),
			'not_found'         => __( 'No top picks found.' ),
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
				'slug'         => 'top-picks',
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

new Top_Picks();
