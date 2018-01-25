<?php get_header(); ?>

<main>

	<?php // Content: Sub-header
	get_template_part( 'content/header/sub' ); ?>

	<div class="content-wrap">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>



			<?php endwhile; ?>

		<?php endif; ?>

	</div><!-- .content-wrap -->

</main><!-- main -->

<?php get_footer(); ?>
