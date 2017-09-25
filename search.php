<?php get_header(); ?>

<section id="content-wide" role="main">
     <?php if (have_posts()) { ?>
        <h1 class="entry-title"><?php printf(__('Search Results for: %s', 'noir-ui'), get_search_query()); ?></h1>
        <?php while (have_posts()) : the_post(); ?>
            <div class="noir-box">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('imagepress_ls_std'); ?></a>
                <p>
                    <b><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></b>
                    <br><small><?php the_author_posts_link(); ?> | <?php the_time(get_option('date_format')); ?></small>
                </p>
            </div>
        <?php endwhile; ?>
        <?php
        global $wp_query;

        if ($wp_query->max_num_pages > 1) { ?>
            <nav id="nav-below" class="navigation" role="navigation">
                <div class="nav-previous"><?php next_posts_link(sprintf(__('%s older', 'noir-ui'), '<span class="meta-nav">&larr;</span>')); ?></div>
                <div class="nav-next"><?php previous_posts_link(sprintf(__('newer %s', 'noir-ui'), '<span class="meta-nav">&rarr;</span>')); ?></div>
            </nav>
        <?php } ?>
    <?php } else { ?>
        <h2 class="entry-title"><?php _e('Nothing found', 'noir-ui'); ?></h2>
        <section class="entry-content">
            <p><?php _e('Sorry, nothing matched your search. Please try again.', 'noir-ui'); ?></p>
            <?php get_search_form(); ?>
        </section>
    <?php } ?>
</section>

<?php get_footer();
