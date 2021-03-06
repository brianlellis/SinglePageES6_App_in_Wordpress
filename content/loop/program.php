<?php
/**
 * Program Loop Item
 */

use Tribe\Project\Theme\Util;

$actual_link = Util::url_fetch();

$classes        = [ 'program', 'card' ];
$cost           = '$' . round( rand( 200, 4000 ), -2 );
$offered        = [
	get_field( 'program_start_date' ),
	get_field( 'program_end_date' )
];
$durations      = Util::get_taxonomy_data('Duration');
$destinations   = Util::get_taxonomy_data('Destination');
$destinations_ids   = Util::get_taxonomy_data('Destination', true);

$age   		= Util::get_taxonomy_data('Age');
$interest 	= Util::get_taxonomy_data('Interest');

$data_dur 	= Util::get_term_ids('Duration');
$data_dest	= Util::get_term_ids('Destination');
$data_age	= Util::get_term_ids('Age');
$data_int	= Util::get_term_ids('Interest');

$classes[] 	= Util::no_display($actual_link, $data_dur, $data_dest, $data_age, $data_int);

?>

<article
	<?php echo Util::class_attribute( $classes ); ?> 
	data-duration="<?php echo $data_dur ?>"
	data-destination="<?php echo $data_dest ?>"
	data-age="<?php echo $data_age ?>"
	data-interest="<?php echo $data_int ?>"
>
	<header>
		<?php // Feature Image ?>
		<figure class="program__image card__image">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php
				if ( has_post_thumbnail() ) {
					$args = [
						'use_lazyload'    => false,
						'src_size'        => 'card',
					];
					the_tribe_image( get_post_thumbnail_id(), $args );
				} else {
					printf(
						'<img src="%s" alt="%s" />',
						trailingslashit( get_template_directory_uri() ) . 'screenshot.png',
						get_the_title()
					);
				}
				?>
			</a>
		</figure><!-- .program__image -->
		
		<?php // Title ?>
		<h3 class="program__title card__title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h3><!-- .program__title -->

	</header>


	<ul class="program-specs card__specs">

		<?php

		// Destinations
		if ( ! empty( $destinations ) ) {
			echo '<li class="program-specs__destination">';
			printf( '<span class="label">%s</span>', _n( 'Destination', 'Destinations', count( $destinations ) ) );
			printf( '<span class="value">%s</span>', implode( ', ', $destinations ) );
			echo '</li>';
		}

		// Duration
		if ( ! empty( $durations ) ) {
			echo '<li class="program-specs__duration">';
			printf( '<span class="label">%s</span>', __( 'Duration' ) );
			printf( '<span class="value">%s</span>', $durations[0]->name );
			echo '</li>';
		}

		// Cost
		if ( ! empty( $cost ) ) {
			echo '<li class="program-specs__cost">';
			printf( '<span class="label">%s</span>', __( 'Cost' ) );
			printf( '<span class="value">%s</span>', $cost );
			echo '</li>';
		}

		// offered
		if ( ! empty( $offered ) ) {
			echo '<li class="program-specs__offered">';
			printf( '<span class="label">%s</span>', __( 'Offered In' ) );
			echo '<ul class="value">';
			foreach ( $offered  as $dates ) {
				printf( '<li>%s</li>', $dates );
			}
			echo '</ul>';
			echo '</li>';
		}

		?>

	</ul><!-- .program__details-specs -->

</article><!-- .program -->