<?php

namespace Tribe\Project\Theme;

class Media {
	private $sizes = [
		'card' => [         // Card (Desktop): Landscape size used around the site for card listings/display.
			'width'  => 370,
			'height' => 210,
			'crop'   => true,
		],
	];

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'register_sizes' ], 10, 0 );
	}

	public function register_sizes() {
		foreach ( $this->sizes as $key => $attributes ) {
			add_image_size( $key, $attributes[ 'width' ], $attributes[ 'height' ], $attributes[ 'crop' ] );
		}
	}
}

new Media();
