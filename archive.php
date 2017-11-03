<?php get_header(); ?>

<section id="content" role="main">
    <header class="header">
        <h1 class="entry-title">
            <?php 
            if (is_day()) {
                printf(__('Daily archives: %s', 'noir-ui'), get_the_time(get_option('date_format')));
            } else if (is_month()) {
                printf(__('Monthly archives: %s', 'noir-ui'), get_the_time('F Y'));
            } else if (is_year()) {
                printf(__('Yearly archives: %s', 'noir-ui'), get_the_time('Y'));
            } else {
                _e('Archives', 'noir-ui');
            }
            ?>
        </h1>
    </header>

        <div id="ip-boxes" class="list">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            $i = get_the_ID();

            $user_info = get_userdata(get_the_author_id());
            $post_thumbnail_id = get_post_thumbnail_id($i);

            $image_attributes = wp_get_attachment_image_src($post_thumbnail_id, 'imagepress_pt_std_ps');

            echo '<div class="ip_box">
                <a href="' . get_permalink($i) . '" class="ip_box_img">
                    <img src="' . $image_attributes[0] . '" alt="' . get_the_title($i) . '">
                </a>
                <div class="ip_box_top">
                    <a href="' . get_permalink($i) . '" class="imagetitle">' . get_the_title($i) . '</a>
                    <span class="name">' . get_avatar(get_the_author_id(), 16) . ' <a href="' . getImagePressProfileUri(get_the_author_id(), false) . '">' . get_the_author() . '</a></span>
                </div>
            </div>';
            ?>

            <?php /** ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header>
                <?php if (is_singular()) { echo '<h1 class="entry-title">'; } else { echo '<h2 class="entry-title">'; } ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                <?php if (is_singular()) { echo '</h1>'; } else { echo '</h2>'; } ?> <?php edit_post_link(); ?>
                <?php if (!is_search()) { ?>
                    <section class="entry-meta">
                        <span class="author vcard"><?php the_author_posts_link(); ?></span>
                        <span class="meta-sep"> | </span>
                        <span class="entry-date"><?php the_time(get_option('date_format')); ?></span>
                    </section>
                <?php } ?>
            </header>

            <?php if (is_archive() || is_search()) { ?>
                <section class="entry-summary">
                    <?php the_excerpt(); ?>
                    <?php if (is_search()) { ?><div class="entry-links"><?php wp_link_pages(); ?></div><?php } ?>
                </section>
            <?php } else { ?>
                <section class="entry-content">
                    <?php the_content(); ?>
                    <div class="entry-links"><?php wp_link_pages(); ?></div>
                </section>
            <?php } ?>

            <?php if (!is_search()) { ?>
                <footer class="entry-footer">
                    <span class="cat-links"><?php _e('Categories: ', 'noir-ui'); ?><?php the_category(', '); ?></span>
                    <?php if (comments_open()) {
                        echo '<span class="meta-sep">|</span> <span class="comments-link"><a href="' . get_comments_link() . '">' . sprintf(__('Comments', 'noir-ui')) . '</a></span>';
                    } ?>
                </footer>
            <?php } ?>
        </article>
        <?php /**/ ?>
    <?php endwhile; endif; ?>
        </div>

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
