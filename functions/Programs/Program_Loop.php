<?php

namespace Tribe\Project\Programs;

use Tribe\Project\Post_Types\Program;

class Program_Loop {

	/**
	 * Get the query to list all programs
	 *
	 * @param array $args
	 * @return \WP_Query
	 */
	public function get_programs_query( $args = [ ] ) {
		return new \WP_Query( wp_parse_args( $args, [
			'post_type'        => Program::NAME,
			'posts_per_page'   => -1,
			'suppress_filters' => false,
		] ) );
	}
}