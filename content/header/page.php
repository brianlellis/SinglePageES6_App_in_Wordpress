<?php
/**
 * Standard Page Header
 */

use Tribe\Project\Theme\Util;

$classes        = ['page-header'];
$title_font     = get_field( 'page_title_font' );
$background_img = get_field( 'banner_image' );

// Banner Image
if ( ! empty( $background_img ) ) {
	$classes[]  = 'page-header--has-background-image';
}

// Banner Height
$classes[] = 'page-header--height-' . get_field( 'banner_height' );

// Banner CTA
$cta_link = [
	'url'   => get_field( 'call_to_action_link' ),
	'label' => get_field( 'call_to_action_text' ),
];

?>

<header <?php echo Util::class_attribute( $classes ); ?>>

	<?php // Background Image
	if ( ! empty( $background_img ) ) {
		$args = [
			'as_bg'         => true,
			'use_lazyload'  => false,
			'src_size'      => 'full',
			'wrapper_class' => 'page-header__background_image lazyloaded'
		];
		the_tribe_image( $background_img['id'], $args );
	}
	?>

	<?php // Banner Overlay
	printf( '<div class="page-header__overlay utility__gradient--%s"></div>', esc_attr( get_field( 'color_overlay' ) ) ); ?>

	<div class="content-wrap cw-staggered">

		<?php // Page Title
		$title_classes = ['page-header__title h1'];
		$title_classes[] = sprintf( 'page-header__title--font-%s', esc_attr( $title_font ) );
		printf( '<h1 %s>%s</h1>', Util::class_attribute( $title_classes ), get_page_title() );
		?>

	</div><!-- .content-wrap -->

</header><!-- page-header -->
