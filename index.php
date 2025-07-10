<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OLC
 */

get_header();
?>

<main class="rbt-main-wrapper">

    <?php
		if ( have_posts() ) :
			if( is_home() ): ?>
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
										<li class="rbt-breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
										<li>
											<div class="icon-right"><i class="feather-chevron-right"></i></div>
										</li>
										<li class="rbt-breadcrumb-item active"><?php _e('All Blogs', 'open-learning'); ?></li>
									</ul>
									<!-- End Breadcrumb Area  -->

									<div class="title-wrapper">
										<h1 class="title mb--0"><?php _e('All Blogs', 'open-learning'); ?></h1>
										<a href="#" class="rbt-badge-2">
											<div class="image">🎉</div> 50 Blogs
										</a>
									</div>

									<p class="description">Blogs that help beginner designers become true unicorns. </p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Banner Content Top  -->

				</div>
			</div>

			<div class="rbt-section-overlayping-top rbt-section-gapBottom">
				<div class="container">
					<div class="row row--30 gy-5">
						<div class="col-lg-8">
							<!-- Start Card Area -->
							<div class="row g-5">
							<?php
								/* Start the Loop */ 
								while(have_posts()):
									the_post();
									
									get_template_part( 'template-parts/content/content', 'page' );
								endwhile;
							?>
							</div>
							<!-- End Card Area -->

							<div class="row">
								<div class="col-lg-12 mt--60">
									<nav>
									<?php 
										// pagination for posts
										get_template_part('template-parts/pagination'); 
									?>
									</nav>
								</div>
							</div>

						</div>
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
    	<?php
			else:
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				// pagination for posts
				get_template_part('template-parts/pagination');
			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

</main><!-- #main -->

<?php
get_footer();