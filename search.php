<?php
/**
 * Template Name: Search Page
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

<main id="primary" class="site-main">
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>
	<!-- blog-area -->
	<section class="blog-area pt-100 pb-100">
		<div class="container">
			<div class="row justify-content-center">
				<div class="<?php echo is_active_sidebar('blog-sidebar') ? 'col-lg-8' : 'col-lg-12' ?>">
					<div class="search-result-count text-center border-bottom">
						<h4>
						<?php
							printf(
								esc_html(
									/* translators: %d: The number of search results. */
									_n(
										'We found %d result for your search.',
										'We found %d results for your search.',
										(int) $wp_query->found_posts,
										'open-learning'
									)
								),
								(int) $wp_query->found_posts
							);
						?>
						</h4>
					</div><!-- .search-result-count -->
					<?php
					if ( have_posts() ) :
						/* Start the Loop */ 
						while(have_posts()):
							the_post();

							get_template_part( 'template-parts/content/content', 'search' );
						endwhile;
					else:
						get_template_part( 'template-parts/content/content', 'none' );
					endif;
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