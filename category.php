<?php
/**
 * The template for displaying specific category posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package OLC
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php get_template_part( 'template-parts/breadcrumb' ); ?>
		<!-- blog-area -->
		<section class="blog-area pt-100 pb-100">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content/content', 'page');

							endwhile; // End of the loop.

							// pagination for posts
							get_template_part('template-parts/pagination');
						?>
						
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</section>
		<!-- blog-area-end -->
	</main><!-- #main -->

<?php
get_footer();
