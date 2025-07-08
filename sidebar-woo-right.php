<?php
/**
 * 
 * Woocommmerce Right Sidebar
 */
 ?>

<?php  if( is_active_sidebar('woo-sidebar-right') ):?>
<div class="col-xl-3 col-lg-4">
    <aside class="shop-sidebar">
        <?php  dynamic_sidebar('woo-sidebar-right'); ?>
    </aside>
</div>
<?php endif; ?>