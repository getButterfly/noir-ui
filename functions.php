<?php
function prefix_theme_updater() {
    require get_template_directory() . '/updater/theme-updater.php';
}
add_action('after_setup_theme', 'prefix_theme_updater');

require_once 'includes/noir-settings.php';
require_once 'includes/noir-shortcodes.php';

function noir_load_fonts() {
    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('noir-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Montserrat:400,700', array(), $version);
    wp_enqueue_style('noir', get_stylesheet_directory_uri() . '/css/main.css', array(), $version);

    if ((string) get_theme_mod('noir_color_scheme') === 'dark') {
        wp_enqueue_style('noir-scheme-dark', get_stylesheet_directory_uri() . '/css/scheme-dark.css', array(), $version);
    } else if ((string) get_theme_mod('noir_color_scheme') === 'dark-alt') {
        wp_enqueue_style('noir-scheme-dark-alt', get_stylesheet_directory_uri() . '/css/scheme-dark-alt.css', array(), $version);
    } else if ((string) get_theme_mod('noir_color_scheme') === 'light') {
        wp_enqueue_style('noir-scheme-light', get_stylesheet_directory_uri() . '/css/scheme-light.css', array(), $version);
    }

    wp_enqueue_script('slideout', get_stylesheet_directory_uri() . '/js/slideout.min.js', array(), '1.0.1', true);
    wp_enqueue_script('engine', get_stylesheet_directory_uri() . '/js/engine-0.2.js', array('slideout'), $version, true);
}

add_action('wp_enqueue_scripts', 'noir_load_fonts');

add_filter('wp_nav_menu_items', 'noir_custom_menu_item', 10, 2);

function noir_custom_menu_item($items, $args) {
    if ($args->theme_location == 'main-menu') {
        $current_user = wp_get_current_user();

        $current_items = $items;

        $items = '<li><a href="' . home_url() . '" class="menu-logo-large">' . get_bloginfo('name') . '</a></li>';

        if (has_custom_logo()) {
            $items = '<li>' . get_custom_logo() . '</li>';
        }

        $items .= $current_items;

        $items .= '<div class="search menu-search">
            <form role="search" method="get" id="searchform" action="' . home_url() . '">
                <input type="text" placeholder="' . __('Search images...', 'noir-ui') . '" name="s" id="s">
                <input type="hidden" name="post_type" value="' . get_imagepress_option('ip_slug') . '">
            </form>
        </div>';

        if (!is_user_logged_in()) {
            $items .= '<li class="hmenu-right"><a href="' . get_imagepress_option('cinnamon_account_page') . '" class="menu-login">' . __('Log in', 'noir-ui') . '</a></li>';
        }
    
        if (is_user_logged_in()) {
            $items .= '<li class="hmenu-right"><a href="' . getImagePressProfileUri($current_user->ID, false) . '">' . get_avatar($current_user->ID, 32) . '</a>
                <ul class="ui-base">
                    <li><a href="' . getImagePressProfileUri($current_user->ID, false) . '">' . __('View profile', 'noir-ui') . '</a></li>
                    <li><a href="' . get_imagepress_option('cinnamon_edit_page') . '">' . __('Edit profile', 'noir-ui') . '</a></li>
                    <li><a href="' . wp_logout_url(home_url()) . '">' . __('Log out', 'noir-ui') . '</a></li>
                </ul>
            </li>';
        }

        if (is_user_logged_in()) {
            $items .= '<li class="hmenu-right bell-pepper">' . ip_notifications_menu_item() . '</li>'; 
        }
    }

    return $items;
}



function noir_add_excerpt_support_for_pages() {
    add_post_type_support('post', 'page-attributes');
    add_post_type_support('image', 'page-attributes');
}
add_action('init', 'noir_add_excerpt_support_for_pages');



/*
 * Homepage Widgets
 */
register_sidebar(array(
	'name'          => 'Homepage widget (top)',
	'id'            => 'home-widget-1',
	'description'   => 'This is the top widget. It will fit columns, text, icons.',
	'before_widget' => '<div class="home-column">',
	'after_widget'  => '</div>',
	'before_title'  => '<h5>',
	'after_title'   => '</h5>',
));

register_sidebar(array(
	'name'          => 'Homepage widget (main, middle)',
	'id'            => 'home-widget-main',
	'description'   => 'This is the main widget. It will fit shortcodes, text, columns and more.',
	'before_widget' => '<div class="home-column">',
	'after_widget'  => '</div>',
	'before_title'  => '<h5>',
	'after_title'   => '</h5>',
));

register_sidebar(array(
	'name'          => 'Homepage widget (main, content)',
	'id'            => 'home-widget-content',
	'description'   => 'This is the content widget. It will fit shortcodes, text, columns and more.',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h1 class="homepage-header">',
	'after_title'   => '</h1>',
));

register_sidebar(array(
	'name'          => 'Homepage widgets (bottom)',
	'id'            => 'home-widget-2',
	'description'   => 'This is the bottom widget. It will fit columns, text, pages, posts and more.',
	'before_widget' => '<div class="home-column">',
	'after_widget'  => '</div>',
	'before_title'  => '<h5>',
	'after_title'   => '</h5>',
));

register_sidebar(array(
    'name'          => 'Footer Widget 1',
    'id'            => 'footer-widget-1',
    'description'   => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
));
register_sidebar(array(
    'name'          => 'Footer Widget 2',
    'id'            => 'footer-widget-2',
    'description'   => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
));
register_sidebar(array(
    'name'          => 'Footer Widget 3',
    'id'            => 'footer-widget-3',
    'description'   => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
));

register_sidebar(array(
    'name'          => 'Responsive Menu Widget 1',
    'id'            => 'responsive-menu-widget-1',
    'description'   => 'Appears in the responsive/mobile menu area, above the menu.',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
));
register_sidebar(array(
    'name'          => 'Responsive Menu Widget 2',
    'id'            => 'responsive-menu-widget-2',
    'description'   => 'Appears in the responsive/mobile menu area, below the menu.',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
));



function noir_ui_custom_logo() {
    if(function_exists('the_custom_logo')) {
        the_custom_logo();
    }
}



add_action('after_setup_theme', 'noirui_setup');
function noirui_setup() {
	load_theme_textdomain('noir-ui', get_template_directory() . '/languages');

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
    add_theme_support('advanced-image-compression');
    add_theme_support('automatic-feed-links');

	add_image_size('home_banner', 1280, 300, true);

	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));

    add_theme_support('custom-logo', array(
        'width'       => 180,
        'height'      => 48,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    ));

	global $content_width;
	if(!isset($content_width)) $content_width = 920;

	register_nav_menus(array(
		'main-menu' => 'Main Menu',
		'pipes-menu' => 'Pipes Menu',
		'footer-menu' => 'Footer Menu',
		'responsive-menu' => 'Responsive Menu',
	));
}

add_action('wp_enqueue_scripts', 'noirui_load_scripts');
function noirui_load_scripts() {
	wp_enqueue_script('jquery');
}

add_action('comment_form_before', 'noirui_enqueue_comment_reply_script');
function noirui_enqueue_comment_reply_script() {
	if(get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
}


add_action('widgets_init', 'noirui_widgets_init');

function noirui_widgets_init() {
    register_sidebar(array(
        'name' => __( 'Sidebar Widget Area', 'noir-ui' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}



function noir_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
            if ('div' == $args['style']) {
                $tag = 'div';
                $add_below = 'comment';
            } else {
                $tag = 'li';
                $add_below = 'div-comment';
            }
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php _e('Pingback:', 'noir-ui'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('(Edit)', 'noir-ui'), '<span class="edit-link">', '</span>'); ?></p>
            </li>
            <?php
            break;
        default :
            ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment->user_id, 64); ?>
                    <footer class="comment-meta">
                        <div class="comment-author vcard">
                            <?php
                            if ($comment->user_id) {
                                $user = get_userdata($comment->user_id);
                                $display_name = $user->display_name;

                                $linkie = '<b><a href="' . getImagePressProfileUri($comment->user_id, false) . '">' . $display_name . '</a> </b> ' . __('says', 'noir-ui') . ':';
                            } else {
                                $linkie = '<b><a href="' . $comment->comment_author_url . '" rel="external nofollow">' . $comment->comment_author . '</a></b> says:';
                            }

                            echo $linkie;
                            ?>
                        </div><!-- .comment-author -->

                    <?php if('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'noir-ui'); ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content">
                    <?php comment_text(); ?>
                    <p>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <time datetime="<?php comment_time('c'); ?>" title="<?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'noir-ui'), get_comment_date(), get_comment_time()); ?>"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?></time>
                        </a> <?php edit_comment_link(__('Edit', 'noir-ui'), '<span class="edit-link">', '</span>'); ?>
                        <small>
                            <?php comment_reply_link(array_merge($args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                        </small>
                    </p>
                </div><!-- .comment-content -->
            </article><!-- .comment-body -->
    <?php
        break;
    endswitch; 
}


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function imagepress_add_meta_box() {
	$screens = array('poster');

    foreach($screens as $screen) {
        add_meta_box('imagepress_sectionid', __('Staff Comment', 'noir-ui'), 'imagepress_meta_box_callback', $screen);
    }
}
add_action('add_meta_boxes', 'imagepress_add_meta_box');

function imagepress_meta_box_callback($post) {
    wp_nonce_field('imagepress_meta_box', 'imagepress_meta_box_nonce');
	$value = get_post_meta( $post->ID, '_comment_value_key', true );

	echo '<label for="imagepress_new_field">' . __('Add a short staff comment', 'noir-ui') . '</label><br>';
	echo '<input type="text" id="imagepress_new_field" name="imagepress_new_field" value="' . esc_attr($value) . '" size="60">';
}

function imagepress_save_meta_box_data($post_id) {
	if(!isset($_POST['imagepress_meta_box_nonce'])) {
		return;
	}
	if(!wp_verify_nonce($_POST['imagepress_meta_box_nonce'], 'imagepress_meta_box')) {
		return;
	}
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if(isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if(!current_user_can('edit_page', $post_id)) {
			return;
		}
	}
    else {
		if(!current_user_can('edit_post', $post_id)) {
			return;
		}
	}

	if(!isset($_POST['imagepress_new_field'])) {
		return;
	}

	$my_data = sanitize_text_field($_POST['imagepress_new_field']);

	update_post_meta($post_id, '_comment_value_key', $my_data);
}
add_action('save_post', 'imagepress_save_meta_box_data');

add_shortcode('button', 'button_ps');

if(!function_exists('t5_do_not_ask_for_comment_log_in')) {
    add_filter('comment_reply_link', 't5_do_not_ask_for_comment_log_in');

    function t5_do_not_ask_for_comment_log_in($link) {
        if(empty($GLOBALS['user_ID']) && get_option('comment_registration')) {
            return '<a href="' . home_url() . '/login/">' . __('Log in to reply', 'noir-ui') . '</a>';
        }

        return $link;
    }
}

/* ImagePress integration */
if ((string) get_theme_mod('noir_color_scheme') === 'none') {
    add_action('wp_head', 'noir_ui_css');
}

function noir_ui_css() {
    echo '<style>
    html, #panel, nav, nav form input[type="search"], .attribution { color: ' . get_theme_mod('noir_ui_text_color') . '; background-color: ' . get_theme_mod('noir_ui_bg_color') . '; }
    html, a:hover, .imagetitle, .copyright, nav form:after, nav ul li a, nav ul li:hover > a, nav ul .home .fa, .button, .button-small, .button:hover, .button-small:hover, .button-small a:hover, .message, .panel, #nav-below .fa, .ip-tabs a:hover, .cinnamon-award-list-item { color: ' . get_theme_mod('noir_ui_text_color') . ' !important; }
    .head { box-shadow: 0 40px 0 ' . get_theme_mod('noir_ui_bg_color') . '; }
    .notifications-container { background-color: ' . get_theme_mod('noir_ui_bg_color') . '; }
    .imagepress-like.liked { background-color: ' . get_theme_mod('noir_ui_bg_color') . ' !important; }

    .account-content ul li ul, .account-content ul li ul li a, .head { background-color: ' . get_theme_mod('noir_ui_dark_color') . '; }

    .item a { color: ' . get_theme_mod('noir_ui_text_color') . ' !important; }

    .notifications-bell:hover,
    .notifications-bell:hover i,
    .notifications-bell:hover sup,
    .notifications-container a,
    .hmenu a.whitened:hover,
    .hmenu a.notifications-bell:hover,
    a,
    .entry a,
    .teal,
    #cinnamon-cards .sort .teal,
    #author-cards .sort .teal,
    .ip_box_top .name
    { color: ' . get_theme_mod('noir_ui_accent_color') . '; }
    .button-main { background-color: ' . get_theme_mod('noir_ui_accent_color') . '; }

    .background-gradient,
    .m-hero.gradient_variant_5 .m-hero__slider:after { background-image: linear-gradient(90deg, ' . get_theme_mod('noir_ui_overlay_color') . ' 0%, ' . get_theme_mod('noir_ui_overlay_color') . '); }
    

    nav ul li ul, 
    .hmenu nav { background-color: ' . get_theme_mod('noir_ui_dark_color') . '; }

    #l { border-bottom: 1px solid ' . get_theme_mod('noir_ui_accent_color') . '; }
    .ip-tabs .current a, .ip-tabs a:hover { border-bottom: 1px solid ' . get_theme_mod('noir_ui_accent_color') . '; }
    nav .current-menu-item { box-shadow: inset 0 -1px ' . get_theme_mod('noir_ui_accent_color') . '; }
    .ip-additional-active { border: 3px solid ' . get_theme_mod('noir_ui_accent_color') . ' !important; }
    #comments .children li { border-left: 1px dotted ' . get_theme_mod('noir_ui_accent_color') . '; }
    #comments li.bypostauthor { border-left: 3px solid ' . get_theme_mod('noir_ui_accent_color') . '; }

    ul#ip-tab li.active a { border-bottom: 1px solid ' . get_theme_mod('noir_ui_accent_color') . '; }

    .notifications-container .unread i { color: ' . get_theme_mod('noir_ui_accent_color') . '; }
    .notifications-container .unread { border-left: 3px solid ' . get_theme_mod('noir_ui_accent_color') . '; }
    .notifications-bell sup { background-color: ' . get_theme_mod('noir_ui_accent_color') . '; }
    .notifications-container a { color: ' . get_theme_mod('noir_ui_accent_color') . '; }
    .notifications-container .notifications-title { border-bottom: 1px solid ' . get_theme_mod('noir_ui_accent_color') . '; color: ' . get_theme_mod('noir_ui_accent_color') . '; }';

    if('1' === get_theme_mod('noir_bg_overlay')) {
        echo 'html, #panel { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAADklEQVQIW2NgQAXGZHAAGioAza6+Hk0AAAAASUVORK5CYII=); }';
	}

    echo '.button-main, .notifications-bell sup { color: ' . get_theme_mod('noir_ui_button_text_color') . '; }
    .a:hover { color: ' . get_theme_mod('noir_ui_text_hover_color') . '; }';

    echo '</style>';
}

require_once get_template_directory() . '/classes/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'noir_ui_register_required_plugins');

function noir_ui_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Force Regenerate Thumbnails',
			'slug'      => 'force-regenerate-thumbnails',
			'required'  => false,
		),
		array(
			'name'      => 'WP Mail From II',
			'slug'      => 'wp-mailfrom-ii',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'noir-ui',
		'default_path' => '', // Default absolute path to bundled plugins, if any
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa($plugins, $config);
}
