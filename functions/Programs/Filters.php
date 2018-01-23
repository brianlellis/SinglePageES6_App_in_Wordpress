<?php

namespace Tribe\Project\Programs;

use Tribe\Project\Taxonomies\Duration;
use Tribe\Project\Taxonomies\Age;
use Tribe\Project\Taxonomies\Area_Of_Interest;
use Tribe\Project\Taxonomies\Destination;

class Filters {

	public function get_filter_data() {
		$filter_data = [ ];

		$filter_data[] = [
			'label' => __( 'Destination' ),
			'slug'  => 'destination',
			'data'  => $this->get_taxonomy_list( Destination::NAME ),
		];

		$filter_data[] = [
			'label' => __( 'Duration' ),
			'slug'  => 'duration',
			'data'  => $this->get_taxonomy_list( Duration::NAME ),
		];

		$filter_data[] = [
			'label' => __( 'Your Age' ),
			'slug'  => 'age',
			'data'  => $this->get_taxonomy_list( Age::NAME ),
		];

		$filter_data[] = [
			'label' => __( 'Area of Interest' ),
			'slug'  => 'aoi',
			'data'  => $this->get_taxonomy_list( Area_Of_Interest::NAME ),
		];

		return $filter_data;
	}

	private function get_taxonomy_list( $name = '', $key_property = 'term_id', $value_property = 'name', array $args = [ ] ) {
		$args = wp_parse_args( $args, [
			'taxonomy' => $name,
		] );
		$terms = get_terms( $args );
		$list = [ ];
		foreach ( $terms as $term ) {
			$list[ $term->$key_property ] = $term->$value_property;
		}
		return $list;
	}

}
