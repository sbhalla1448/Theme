<?php
/**
 * Displaying 404 page
 */
get_header();
?>

<main id="primary" class="site-main">
		<!-- blog-area -->
		<section class="blog-area pt-100 pb-100 not-found-page">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<div class="col-md-6">
                        <div class="left border-right pt-100 pb-100">
                            <h1 class="display-4"><?php echo esc_html__('404 Page Not Found!', 'open-learning'); ?></h1>
                        </div>
					</div>
                    <div class="col-md-6">
                        <div class="right">
                            <p class="mb-30"><?php echo esc_html__("It's seem like whatever page you are looking for doesn't exist!", 'open-learning'); ?></p>
                            <a href="<?php echo home_url('/'); ?>" role="button" class="btn"><?php echo esc_html__('Back to home', 'open-learning'); ?></a>
                        </div>
                    </div>
				</div>
			</div>
		</section>
		<!-- blog-area-end -->
	</main><!-- #main -->

<?php
get_footer();