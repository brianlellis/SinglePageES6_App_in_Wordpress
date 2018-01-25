<?php

namespace Tribe\Project\Theme;

class Resources {
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
	}

	public static function enqueue_styles() {
		$css_dir = trailingslashit( get_template_directory_uri() );

		// CSS
		$css_global = 'libs.css';

		// CSS: Libs
		wp_enqueue_style( 'mt-trial-libs-css', $css_dir . 'css/' . $css_global, [ ], '1.0', 'all' );

		// Custom CSS
		wp_enqueue_style( 'mt-trial-custom-css', $css_dir . 'dist/programs-style.bundle.css', [ ], '1.0', 'all' );
	}

	public static function enqueue_scripts() {
		$js_dir = trailingslashit( get_template_directory_uri() ) . 'dist/';
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if (strpos($actual_link,'/programs') !== false) {
			wp_enqueue_script( 'mt-trial-js', $js_dir . 'programs.bundle.js', [ ], '1.0', 'all');
		}
	}
}

new Resources();
