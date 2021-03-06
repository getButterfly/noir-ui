<?php  
/* 
 * Template Name: Fullwidth
 * Template Type: post, page, event, image
*/

get_header(); ?>

<section id="content-wide" role="main">
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
            <section class="entry-content">
                <?php the_content(); ?>
            </section>
        </article>
    <?php endwhile; endif; ?>
</section>

<?php get_footer();