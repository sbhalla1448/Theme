<?php
/**
 * Header
 */

global $post;
get_template_part( 'template-parts/site-start' );
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
	$header_style = (!is_null($post) && !empty(get_post_meta($post->ID, 'header_style', true)))? get_post_meta($post->ID, 'header_style', true) : 'header-style-2';
    get_template_part( 'template-parts/header/'.$header_style.'/header' );
}
?>
