<?php
/**
 * Theme functions
 */


// Core Theme Plugin
add_action( 'after_setup_theme', 'trial_theme_setup' );

if ( ! function_exists( 'trial_theme_setup' ) ):

	function trial_theme_setup() {

		// post types
		include_once 'functions/Post_Types/Program.php';

		// taxonomies
		include_once 'functions/Taxonomies/Age.php';
		include_once 'functions/Taxonomies/Area_Of_Interest.php';
		include_once 'functions/Taxonomies/Destination.php';
		include_once 'functions/Taxonomies/Duration.php';
		include_once 'functions/Taxonomies/Top_Picks.php';

		// acf meta
		include_once 'functions/ACF_Meta/Page.php';
		include_once 'functions/ACF_Meta/Program.php';

		// programs
		include_once 'functions/Programs/Filters.php';
		include_once 'functions/Programs/Program_Loop.php';

		// theme
		include_once 'functions/Theme/Resources.php';
		include_once 'functions/Theme/Media.php';
		include_once 'functions/Theme/Image.php';
		include_once 'functions/Theme/Util.php';
		include_once 'functions/Theme/Page_Title.php';

		// template tags
		include_once 'functions/template-tags/images.php';
		include_once 'functions/template-tags/content.php';
	}

endif; // core_theme_setup
