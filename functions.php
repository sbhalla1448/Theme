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
    $theme = wp_get_theme(); // Get WP_Theme object for the current theme
    $theme_version = $theme->get('Version');
    wp_dequeue_style('tutor');
    wp_enqueue_style('tutor-custom', get_template_directory_uri() . '/assets/css/tutor.css', array(), $theme_version);
    wp_register_style('tutor-reset-css', get_template_directory_uri() . '/assets/css/reset-style.css', array(), $theme_version);
    wp_enqueue_script('tutor-custom-script', get_template_directory_uri() . '/assets/js/custom.js',array(), $theme_version);
    wp_localize_script('tutor-custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

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


function theme_truncate( $string, $length = 100, $append = '&hellip;' ) {
$string = trim( $string );

if ( strlen( $string ) > $length ) {
    $string = wordwrap( $string, $length );
    $string = explode( "\n", $string, 2 );
    $string = $string[0] . $append;
}

return $string;}



function custom_courses_shortcode() {?>
<div class="courses-tab-wrap">
<div class="common-wrap clear">
<div class="tab-wrap">
                        <div class="tab-triger flex ">
                            <?php
                                $course_types = array(
                                    'featured' => 'Featured',
                                    'popular' => 'Popular',  
                                    'trending' => 'Trending',
                                    'latest' => 'Latest',  
                                );

                               if(!empty($course_types)) {
                                   $i = 1;

                               echo '<ul class="tab-title-wrap flex">';

                                foreach ($course_types as $value => $label) {

                                    $post_in_term = new WP_Query(array(
                                        'post_type' => 'courses',
                                        'post_status' => 'publish',          
                                        'meta_key' => 'course_type',
                                        'meta_value' => $value,
                                    ));	
							?>

                                <li class="<?php if($i == 1) echo 'tab-active'; ?>">
                                    <a href="#<?php echo $value; ?>"><?php echo $label; ?></a>
                                </li>
                            <?php
                                   $i++; }
                               echo"</ul>";
                               }
							?>
                        </div>
                        <div class="tab-item-wrap">
                        <?php
							if(!empty($course_types)) {
								$count = 1;
								foreach($course_types as $value => $label) {
						?>
                            <div class="tab-item <?php if($count== 1) echo 'all-article'; ?>" id="<?php echo $value; ?>">
                                <div class="article-wrap flex animatedView">
                                   <?php 
								   $loop = new WP_Query(array(
								   'post_type' => 'courses',
                                    'post_status' => 'publish',          
                                    'meta_key' => 'course_type',
                                    'meta_value' => $value,
									 'posts_per_page' => '5',
								   
								   ));

								   while($loop->have_posts()) : $loop->the_post();
								   ?>
                                   <?php
                                    /**
                                     * Usage Idea, you may keep a loop within a wrap, such as bootstrap col
                                     *
                                     * @hook tutor_course/archive/before_loop_course
                                     * @type action
                                     */
                                    do_action( 'tutor_course/archive/before_loop_course' );

                                    tutor_load_template( 'loop.course' );

                                    /**
                                     * Usage Idea, If you start any div before course loop, you can end it here, such as </div>
                                     *
                                     * @hook tutor_course/archive/after_loop_course
                                     * @type action
                                     */
                                    do_action( 'tutor_course/archive/after_loop_course' );
                                ?>
                                    <?php endwhile;
									wp_reset_postdata();
									?>
                                   
                                </div>
                            </div>
                        <?php $count++; } } ?>
                        </div>
                    </div>
	 </div>
	 </div>
<?php
    return;
}


add_shortcode('coursestab', 'custom_courses_shortcode');

// Redirect issue fixed
function remove_feed_endpoint() {
    $url = esc_url_raw(home_url(add_query_arg(NULL, NULL)));
    if (strpos($url, '/feed') !== false) {
        $url_without_feed = rtrim($url, '/feed/');
        wp_redirect( $url_without_feed, 301 );
        exit;
    }
}
add_action('init', 'remove_feed_endpoint');



// Search filter
add_shortcode('searchandfilter', 'custom_searchbox_filter');
function custom_searchbox_filter($atts) {
    // Extract shortcode attributes
    $unique_id = uniqid('searchfilter_');
    $atts = shortcode_atts(
        array(
            'search_placeholder' => '', // Default placeholder text
            'post_types' => 'courses', // Default post type
            'fields' => 'search', // Default fields
        ),
        $atts,
        'custom_searchbox_filter'
    );

    // Output the search form with dynamic attributes
    ob_start();
    ?>
    <div class="search-container" id="search-container">
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="searchform">
        <input type="search" value="" name="s" class="search-input" id="<?php echo esc_attr($unique_id); ?>" placeholder="<?php echo esc_attr($atts['search_placeholder']); ?>" />
        <input type="hidden" name="post_type" value="<?php echo esc_attr($atts['post_types']); ?>" />
        <input type="submit">  
    </form>
    <div id="search-results" class="search-results"></div> <!-- Search results container outside the form -->
</div>
    <?php
    return ob_get_clean();
}


add_action('wp_ajax_search_courses', 'search_courses');
add_action('wp_ajax_nopriv_search_courses', 'search_courses');

function search_courses() {
    echo '<div class=search-results-content>';
    if(isset($_GET['s'])) {
        $search_query = sanitize_text_field($_GET['s']);
        $args = array(
            'post_type' => 'courses',
            's' => $search_query,
            'post_status' => 'publish',          
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                // Get the post title
                $post_title = get_the_title();
                // Highlight search text within post title
                $highlighted_title = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<mark>$1</mark>', $post_title);
                
                // Display your search results here
                if (has_post_thumbnail()) {
                    // Get the post thumbnail URL
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), array(50, 50));                 
                    // Output the featured image along with the title and link
                    echo '<div><a class="title" href="' . get_the_permalink() . '"><img src="' . $thumbnail_url . '"  />' . $highlighted_title . '</a></div>';
                } else {
                    // If no featured image, just output the title and link
                    echo '<div><a class="title" href="' . get_the_permalink() . '">' . $highlighted_title . '</a></div>';
                }
            }
        } else {
            echo esc_html__('No courses found for search term: ', 'open-learning') .'<mark>'.$search_query.'<mark>';
        }
        wp_reset_postdata();
    } else {
        echo ''; // Return empty string if no search query provided
    }
    echo '</div>';
    die();
}