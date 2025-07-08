<?php
/**
 * Template Name: OLC Checkout
 */
get_header();
?>
<div class="rbt-course-details-area rbt-section-gap">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 m-auto">
                <?php Payment::instance()->checkout_form(); ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>