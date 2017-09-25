<form role="search" method="get" class="search-form" action="<?php echo home_url(); ?>">
    <input type="search" class="search-field" placeholder="<?php _e('Search', 'noir-ui'); ?>" value="<?php the_search_query(); ?>" name="s">
</form>