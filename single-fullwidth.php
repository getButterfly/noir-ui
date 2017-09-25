<?php
/*
 * Template Name: Fullwidth Article
 * Template Post Type: post
 */
 
get_header(); ?>

<section id="content-wide" role="main" class="ip-main">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <section class="entry-meta">
                <span class="author vcard"><?php the_author_posts_link(); ?></span>
                <span class="meta-sep"> | </span>
                <span class="entry-date"><?php the_time(get_option('date_format')); ?></span>
            </section>

            <?php the_content(); ?>
        </article>

        <hr>
        <?php comments_template('', true); ?>
    <?php endwhile; endif; ?>
</section>

<?php get_footer();
