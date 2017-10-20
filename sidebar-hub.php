<aside id="sidebar" role="complementary">
    <?php
    global $wpdb, $post;

    $post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
    $author_id = $post->post_author;
    ?>

    <div class="widget-container widget_text">
        <nav id="nav-below" class="navigation nav-below-hub" role="navigation">
            <ul>
                <li class=""><?php previous_post_link('%link', '<i class="fa fa-fw fa-chevron-left"></i>'); ?></li>
                <li class=""><a href="<?php echo home_url(); ?>"><i class="fa fa-th"></i></a></li>
                <li class="right"><?php next_post_link('%link', '<i class="fa fa-fw fa-chevron-right"></i>'); ?></li>
            </ul>
        </nav>

        <?php echo ipGetPostLikeLink(get_the_ID()); ?>
        <?php echo imagepress_image_download(get_the_post_thumbnail_url()); ?>

        <p>
            <?php imagepress_get_like_users(get_the_ID()); ?>
        </p>

        <h3 class="widget-title"><?php the_title(); ?></h3>
        <div class="textwidget">
            <p>
                &copy;<?php echo date('Y'); ?> <?php echo getImagePressProfileUri($author_id); ?> 
                <?php
                $logged_in_user = wp_get_current_user();

                if (is_user_logged_in() && $author_id != $logged_in_user->ID) {
                    echo do_shortcode('[follow_links follow_id="' . $author_id . '"]');
                }
                ?>
                <br>
                <?php the_time(get_option('date_format')); ?> <?php _e('in', 'noir-ui'); ?> <?php echo ip_get_the_term_list(get_the_ID(), 'imagepress_image_category', '', ', ', '', array()); ?>
                <br>
                <small><?php echo ip_getPostViews(get_the_ID()); ?> <?php _e('views', 'noir-ui'); ?>, <?php echo get_comments_number(get_the_ID()); ?> <?php _e('comments', 'noir-ui'); ?>, <?php echo imagepress_get_like_count(get_the_ID()); ?> <?php _e('likes', 'noir-ui'); ?></small>
            </p>

            <hr>
            <?php
            // custom fields
            $result = $wpdb->get_results("SELECT field_type, field_name, field_slug FROM " . $wpdb->prefix . "ip_fields ORDER BY field_order ASC", ARRAY_A);

            foreach($result as $field) {
                if($field['field_type'] < 20) {
                    $field_slug = get_post_meta(get_the_ID(), $field['field_slug'], true);
                    if(!empty($field_slug)) {
                        echo $field['field_name'] . ': ' . get_post_meta(get_the_ID(), $field['field_slug'], true) . '<br>';
                    }
                }
            }
            //
            ?>

            <?php if ((int) get_option('ip_mod_collections') === 1) { ?>
                <h3 class="widget-title"><?php _e('Collections', 'noir-ui'); ?></h3>
                <?php ip_frontend_view_image_collection(get_the_ID()); ?>
                <?php ip_frontend_add_collection(get_the_ID()); ?>
            <?php } ?>
        </div>
    </div>

    <hr>

    <div class="widget-container widget_text">
        <h3 class="widget-title"><?php _e('Related Images', 'noir-ui'); ?></h3>
        <div class="textwidget">
            <p><?php _e('More images by the same author', 'noir-ui'); ?></p>
            <?php echo cinnamon_get_related_author_posts($post->post_author); ?>

            <p>&nbsp;</p>

            <p><?php _e('More images from the gallery', 'noir-ui'); ?></p>
            <?php
            $cinnamon_post_type = get_option('cinnamon_post_type');
            $ip_slug = get_option('ip_slug');
            $authors_posts = get_posts(array(
                'posts_per_page' => 9,
                'post_type' => $ip_slug
            ));

            $output = '';
            if($authors_posts) {
                echo '<div class="cinnamon-grid"><ul>';
                    foreach ($authors_posts as $authors_post) {
                        echo '<li><a href="' . get_permalink($authors_post->ID) . '">' . get_the_post_thumbnail($authors_post->ID, 'thumbnail') . '</a></li>';
                    }
                echo '</ul></div>';
            }
            ?>
        </div>
    </div>

    <?php if(is_active_sidebar('hub-widget-area')) : ?>
        <div id="primary" class="widget-area">
            <?php dynamic_sidebar('hub-widget-area'); ?>
        </div>
    <?php endif; ?>
</aside>
