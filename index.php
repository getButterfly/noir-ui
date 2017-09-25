<?php get_header(); ?>

<section id="content" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part('entry'); ?>
        <?php comments_template(); ?>
    <?php endwhile; endif; ?>

    <?php
    global $wp_query;

    if ($wp_query->max_num_pages > 1) { ?>
        <nav id="nav-below" class="navigation" role="navigation">
            <div class="nav-previous"><?php next_posts_link(sprintf(__('%s older', 'noir-ui'), '<span class="meta-nav">&larr;</span>')); ?></div>
            <div class="nav-next"><?php previous_posts_link(sprintf(__('newer %s', 'noir-ui'), '<span class="meta-nav">&rarr;</span>')); ?></div>
        </nav>
    <?php } ?>
</section>

<?php
get_sidebar();
get_footer();
