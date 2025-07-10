<?php

/**
 * This is the wordpress default file for loading themes dependecnies
 * @package OLC
 * @version 1.0.0
 */

// theme supports
require(get_parent_theme_file_path('inc/tb-supports.php'));

// load static files css, js, images
require(get_parent_theme_file_path('statics/load-statics.php'));

// Implement the Custom Header feature.
require(get_parent_theme_file_path('inc/tb-customizer.php'));

// Implement the woocommerce feature.
require(get_parent_theme_file_path( 'inc/tb-woocommerce.php' ));

// Implement the sidebar feature.
require(get_parent_theme_file_path('inc/tb-sidebars.php'));

// Implement the custom filters
require(get_parent_theme_file_path('inc/tb-custom-filters.php'));

// Implement the custom hooks
require(get_parent_theme_file_path('inc/tb-custom-hooks.php'));

// Metabox
require(get_parent_theme_file_path('inc/tb-custom-meta.php'));

// icons
require(get_parent_theme_file_path('inc/tb-icons.php'));

// theme required plugins
// require(get_parent_theme_file_path('inc/tb-required-plugins.php'));

// theme inline styles
require(get_parent_theme_file_path('inc/tb-inline-styles.php'));

// cusotm walker menu
require(get_parent_theme_file_path('classes/class-tb-walker-menu.php'));

//Custom tutor utils class
require(get_parent_theme_file_path('classes/class-tb-tutor-utils.php'));

//Custom tutor event model class
require(get_parent_theme_file_path('classes/class-tb-events-model.php'));

// Custom Tutor LMS
require(get_parent_theme_file_path('inc/tb-custom-tutor-function.php'));

// Custom OLC functions
require(get_parent_theme_file_path('inc/tb-custom-functions.php'));

add_action('wp_enqueue_scripts','tb_enqueue_scripts');
function tb_enqueue_scripts(){
    // enqeueu styles
    wp_dequeue_style('tutor');
    wp_enqueue_style('tutor-custom', get_template_directory_uri() . '/assets/css/tutor.css');
    wp_register_style('tutor-reset-css', get_template_directory_uri() . '/assets/css/reset-style.css');
    wp_enqueue_script('tutor-custom-script', get_template_directory_uri() . '/assets/js/custom.js');
}

//add_filter('tutor_preferred_video_sources', 'tb_tutor_preferred_video_sources');
function tb_tutor_preferred_video_sources( $sources ){
    if( isset($sources['embedded']) ) unset($sources['embedded']);
    if( isset($sources['html5']) ) unset($sources['html5']);
    if( isset($sources['shortcode']) ) unset($sources['shortcode']);
    return $sources;
}
function generate_breadcrumb( $categories ){
    $ancestors = array();
    foreach($categories as $category) {
        $term_id = $category->term_id;
        $this_chain = array_reverse(get_term_ancestors( $term_id, 'course-category' ));
        if( count($this_chain) > count($ancestors) ) {
            $ancestors = $this_chain;
        }
    }
    return $ancestors;
}
// generate a wp term ancestor array
function get_term_ancestors( $term_id, $taxonomy ) {
    $ancestors = array();
    $parent = get_term( $term_id, $taxonomy );
    if ( is_wp_error( $parent ) )
        return $parent;
    $ancestors[] = $parent;
    while ( ! empty( $parent->parent ) ) {
        $parent = get_term( $parent->parent, $taxonomy );
        if ( is_wp_error( $parent ) )
            return $parent;
        $ancestors[] = $parent;
    }
    return $ancestors;
}

function theme_prefix_register_elementor_locations( $elementor_theme_manager ) {

	$elementor_theme_manager->register_all_core_location();

}
add_action( 'elementor/theme/register_locations', 'theme_prefix_register_elementor_locations' );


function display_my_select_choices_shortcode() {
    $field = get_field_object('course_type');
    $output = '';

    if ($field['choices']) {
        $output .= '<ul>';
        foreach ($field['choices'] as $value => $label) {
            $output .= '<li>' . esc_html($label) . '</li>';
        }
        $output .= '</ul>';
    }

    return $output;
}

add_shortcode('my_select_choices', 'display_my_select_choices_shortcode');
