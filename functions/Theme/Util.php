<?php


namespace Tribe\Project\Theme;

use Tribe\Project\Taxonomies\Duration;
use Tribe\Project\Taxonomies\Destination;
use Tribe\Project\Taxonomies\Age;
use Tribe\Project\Taxonomies\Area_Of_Interest;

abstract class Util {
	/**
	 * Convert an array into an HTML class attribute string
	 *
	 * @param array $classes
	 * @return string
	 */
	public static function class_attribute( $classes ) {
		if ( empty( $classes ) ) {
			return '';
		}

		return sprintf( ' class="%s"', implode( ' ', array_unique( $classes ) ) );
	}

	public static function url_fetch() {
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$actual_link = preg_replace('/[a-z]{4,5}:\/\/[a-z]+.[a-z0-9]+.[a-z\/-]+/i', '', $actual_link);

		return $actual_link;
	}

	public static function no_display( $url, $data_dur, $data_dest, $data_age, $data_int ) {
		if (strlen($url ) > 0) {
			if (
				(strpos($url ,'duration') !== false && strpos($url , 'duration=' . $data_dur) === false) ||
				(strpos($url ,'destination') !== false && strpos($url , 'destination=' . $data_dest) === false) ||
				(strpos($url ,'age') !== false && strpos($url , 'age=' . $data_age) === false) ||
				(strpos($url ,'interest') !== false && strpos($url , 'interest=' . $data_int) === false)
			) {
			    return 'no-display';
			}
		}
	}
	public static function get_taxonomy_data( $class, $id = false) {
		if ($class === 'Duration') return wp_get_post_terms( get_the_ID(), Duration::NAME, [ 'fields' => 'all' ] );

		if ($class === 'Destination') {
			// Setup the Destinations
			$destinations = [];
			$destinations_ids = [];
			$destination_terms = wp_get_post_terms( get_the_ID(), Destination::NAME, [ 'fields' => 'all' ] );
			if ( ! empty( $destination_terms ) ) {
				foreach ( $destination_terms as $destination ) {
					$destinations[] = sprintf( '<a href="%s">%s</a>', '#', $destination->name );
					$destinations_ids[] = $destination->term_id;
				}
			}
			if ($id === true) {
				return $destinations_ids;
			} else {
				return $destinations;
			}
		}
		if ($class === 'Age') return wp_get_post_terms( get_the_ID(), Age::NAME, [ 'fields' => 'all' ] );
		if ($class === 'Interest') return wp_get_post_terms( get_the_ID(), Area_Of_Interest::NAME, [ 'fields' => 'all' ] );
	}
	public static function get_term_ids( $term_id ) {
		if ($term_id === 'Duration' || $term_id === 'Age' || $term_id === 'Interest') {
			$term_id = Util::get_taxonomy_data($term_id);
			return $term_id[0]->term_id;
		}
		else if ($term_id === 'Destination') {
			$term_id = Util::get_taxonomy_data($term_id, true);
			return implode(',', $term_id);
		}
	}
}