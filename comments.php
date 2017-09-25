<?php if('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) return; ?>
<section id="comments">
    <?php 
    if(have_comments()) :
        global $comments_by_type;

        $comments_by_type = separate_comments($comments);
        if(!empty($comments_by_type['comment'])) : ?>
            <section id="comments-list" class="comments">
                <h3 class="comments-title"><?php comments_number(); ?></h3>
                <?php if(get_comment_pages_count() > 1) : ?>
                    <nav id="comments-nav-above" class="comments-navigation" role="navigation">
                        <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
                    </nav>
                <?php endif; ?>
                <ul>
                    <?php wp_list_comments('type=comment&reverse_top_level=true&callback=noir_comments'); ?>
                </ul>
                <?php if(get_comment_pages_count() > 1) : ?>
                    <nav id="comments-nav-below" class="comments-navigation" role="navigation">
                        <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
                    </nav>
                <?php endif; ?>
            </section>
        <?php 
        endif;
    endif;

    $args = array(
        'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' . '</textarea></p>',
        'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'noir-ui'), home_url() . '/login/') . '</p>',
        'logged_in_as' => '',
        'comment_notes_after' => '',
        'title_reply'       => __('Leave a comment', 'noir-ui'),
        'title_reply_to'    => __('Reply to %s', 'noir-ui'),
    );

    if(comments_open()) {
        comment_form($args);
    }
    ?>
</section>
