<?php
/**
 * Subscription Page
 */
get_header();
?>
<!-- Start breadcrumb Area -->
<div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner text-center">
                    <h2 class="title">Your plan purchase</h2>
                    <ul class="page-list">
                        <li class="rbt-breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
                        <li>
                            <div class="icon-right"><i class="feather-chevron-right"></i></div>
                        </li>
                        <li class="rbt-breadcrumb-item active">Your plan purchase</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb Area -->

<div class="rbt-elements-area bg-color-white rbt-section-gap">
    <div class="container">
        <div class="row gy-5 row--30">
            <div class="col-lg-5">
                <div class="rbt-contact-form contact-form-style-1 max-width-auto">
                    <h3 class="title">Create your own site</h3>
                    <?php Multisite::instance()->multisite_form(); ?>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="advance-pricing">
                    <div class="inner">
                        <div class="row row--0">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="pricing-left">
                                    <h3 class="main-title">Active Plan Mode.</h3>
                                    <p class="description">Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Nemo, quisquam.</p>
                                    <div class="price-wrapper">
                                        <span class="price-amount">$129<sup>/mo</sup></span>
                                    </div>
                                    <div class="rating">
                                        <a href="#rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </a>
                                        <a href="#rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </a>
                                        <a href="#rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </a>
                                        <a href="#rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </a>
                                        <a href="#rating">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <small class="subtitle">rated 4.5/5 Stars in 1000+ reviews.</small>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="pricing-right position-relative">
                                    <div class="pricing-offer">
                                        <div class="single-list">
                                            <h4 class="price-title">Advance Plans You can Get.</h4>
                                            <ul class="plan-offer-list">
                                                <li>
                                                    <i class="feather-check"></i> 5 PPC Campaigns
                                                </li>
                                                <li>
                                                    <i class="feather-check"></i> Digital Marketing
                                                </li>
                                                <li>
                                                    <i class="feather-check"></i> Marketing Agency
                                                </li>
                                                <li>
                                                    <i class="feather-check"></i> Seo Friendly
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="single-list mt--40">
                                            <h4 class="price-title">Basic Plans You can Get.</h4>
                                            <ul class="plan-offer-list">
                                                <li>
                                                    <i class="feather-check"></i> 5 PPC Campaigns
                                                </li>
                                                <li>
                                                    <i class="feather-check"></i> Digital Marketing
                                                </li>
                                                <li>
                                                    <i class="feather-check"></i> Marketing Agency
                                                </li>
                                                <li>
                                                    <i class="feather-check"></i> Seo Friendly
                                                </li>
                                                <li>
                                                    <i class="feather-check"></i> App Development
                                                </li>
                                                <li class="off">
                                                    <i class="feather-x"></i> 24/7 Dedicated Support
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pricing-badge"><span>Popular</span></div>
                                </div>
                            </div>
                        </div>
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
<?php
get_footer();
?>