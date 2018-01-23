<?php

namespace Tribe\Project\Post_Types;

class Program {
	const NAME = 'program';

	public function __construct() {

		add_action( 'init', [ $this, 'create_post_type' ], 10 );
	}

	/**
	 * Registers the People post type
	 */
	public function create_post_type() {

		$labels = [
			'name'               => __( 'Programs' ),
			'single_name'        => __( 'Program' ),
			'add_new_item'       => __( 'Add New Program' ),
			'edit_item'          => __( 'Edit Program' ),
			'new_item'           => __( 'New Program' ),
			'all_items'          => __( 'All Programs' ),
			'view_item'          => __( 'View Program' ),
			'search_items'       => __( 'Search Programs' ),
			'not_found'          => __( 'No programs found' ),
			'not_found_in_trash' => __( 'No programs found in the Trash' ),
			'parent_item_colon'  => __( '' ),
			'menu_name'          => __( 'Programs' ),
		];
		$args = [
			'labels'            => $labels,
			'public'            => true,
			'has_archive'       => false,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'menu_position'     => 5,
			'rewrite'           => [ 'slug' => 'programs', 'with_front' => false ],
			'map_meta_cap'      => true,
			'capability_type'   => 'post',
			'supports'          => [ 'title', 'editor', 'thumbnail' ],
			'show_in_rest'      => true,
		];

		register_post_type( self::NAME, $args );

	}

}

new Program();
