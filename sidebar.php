<?php
/**
 * 
 * Blog
 */
 ?>
<?php if( is_active_sidebar('blog-sidebar') ) :?>
<div class="col-lg-4">
    <aside class="rbt-sidebar-widget-wrapper rbt-gradient-border">
        <?php  dynamic_sidebar('blog-sidebar'); ?>
    </aside>
</div>
<?php endif; ?>