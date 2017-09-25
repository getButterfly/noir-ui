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
