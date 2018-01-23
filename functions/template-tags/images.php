<?php

/**
 * Reusable lazyload image get/print with srcset support. Supports src, srcset,
 * background image or inline, linkify or not, html append. Tied into the js lib lazysizes for lazyloading.
 *
 *  Defaults:
 *
 * 'as_bg' => false,          // us this as background on wrapper?
 * 'auto_shim' => true,       // if true, shim dir as set will be used, src_size will be used as filename, with png as filetype
 * 'auto_sizes_attr' => false,// if lazyloading the lib can auto create sizes attribute.
 * 'echo' => true,            // whether to echo or return the html
 * 'expand' => '200',         // the expand attribute is the threshold used by lazysizes. use negative to reveal once in viewport.
 * 'html' => '',              // append an html string in the wrapper
 * 'img_class' => '',         // pass classes for image tag. if lazyload is true class "lazyload" is auto added
 * 'img_attr' => '',          // additional image attributes
 * 'link' => '',              // pass a link to wrap the image
 * 'link_target' => '_self',  // pass a link target
 * 'parent_fit' => 'width',   // if lazyloading this combines with object fit css and the object fit polyfill
 * 'shim' => '',              // supply a manually specified shim for lazyloading. Will override auto_shim whether true/false.
 * 'src' => true,             // set to false to disable the src attribute. this is a fallback for non srcset browsers
 * 'src_size' => 'large',     // this is the main src registered image size
 * 'srcset_sizes' => [ ],     // this is registered sizes array for srcset.
 * 'srcset_sizes_attr' => '(min-width: 1260px) 1260px, 100vw', // this is the srcset sizes attribute string used if auto is false.
 * 'use_lazyload' => true,    // lazyload this game?
 * 'use_srcset' => true,      // srcset this game?
 * 'use_wrapper' => true,     // use the wrapper if image
 * 'wrapper_attr' => '',      // additional wrapper attributes
 * 'wrapper_class' => 'tribe-image', // pass classes for figure wrapper. If as_bg is set true gets auto class of "lazyload"
 * 'wrapper_tag' => '',       // html tag for the wrapper/background image container
 *
 * @param $image_id int
 * @param $options array
 *
 * @return string
 */

function the_tribe_image( $image_id = 0, $options = [] ) {

	// they didn't supply an image id
	if ( empty( $image_id ) ) {
		return '';
	}

	$image = new \Tribe\Project\Theme\Image( $image_id, $options );
	$html = $image->render();
	if ( $image->option( 'echo' ) ) {
		echo $html;
		return '';
	} else {
		return $html;
	}

}
