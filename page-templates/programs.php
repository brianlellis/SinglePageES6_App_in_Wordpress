<?php
/**
 * Template Name: Programs
 */

get_header(); ?>

	<main>

		<?php // Content: Page Header
		get_template_part( 'content/header/page' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="content-wrap">

				<?php // Content: Program Loop
				get_template_part( 'content/page/programs' ); ?>

			</div><!-- .content-wrap -->

		<?php endwhile; ?>

	</main><!-- main -->

<?php get_footer(); ?>