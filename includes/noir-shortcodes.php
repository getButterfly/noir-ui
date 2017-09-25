<?php
add_shortcode('noir-hero', 'noir_element_hero');
add_shortcode('noir-box', 'noir_element_box');
add_shortcode('noir-boilerplate', 'noir_element_boilerplate');
add_shortcode('noir-grid', 'noir_element_grid');
add_shortcode('icon', 'noir_element_fontawesome');

add_filter('widget_text', 'do_shortcode');

function noir_element_grid($atts = '', $content = null) {
    extract(shortcode_atts(array(
		'category' => '',
		'count' => 8,
	), $atts));

    $args = array(
        'category_name' => $category,
        'posts_per_page' => (int) $count,
    );
    $the_query = new WP_Query($args);
    $h = 0;

    $out = '';
    $out .= '<div class="m-hero touch hero_5 five_heroes gradient_variant_5" id="homepage_hero">
        <div class="m-hero__slider">';
            if ($the_query->have_posts()) {
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    ++$h;
                    $featured = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                    $out .= '<div class="m-hero__entry entry_' . $h . ' entry-type-article"><div class="m-hero__image" style="background: url(' . $featured[0] . ') no-repeat center center; background-size: cover;"><a class="m-hero__full-link" href="' . get_permalink() . '"></a><div class="m-hero__meta entry-type-article"><h2 class="m-hero__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2></div></div></div>';
                }
            }
            wp_reset_postdata();
        $out .= '</div>
    </div>';

    return $out;
}

function noir_element_box($atts, $content = null) {
	extract(shortcode_atts(array(
		'size'  => 'full', // full width 100% is default
		'color' => 'inherit',
		'align'	=> '',
		'float'	=> '',
		'text'	=> '',
	), $atts));

	$size = ($size) ? ''.$size : '';
	$color = ($color) ? ' '.$color : '';
	$text = ($text) ? ' text'.$text : '';
	$align = ($align) ? ' align'.$align : '';
	$float = ($float) ? ' float'.$float : '';

	if(strpos($size, 'last') === false) {
		// if 'last' is not found
		return '<div class="' .$size.$align.$float.$text. ' awesome-box" style="background-color: ' . $color . ';"><span class="box-icon"></span><span class="box-content">' . do_shortcode($content) . '</span></div>';
	}
	else {
		// if 'last' is found
		return '<div class="' .$size.$align.$float.$text. ' awesome-box" style="background-color: ' . $color . ';"><span class="box-icon"></span><span class="box-content">' . do_shortcode($content) . '</span></div><span class="clearboth"></span>';
	}
}

// clean up formatting in shortcodes
function noir_clean_shortcodes($content) {   
	$array = array(
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'noir_clean_shortcodes');

// Font Awesome Shortcodes
function noir_element_fontawesome($atts) {
    extract(shortcode_atts(array(
    'type'  => '',
    'size' => '',
    'rotate' => '',
    'flip' => '',
    'pull' => '',
    'animated' => '',
    'class' => '',
  
    ), $atts));
 
    $classes  = ($type) ? 'fa-'.$type. '' : 'fa-star';
    $classes .= ($size) ? ' fa-'.$size.'' : '';
    $classes .= ($rotate) ? ' fa-rotate-'.$rotate.'' : '';
    $classes .= ($flip) ? ' fa-flip-'.$flip.'' : '';
    $classes .= ($pull) ? ' pull-'.$pull.'' : '';
    $classes .= ($animated) ? ' fa-spin' : '';
    $classes .= ($class) ? ' '.$class : '';
 
    $theAwesomeFont = '<i class="fa '.esc_html($classes).'"></i>';
      
    return $theAwesomeFont;
}
  

add_filter('widget_text', 'do_shortcode');







function noir_element_hero($atts, $content = null) {
    extract(shortcode_atts(array(
        'type' => 'post',
        'category' => '',
    ), $atts));

	$args = array(
		'post_type' => $type,
		'category_name' => $category,
		'posts_per_page' => 1
	);
    $the_query = new WP_Query($args);

	if($the_query->have_posts()) {
		while($the_query->have_posts()) {
			$the_query->the_post();
			$hero = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'hero-thumbnail');

            $out = '';
			$out .= '<section class="hero" style="background: url(' . $hero[0] . ') center center no-repeat; background-size: cover;">
				<div class="inlay">';
					$comments = get_comments(array('number' => '5', 'post_id' => get_the_ID()));
					if(count($comments) > 0) {
						$out .= '<div class="reviews">';
							foreach($comments as $comment) {
								$out .= '<div>' . get_avatar($comment->user_id, 90) . '<p><b>' . $comment->comment_author . '</b>' . substr($comment->comment_content, 0, 90) . '&hellip;</p></div>';
							}
						$out .= '</div>';
					}

					$out .= '<div class="title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>

					<div class="content">' . get_the_excerpt() . '</div>
					<div class="buy"><a href="' . get_permalink() . '" class="button-main">Read more</a></div>
				</div>
			</section>';
		}

        return $out;
	}
	else {
		// no posts found
	}

	wp_reset_postdata();
}



function noir_element_boilerplate($atts, $content = null) {
    extract(shortcode_atts(array(
        'welcome' => 'Welcome to',
    ), $atts));

    $out = '<div class="boilerplate-container">
        <h1 class="boilerplate-title">' . $welcome . ' <span class="teal">' . get_bloginfo('name') . '</span></h1>
        <h2 class="boilerplate-content">' . get_bloginfo('description') . '</h2>
	</div>';

    return $out;
}
