<?php
/**
 * 
 * Woocommmerce Top Sidebar
 */
 ?>

<?php if( is_active_sidebar('woo-sidebar-top') ) :?>
<div id="top-bar-filters">
    <div class="d-flex justify-content-between mt-3 flex-wrap">
        <?php  dynamic_sidebar('woo-sidebar-top'); ?>
    </div>
</div>
<?php endif; ?>