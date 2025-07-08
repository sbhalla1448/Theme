<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OLC
 */

get_header();
?>

<main class="rbt-main-wrapper">
    <div class="rbt-overlay-page-wrapper">
        <div class="breadcrumb-image-container breadcrumb-style-max-width">
            <div class="breadcrumb-image-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bg/bg-image-10.jpg" alt="Education Images">
            </div>
            <div class="breadcrumb-content-top text-center">
                <ul class="meta-list justify-content-center mb--10">
                    <li class="list-item">
                        <div class="author-thumbnail">
							<?php echo get_avatar(get_the_author_meta( 'ID' )); ?>
                        </div>
                        <div class="author-info">
                            <a href="#"><strong><?php echo get_the_author(); ?></strong></a> in <a href="#"><strong>Design</strong></a>
                        </div>
                    </li>
                    <li class="list-item">
                        <i class="feather-clock"></i>
                        <span><?php echo get_the_date(); ?></span>
                    </li>
                </ul>
                <h1 class="title"><?php single_post_title(); ?></h1>
                <p><?php echo get_the_excerpt(); ?></p>
            </div>
        </div>
        <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /*
                * Include the Post-Type-specific template for the content.
                * If you want to override this in a child theme, then include a file
                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                */
                get_template_part( 'template-parts/content/content', 'page' );

            endwhile;
        ?>
    </div>
</main><!-- #main -->

<?php
get_footer();