<?php
/**
 * The template for displaying posts archives
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OLC
 */

get_header();

global $wp_query;
?>

<main id="primary" class="site-main">
    <div class="rbt-page-banner-wrapper">
        <!-- Start Banner BG Image  -->
        <div class="rbt-banner-image"></div>
        <!-- End Banner BG Image  -->
        <div class="rbt-banner-content">
            <!-- Start Banner Content Top  -->
            <div class="rbt-banner-content-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Start Breadcrumb Area  -->
                            <ul class="page-list">
                                <li class="rbt-breadcrumb-item"><a href="<?php home_url('/'); ?>">Home</a></li>
                                <li>
                                    <div class="icon-right"><i class="feather-chevron-right"></i></div>
                                </li>
                                <li class="rbt-breadcrumb-item active"><?php _e('All Event', 'open-learning'); ?></li>
                            </ul>
                            <!-- End Breadcrumb Area  -->

                            <div class=" title-wrapper">
                                <h1 class="title mb--0"><?php _e('All Event', 'open-learning'); ?></h1>
                                <a href="#" class="rbt-badge-2">
                                    <div class="image">🎉</div> <?php echo esc_html($wp_query->found_posts); ?> Events
                                </a>
                            </div>
                            <p class="description">Event that help beginner designers become true unicorns. </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Banner Content Top  -->
        </div>
    </div>
    <div class="rbt-counterup-area rbt-section-overlayping-top rbt-section-gapBottom">
        <div class="container">
            <div class="row row--30 gy-5">
                <div class="col-lg-4 col-xl-3 order-2 order-lg-1">
                    <aside class="rbt-sidebar-widget-wrapper rbt-gradient-border">
                        <!-- Start Widget Area  -->
                        <div class="rbt-single-widget rbt-widget-categories has-show-more">
                            <div class="inner">
                                <h4 class="rbt-widget-title"><?php _e('Categories', 'open-learning'); ?></h4>
                                <?php
                                    $event_cats = get_terms(array(
                                        'taxonomy'      => 'olc_event_category',
                                        'hide_empty'    => false
                                    ));

                                    if(!empty($event_cats)):
                                ?>
                                <ul class="rbt-sidebar-list-wrapper categories-list-check has-show-more-inner-content">
                                    <?php foreach( $event_cats as $category ): ?>
                                    <li class="rbt-check-group">
                                        <input id="cat-list-1" type="checkbox" name="event_cat" value="<?php echo esc_html($category->term_id); ?>">
                                        <label for="cat-list-1"><?php echo esc_html($category->name); ?><span class="rbt-lable count">15</span></label>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                            <div class="rbt-show-more-btn">Show More</div>
                        </div>
                        <!-- End Widget Area  -->

                        <!-- Start Widget Area  -->
                        <div class="rbt-single-widget rbt-widget-recent">
                            <div class="inner">
                                <h4 class="rbt-widget-title"><?php _e('Recent Events', 'open-learning'); ?></h4>
                                <?php
                                    $recent_events = new WP_Query(array(
                                        'post_type'     => 'olc_events',
                                        'post_status'   => 'publish',
                                        'posts_per_page'    => 5,
                                        'orderby'       => 'DESC',
                                    ));

                                    if( $recent_events->have_posts() ):
                                ?>
                                <ul class="rbt-sidebar-list-wrapper recent-post-list">
                                    <?php while($recent_events->have_posts()): $recent_events->the_post(); 
                                        $_event_thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                                        $_placeholder_img = olc_get_placeholder_img();
                                    ?>
                                    <li>
                                        <div class="thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo !$_event_thumbnail? $_placeholder_img : $_event_thumbnail; ?>" alt="<?php echo esc_html(get_the_title()); ?>">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h6 class="title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h6>
                                            <ul class="rbt-meta">
                                                <li><i class="feather-clock"></i><?php echo get_the_date('F j, Y'); ?></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php endwhile;  wp_reset_postdata(); ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- End Widget Area  -->

                        <!-- Start Widget Area  -->
                        <div class="rbt-single-widget rbt-widget-tag">
                            <div class="inner">
                                <h4 class="rbt-widget-title"><?php _e('Event Tags', 'open-learning'); ?></h4>
                                <?php
                                    $event_tags = get_terms(array(
                                        'taxonomy'  => 'olc_event_tag'
                                    ));

                                    if(!empty($event_tags)):
                                ?>
                                <div class="rbt-sidebar-list-wrapper rbt-tag-list">
                                    <?php
                                        foreach($event_tags as $tag){
                                            echo '<a href="'.get_term_link($tag).'">'.esc_html($tag->name).'</a>';
                                        }
                                    ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- End Widget Area  -->
                    </aside>
                </div>
                <div class="col-lg-8 col-xl-9 order-1 order-lg-2">
                    <div class="row g-5">
                        <?php while(have_posts()): the_post(); 
                            $event_location = function_exists('get_field')? get_field('location', get_the_ID()) : '';
                            $event_start_datetime = function_exists('get_field')? get_field('start_date_time', get_the_ID()) : '';
                            $event_end_datetime = function_exists('get_field')? get_field('end_date_time', get_the_ID()) : '';

                            $event_start_time = !empty($event_start_datetime)? date('hh:mm a', strtotime($event_start_datetime)) : '';
                            $event_end_time = !empty($event_end_datetime)? date('hh:mm a', strtotime($event_end_datetime)) : '';


                            $event_time = sprintf('%s - %s', $event_start_time, $event_end_time);
                            $_event_thumbnail = get_the_post_thumbnail_url( get_the_ID(), 'large' );
                            $_placeholder_img = olc_get_placeholder_img();
                        ?>
                        <!-- Start Single Event  -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="rbt-card event-grid-card variation-01 rbt-hover">
                                <div class="rbt-card-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo !$_event_thumbnail? $_placeholder_img : $_event_thumbnail; ?>" alt="<?php echo esc_html(get_the_title()); ?>">
                                        <div class="rbt-badge-3 bg-white">
                                            <span><?php echo get_the_date('d M'); ?></span>
                                            <span><?php echo get_the_date('Y'); ?></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="rbt-card-body">
                                    <ul class="rbt-meta">
                                        <li><i class="feather-map-pin"></i><?php echo esc_html($event_location); ?></li>
                                        <li><i class="feather-clock"></i><?php echo esc_html($event_time); ?></li>
                                    </ul>
                                    <h4 class="rbt-card-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_the_title()); ?></a></h4>

                                    <div class="read-more-btn">
                                        <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round" href="<?php the_permalink(); ?>">
                                            <span class="icon-reverse-wrapper">
                                                <span class="btn-text"><?php _e('Get Ticket', 'open-learning'); ?></span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Event  -->
                        <?php endwhile; ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mt--60">
                            <nav>
                                <ul class="rbt-pagination">
                                    <?php
                                        get_template_part('template-parts/pagination');
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>
</main><!-- #main -->
<?php
get_footer();
