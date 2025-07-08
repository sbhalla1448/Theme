<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OLC
 */

get_header();
?>
	<main id="primary" class="site-main">
		<div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb-inner text-center">
							<h2 class="title"><?php single_post_title(); ?></h2>
							<ul class="page-list">
								<li class="rbt-breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
								<li>
									<div class="icon-right"><i class="feather-chevron-right"></i></div>
								</li>
								<li class="rbt-breadcrumb-item active"><?php single_post_title(); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- blog-area -->
		<section class="blog-area page-area pt-100 pb-100">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="page_contents adara-page-content">
						<?php
							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile;
						?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- blog-area-end -->
	</main>

<?php
get_footer();

