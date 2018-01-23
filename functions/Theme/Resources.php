<?php

namespace Tribe\Project\Theme;

class Resources {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public static function enqueue_styles() {
		$css_dir = trailingslashit( get_template_directory_uri() ) . 'css/';

		// CSS
		$css_global = 'libs.css';

		// CSS: Libs
		wp_enqueue_style( 'mt-trial-libs-css', $css_dir . $css_global, [ ], '1.0', 'all' );
	}

	public static function enqueue_scripts() {
		$js_dir = trailingslashit( get_template_directory_uri() ) . 'js/';
	}
}

new Resources();
