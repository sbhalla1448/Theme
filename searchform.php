<?php

/**
 * 
 * Searchform
 */
 ?>
<form role="search" method="get" id="searchform" class="rbt-search-style-1" action="<?php echo home_url( '/' );?>">
    <input type="text" placeholder="Search Courses" value="<?php  echo get_search_query() ?>" name="s" id="search">
    <button class="search-btn" type="submit" value="<?php echo esc_html__( 'Search', 'open-learning' ); ?>"><i class="feather-search"></i></button>
</form>