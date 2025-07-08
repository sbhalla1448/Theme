<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OLC
 */

get_header();

$event_descriptions = get_the_content();
$event_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large')? get_the_post_thumbnail_url(get_the_ID(), 'large') : olc_get_placeholder_img();
$event_faqs = function_exists('get_field')? get_field('faqs') : array();
$event_type = function_exists('get_field')? get_field('type') : array();
$event_start_date = function_exists('get_field')? get_field('start_date_time') : get_the_date();
$event_end_date = function_exists('get_field')? get_field('end_date_time') : get_the_date();
$event_location = function_exists('get_field')? get_field('location') : '';
$event_language = function_exists('get_field')? get_field('language') : '';
$event_instructors = function_exists('get_field')? get_field('instructors') : array();
$event_contacts = function_exists('get_field')? get_field('contact_no') : '';
?>

<div class="rbt-breadcrumb-default rbt-breadcrumb-style-3">
    <div class="breadcrumb-inner">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="content">
                    <div class="content text-start">
                        <ul class="page-list">
                            <li class="rbt-breadcrumb-item">
                                <a href="<?php echo home_url('/'); ?>"><?php _e('Home','open-learning'); ?></a>
                            </li>
                            <li>
                                <div class="icon-right"><i class="feather-chevron-right"></i></div>
                            </li>
                            <?php 
                                $event_categories = get_the_terms( get_the_ID(), 'olc_event_category' );
                                if(!empty($event_categories)):
                            ?>
                                <?php foreach($event_categories as $event_cat): ?>
                                <li class="rbt-breadcrumb-item active">
                                    <a href="<?php echo get_term_link($event_cat); ?>"><?php echo esc_html($event_cat->name); ?></a>
                                </li>
                                <li>
                                    <div class="icon-right"><i class="feather-chevron-right"></i></div>
                                </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <h2 class="title mb--0"><?php single_post_title(); ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area -->

<div class="rbt-course-details-area rbt-section-gap">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="course-details-content">

                    <div class="rbt-feature-box rbt-shadow-box thuumbnail">
                        <img class="w-100" src="<?php echo esc_url($event_thumbnail); ?>" alt="<?php echo get_the_title(); ?>">
                    </div>

                    <!-- Start Course Feature Box  -->
                    <div class="rbt-feature-box rbt-shadow-box mt--60 event-descriptions">
                        <div class="row g-5">
                            <!-- Start Feture Box  -->
                            <div class="col-lg-12">
                                <div class="section-title">
                                    <h4 class="title mb--20"><?php _e('Event Description', 'open-learning'); ?></h4>
                                </div>
                                <?php echo wp_kses_post($event_descriptions); ?>
                            </div>
                            <!-- End Feture Box  -->
                        </div>
                    </div>
                    <!-- End Course Feature Box  -->

                    <!-- Start Course Content  -->
                    <div class="course-content rbt-shadow-box mt--60">
                        <div class="section-title">
                            <h4 class="title mb--0"><?php _e('Event FAQ', 'open-learning'); ?></h4>
                        </div>
                        <?php
                            if(!empty($event_faqs)):
                        ?>
                        <div class="rbt-accordion-style rbt-accordion-02 accordion mt--45">
                            <div class="accordion" id="accordionExampleb2">
                                <?php $count = 1; foreach($event_faqs as $faq): ?>
                                <div class="accordion-item card">
                                    <h2 class="accordion-header card-header" id="headingTwo<?php echo $count; ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo<?php echo $count; ?>" aria-expanded="true"
                                            aria-controls="collapseTwo<?php echo $count; ?>">
                                            <?php echo esc_html($faq['question']); ?>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo<?php echo $count; ?>" class="accordion-collapse collapse <?php echo $count == 1? 'show' : ''; ?>"
                                        aria-labelledby="headingTwo<?php echo $count; ?>" data-bs-parent="#accordionExampleb2">
                                        <div class="accordion-body card-body">
                                            <?php echo $faq['answer']; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $count++; endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- End Course Content  -->

                    <!-- Start Intructor Area  -->
                    <div class="rbt-participants-area mt--60">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-start mb--20">
                                    <span class="subtitle bg-secondary-opacity"><?php _e('Event Participants', 'open-learning'); ?></span>
                                    <h2 class="title"><?php _e('Event Participants', 'open-learning'); ?></h2>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(!empty($event_instructors)):
                        ?>
                        <div class="row g-5">
                            <?php foreach($event_instructors as $instructor):?>
                            <!-- Start Single Team  -->
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="rbt-team team-style-default style-two rbt-hover">
                                    <div class="inner">
                                        <div class="thumbnail"><?php echo $instructor['user_avatar']; ?></div>
                                        <div class="content">
                                            <h2 class="title"><?php echo esc_html(ucwords($instructor['display_name'])); ?></h2>
                                            <h6 class="subtitle theme-gradient"><?php echo esc_html($instructor['user_email']); ?></h6>
                                            <span class="team-form">
                                                <i class="feather-map-pin"></i>
                                                <span class="location"><?php echo esc_html($instructor['user_email']); ?></span>
                                            </span>
                                            <p class="description"><?php echo esc_html($instructor['user_description']); ?></p>
                                            <ul class="social-icon social-default icon-naked mt--20">
                                                <li><a href="https://www.facebook.com/">
                                                        <i class="feather-facebook"></i>
                                                    </a>
                                                </li>
                                                <li><a href="https://www.twitter.com">
                                                        <i class="feather-twitter"></i>
                                                    </a>
                                                </li>
                                                <li><a href="https://www.instagram.com/">
                                                        <i class="feather-instagram"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Team  -->
                            <?php endforeach;?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- End Intructor Area  -->

                </div>
                <?php
                    $events_related = get_posts( array(
                        'post_type'     => 'olc_events',
                        'post_status'   => 'publish', 
                        'tax_query' => array( 
                            array(
                                'taxonomy' => 'olc_event_category', 
                                'field' => 'term_id', 
                                'terms' => wp_get_post_terms(get_the_ID(), 'olc_event_category', array('fields' => 'ids'))
                            ) 
                        ), 
                        'numberposts' => 2, 
                        'exclude' => array(get_the_ID()) ) 
                    );
                    if( $events_related ):
                ?>
                <div class="related-course mt--60">
                    <div class="row">
                        <div class="col-lg-12 mb--40">
                            <div class="section-title text-start">
                                <span class="subtitle bg-secondary-opacity"><?php _e('Similar Event', 'open-learning'); ?></span>
                                <h2 class="title"><?php _e('Similar Event', 'open-learning'); ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row g-5">
                        <?php foreach( $events_related as $post ): 
                            setup_postdata( $post );
                            $_related_event_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'large')? get_the_post_thumbnail_url(get_the_ID(), 'large') : olc_get_placeholder_img();
                            $_related_event_title = get_the_title();
                            $_related_event_start_date_time = function_exists('get_field')? get_field('start_date_time', get_the_ID()) : get_the_date();
                            $_related_event_end_date_time = function_exists('get_field')? get_field('end_date_time', get_the_ID()) : get_the_date();
                            $_related_event_date = date('d M', strtotime($_related_event_start_date_time));
                            $_related_event_year = date('Y', strtotime($_related_event_start_date_time));
                            $_related_event_location = function_exists('get_field')? get_field('location', get_the_ID()) : '';
                            $_related_event_start_time = date('h:m a', strtotime($_related_event_start_date_time));
                            $_related_event_end_time = date('h:m a', strtotime($_related_event_end_date_time));
                        ?>
                        <!-- Start Single Card  -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt--30" data-sal-delay="150" data-sal="slide-up"
                            data-sal-duration="800">
                            <div class="rbt-card event-grid-card variation-01 rbt-hover">
                                <div class="rbt-card-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($_related_event_thumbnail); ?>" alt="<?php esc_attr($_related_event_title); ?>">
                                        <div class="rbt-badge-3 bg-white">
                                            <span><?php echo $_related_event_date; ?></span>
                                            <span><?php echo $_related_event_year; ?></span>
                                        </div>
                                    </a>
                                </div>
                                <div class="rbt-card-body">
                                    <ul class="rbt-meta">
                                        <li><i class="feather-map-pin"></i><?php echo $_related_event_location; ?></li>
                                        <li><i class="feather-clock"></i><?php echo sprintf('%s - %s', $_related_event_start_time, $_related_event_end_time); ?></li>
                                    </ul>
                                    <h4 class="rbt-card-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html($_related_event_title); ?></a></h4>

                                    <div class="read-more-btn">
                                        <a class="rbt-btn btn-border hover-icon-reverse btn-sm radius-round"
                                            href="<?php the_permalink(); ?>">
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
                        <!-- End Single Card  -->
                        <?php endforeach; wp_reset_postdata(); ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="load-more mt--60 text-center">
                                <a class="rbt-btn rbt-switch-btn btn-border" href="<?php echo esc_url(get_post_type_archive_link('olc_events')); ?>">
                                    <span data-text="View More Events"><?php _e('View More Events', 'open-learning'); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-4 mt_md--60 mt_sm--60">
                <div class="course-sidebar rbt-gradient-border sticky-top rbt-shadow-box course-sidebar-top">
                    <div class="inner">
                        <?php
                            $_event_id = get_the_ID();
                            $_event_price = function_exists('get_field')? get_field('price') : '';
                            $_event_promo_url = function_exists('get_field')? get_field('promo_video_url') : '';
                            $_price = (!empty($event_type) && $event_type['value'] == 'paid')? get_woocommerce_currency_symbol().$_event_price : '';
                            $_booking_url = '#';
                        ?>
                        <!-- Start Viedo Wrapper  -->
                        <a class="video-popup-with-text video-popup-wrapper text-center popup-video sidebar-video-hidden mb--15"
                            href="<?php echo esc_url($_event_promo_url); ?>">
                            <div class="video-content">
                                <img class="w-100 rbt-radius" src="<?php echo esc_url($event_thumbnail); ?>"
                                    alt="<?php echo get_the_title(); ?>">
                                <div class="position-to-top">
                                    <span class="rbt-btn rounded-player-2 with-animation">
                                        <span class="play-icon"></span>
                                    </span>
                                </div>
                                <span class="play-view-text d-block color-white"><i class="feather-eye"></i><?php _e('Promo video','open-learning'); ?></span>
                            </div>
                        </a>
                        <!-- End Viedo Wrapper  -->
                        
                        <div class="content pt--30">
                            <div class="add-to-card-button mb--15">
                                <a class="rbt-btn btn-gradient icon-hover w-100 d-block text-center" href="<?php echo esc_url($_booking_url); ?>">
                                    <span class="btn-text"><?php _e('Book Now', 'open-learning'); ?> <?php echo esc_html($_price); ?> </span>
                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </a>
                            </div>

                            <div class="rbt-widget-details has-show-more">
                                <ul class="has-show-more-inner-content rbt-course-details-list-wrapper">
                                    <li>
                                        <span><?php _e('Start Date', 'open-learing'); ?></span>
                                        <span class="rbt-feature-value rbt-badge-5"><?php echo date('d M, Y', strtotime($event_start_date)); ?></span>
                                    </li>
                                    <li>
                                        <span><?php _e('Start Time', 'open-learing'); ?></span>
                                        <span class="rbt-feature-value rbt-badge-5"><?php echo date('h:m a', strtotime($event_start_date)); ?></span>
                                    </li>
                                    <li>
                                        <span><?php _e('End Date', 'open-learing'); ?></span>
                                        <span class="rbt-feature-value rbt-badge-5"><?php echo date('d M, Y', strtotime($event_end_date)); ?></span>
                                    </li>
                                    <li>
                                        <span><?php _e('End Time', 'open-learing'); ?></span>
                                        <span class="rbt-feature-value rbt-badge-5"><?php echo date('h:m a', strtotime($event_end_date)); ?></span>
                                    </li>
                                    <li>
                                        <span><?php _e('Location', 'open-learing'); ?></span>
                                        <span class="rbt-feature-value rbt-badge-5"><?php echo esc_html($event_location); ?></span>
                                    </li>
                                    <li>
                                        <span><?php _e('Language', 'open-learing'); ?></span>
                                        <span class="rbt-feature-value rbt-badge-5"><?php echo esc_html($event_language); ?></span>
                                    </li>
                                </ul>
                                <div class="rbt-show-more-btn"><?php _e('Show more', 'open-learing'); ?></div>
                            </div>

                            <div class="social-share-wrapper mt--30 text-center">
                                <!-- <div class="rbt-post-share d-flex align-items-center justify-content-center">
                                    <ul
                                        class="social-icon social-default transparent-with-border justify-content-center">
                                        <li><a href="https://www.facebook.com/">
                                                <i class="feather-facebook"></i>
                                            </a>
                                        </li>
                                        <li><a href="https://www.twitter.com">
                                                <i class="feather-twitter"></i>
                                            </a>
                                        </li>
                                        <li><a href="https://www.instagram.com/">
                                                <i class="feather-instagram"></i>
                                            </a>
                                        </li>
                                        <li><a href="https://www.linkdin.com/">
                                                <i class="feather-linkedin"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->
                                <hr class="mt--20">
                                <div class="contact-with-us text-center">
                                    <p><?php _e('For details about the course', 'open-learning'); ?></p>
                                    <p class="rbt-badge-2 mt--10 justify-content-center w-100"><i class="feather-phone mr--5"></i><?php _e('Call Us:','open-learning'); ?> <a href="tel:<?php echo esc_html($event_contacts); ?>"><strong><?php echo esc_html($event_contacts); ?></strong></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();