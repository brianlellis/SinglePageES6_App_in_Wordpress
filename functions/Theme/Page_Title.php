<?php


namespace Tribe\Project\Theme;


class Page_Title {
	/**
	 * @return string
	 */
	public function get_title() {

		// Singular
		if ( is_singular() ) {
			$title = get_the_title();
		}

		// Search
		elseif ( is_search() ) {
			$title = 'Search Results';
		}

		// 404
		elseif ( is_404() ) {
			$title = 'Page Not Found (404)';
		}

		else {
			$title = get_the_archive_title();
		}
		
		return $title;
	}
}
