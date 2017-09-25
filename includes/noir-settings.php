<?php
function noir_register_theme_customizer($wp_customize) {
    $prefix = 'noir_ui';

    // Panel settings
    $wp_customize->add_panel($prefix . '_panel', array(
        'title'       => __('Noir UI Settings', 'noir-ui'),
        'description' => __('Noir UI General Settings', 'noir-ui'),
        'capability'  => 'edit_theme_options',
        'priority'    => 2,
    ));

    // Colour settings
    $wp_customize->add_setting($prefix . '_bg_color', array(
        'default'     	    => '#1E2833',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_setting($prefix . '_text_color', array(
        'default'     	    => '#ffffff',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_setting($prefix . '_text_hover_color', array(
        'default'     	    => '#ffffff',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_setting($prefix . '_dark_color', array(
        'default'     	    => '#0D1214',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_setting($prefix . '_accent_color', array(
        'default'     	    => '#DD3333',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_setting($prefix . '_overlay_color', array(
        'default'     	    => '#34495E',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_setting($prefix . '_element_color', array(
        'default'     	    => '#34495E',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_setting($prefix . '_button_text_color', array(
        'default'     	    => '#FFFFFF',
        'sanitize_callback' => 'noir_sanitize_input',
    ));

    // Colour controls
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_bg_color', array(
        'label'    => __('Background Colour', 'noir-ui'),
        'section'  => $prefix . '_colours',
        'settings' => $prefix . '_bg_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_text_color', array(
        'label'    => __('Text Colour', 'noir-ui'),
        'section'  => $prefix . '_colours',
        'settings' => $prefix . '_text_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_text_hover_color', array(
        'label'       => __('Link Hover Colour', 'noir-ui'),
        'section'     => $prefix . '_colours',
        'settings'    => $prefix . '_text_hover_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_dark_color', array(
        'label'    => __('UI Dark Colour', 'noir-ui'),
        'description' => __('Applies to menu bars and tabs.', 'noir-ui'),
        'section'  => $prefix . '_colours',
        'settings' => $prefix . '_dark_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_accent_color', array(
        'label'      => __('UI Accent Colour', 'noir-ui'),
        'section'    => $prefix . '_colours',
        'settings'   => $prefix . '_accent_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_overlay_color', array(
        'label'      => __('Transparent Overlay Colour', 'noir-ui'),
        'section'    => $prefix . '_colours',
        'settings'   => $prefix . '_overlay_color'
    )));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ui_button_text_color', array(
        'label'       => __('UI Button Text Colour', 'noir-ui'),
        'section'     => $prefix . '_colours',
        'settings'    => $prefix . '_button_text_color'
    )));

	/*-----------------------------------------------------------*
	 * Defining our own 'Display Options' section
	 *-----------------------------------------------------------*/

    $wp_customize->add_section($prefix . '_colours', array(
        'title'       => __('Colour Options', 'noir-ui'),
        'description' => __('Noir UI theme colours', 'noir-ui'),
        'panel'       => $prefix . '_panel',
    ));
    $wp_customize->add_section($prefix . '_display', array(
        'title'       => __('Display Options', 'noir-ui'),
        'description' => __('Noir UI display settings', 'noir-ui'),
        'panel'       => $prefix . '_panel',
    ));
    $wp_customize->add_section('noir_homepage', array(
        'title'       => __('Homepage Settings', 'noir-ui'),
        'description' => __('Note that all changes have moved to shortcodes. You can now use the widgets in <b>Appearance</b> -&gt; <b>Widgets</b> to add elements to your homepage.', 'noir-ui'),
        'panel'       => $prefix . '_panel',
    ));


	$wp_customize->add_setting(
		'noir_bg_overlay',
		array(
			'default'    	    =>  'true',
			'sanitize_callback' => 'noir_sanitize_input',
		)
	);
	$wp_customize->add_control(
		'noir_bg_overlay',
		array(
			'section'   => $prefix . '_display',
			'label'     => 'Display background overlay',
			'type'      => 'checkbox'
		)
	);

    $wp_customize->add_setting('noir_color_scheme', array(
        'default'   	    => 'normal',
        'sanitize_callback' => 'noir_sanitize_input',
    ));
    $wp_customize->add_control('noir_color_scheme', array(
        'section'  => $prefix . '_display',
        'label'    => 'Color Scheme',
        'type'     => 'radio',
        'choices'  => array(
            'none' => 'None (use custom colours)',
            'dark' => 'Dark (default)',
            'dark-alt' => 'Dark (alternate)',
            'light' => 'Light',
        )
    ));

    /**
	$wp_customize->add_setting(
		'noir_font',
		array(
			'default'   	    => 'times',
			'sanitize_callback' => 'noir_sanitize_input',
			'transport' 	    => 'postMessage'
		)
	);

	$wp_customize->add_control(
		'noir_font',
		array(
			'section'  => $prefix . '_display',
			'label'    => 'Theme Font',
			'type'     => 'select',
			'choices'  => array(
				'times'     => 'Times New Roman',
				'arial'     => 'Arial',
				'courier'   => 'Courier New'
			)
		)
	);
    /**/

	$wp_customize->add_setting(
		'noir_footer_copyright_text',
		array(
			'default'            => 'All Rights Reserved',
			'sanitize_callback'  => 'noir_sanitize_input',
		)
	);

	$wp_customize->add_control(
		'noir_footer_copyright_text',
		array(
			'section'  => $prefix . '_display',
			'label'    => 'Footer copyright message',
			'type'     => 'text'
		)
	);

	/**
	$wp_customize->add_section(
		'noir_advanced_options',
		array(
			'title'     => 'Advanced Options',
			'priority'  => 201
		)
	);

	$wp_customize->add_setting(
		'noir_background_image',
		array(
		    	'default'      	    => '',
			'sanitize_callback' => 'noir_sanitize_input',
		    	'transport'    	    => 'postMessage'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'noir_background_image',
			array(
			    'label'    => 'Background Image',
			    'settings' => 'noir_background_image',
			    'section'  => 'noir_advanced_options'
			)
		)
	);
	/**/
}

function noir_sanitize_input($input) {
    return strip_tags(stripslashes($input));
}

add_action('customize_register', 'noir_register_theme_customizer');
