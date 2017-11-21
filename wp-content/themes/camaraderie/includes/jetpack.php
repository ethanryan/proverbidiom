<?php
/*
================================================================================================
Splendid Portfolio - jetpack.php
================================================================================================
This is the most generic template file in a WordPress theme and is one of the required file for
a theme. The jetpack.php template file allows you to enable certain features within jetpack's
plugin. In this case, the only feature is supported in this theme is portfolio feature. 

@package        Splendid Portfolio WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.lumiathemes.com/)
================================================================================================
*/

/*
================================================================================================
Table of Content
================================================================================================
 1.0 - Jetpack Setup
 2.0 - Jetpack Portfolio Title and Content
 3.0 - Jetpack Class (Jetpack Customization)
================================================================================================
*/

/*
================================================================================================
 1.0 - Jetpack Setup
================================================================================================
*/
function camaraderie_jetpack_setup() {
    add_theme_support('jetpack-responsive-videos');
    add_theme_support('jetpack-portfolio', array('title' => true, 'content' => true));
}
add_action('after_setup_theme', 'camaraderie_jetpack_setup');

/*
================================================================================================
 2.0 - Jetpack Portfolio Title and Content
================================================================================================
*/
function camaraderie_jetpack_portfolio_title_setup($before = '', $after = '') {
    $portfolio_title = get_option('jetpack_portfolio_title', __('Projects', 'camaraderie'));
    $title = '';
    
    if (isset($portfolio_title) && '' != $portfolio_title) {
        $title = esc_html($portfolio_title);
    } else {
        $title = esc_html(post_type_archive_title('', false));
    }
    echo $before . $title . $after;
}

function camaraderie_jetpack_portfolio_content($before = '', $after = '') {
	$portfolio_description = get_option('jetpack_portfolio_content', __('Some of My Recent Works.', 'camaraderie'));

	if (is_tax() && get_the_archive_description()) {
		echo $before . get_the_archive_description() . $after;
	} else if (isset($portfolio_description) && '' != $portfolio_description) {
		$content = convert_chars(convert_smilies(wptexturize(stripslashes(wp_filter_post_kses(addslashes($portfolio_description))))));
		echo $before . $content . $after;
	}
}

function camaraderie_custom_blog_title_setup() {
    $blog_title = get_theme_mod('blog_title', __('Blog', 'camaraderie'));
    $title = '';
    
    if (isset($blog_title) && '' != $blog_title) {
        $title = esc_html($blog_title);
    }
    echo $before . $title . $after;
}

function camaraderie_custom_blog_description_setup() {
    $blog_description = get_theme_mod('blog_description', __('Latest News', 'camaraderie'));
    
    if (isset($blog_description) && '' != $blog_description) {
        $content = convert_chars(convert_smilies(wptexturize(stripslashes(wp_filter_post_kses(addslashes($blog_description))))));
    }
    echo $before . $content . $after;
}

function camaraderie_custom_testimonial_title_setup() {
    $blog_title = get_theme_mod('testimonial_title', __('Blog', 'camaraderie'));
    $title = '';
    
    if (isset($blog_title) && '' != $blog_title) {
        $title = esc_html($blog_title);
    }
    echo $before . $title . $after;
}

function camaraderie_custom_testimonial_description_setup() {
    $testimonial_description = get_theme_mod('testimonial_description', __('Latest News', 'camaraderie'));
    
    if (isset($testimonial_description) && '' != $testimonial_description) {
        $content = convert_chars(convert_smilies(wptexturize(stripslashes(wp_filter_post_kses(addslashes($testimonial_description))))));
    }
    echo $before . $content . $after;
}

function camaraderie_custom_contact_description_setup() {
    $contact_description = get_theme_mod('contact_description', __('Latest News', 'camaraderie'));
    
    if (isset($contact_description) && '' != $contact_description) {
        $content = convert_chars(convert_smilies(wptexturize(stripslashes(wp_filter_post_kses(addslashes($contact_description))))));
    }
    echo $before . $content . $after;
}

/*
================================================================================================
 3.0 - Jetpack Class (Jetpack Customization)
================================================================================================
*/
if (class_exists('Jetpack_Portfolio')) {
    function camaraderie_jetpack_customize_register_setup($wp_customize) {
        //Enable Home Section for Portfolio Custom Template
        $wp_customize->add_panel('home_section', array(
            'title' => esc_html__('Home Section', 'camaraderie'),
            'priority'  => 5
        ));
        
        // Portfolio Section
        $wp_customize->get_section('jetpack_portfolio')->panel = 'home_section';
        $wp_customize->get_section('jetpack_portfolio')->title = esc_html__('Portfolio Section', 'camaraderie');
        $wp_customize->get_section('jetpack_portfolio')->priority = 5;
        $wp_customize->get_control('jetpack_portfolio_title')->priority = 20;
        $wp_customize->get_control('jetpack_portfolio_content')->priority = 25;
        
        $wp_customize->add_setting('jetpack_portfolio_display', array(
            'sanitize_callback' => 'camaraderie_sanitize_checkbox',
        ));
        
        $wp_customize->add_control('jetpack_portfolio_display', array(
            'label'     => esc_html__('Enable Portfolio Section', 'camaraderie'),
            'type'      => 'checkbox',
            'section'   => 'jetpack_portfolio',
            'settings'  => 'jetpack_portfolio_display',
            'priority'  => 5,
        ));
        
        $wp_customize->add_setting('jetpack_portfolio_background', array(
            'default'   => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )); 
        
        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'jetpack_portfolio_background', array(
            'label'     => esc_html__('Background Color', 'camaraderie'),
            'section'   => 'jetpack_portfolio',
            'settings'  => 'jetpack_portfolio_background',
            'priority'  => 10
        )));
        
        // Blog Section
        $wp_customize->add_section('blog_section', array(
            'title'     => esc_html__('Blog Section', 'camaraderie'),
            'panel'     => 'home_section',
            'priority'  => 5
        ));
        
        $wp_customize->add_setting('blog_display', array(
            'sanitize_callback' => 'camaraderie_sanitize_checkbox',
        ));
        
        $wp_customize->add_control('blog_display', array(
            'label'     => esc_html__('Enable Blog Section', 'camaraderie'),
            'type'      => 'checkbox',
            'section'   => 'blog_section',
            'settings'  => 'blog_display',
            'priority'  => 5,
        ));
    
        $wp_customize->add_setting('blog_background', array(
            'default'   => '#eeeeee',
            'sanitize_callback' => 'sanitize_hex_color',
        )); 
        
        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_background', array(
            'label'     => esc_html__('Background Color', 'camaraderie'),
            'section'   => 'blog_section',
            'settings'  => 'blog_background',
            'priority'  => 10
        )));
        
        $wp_customize->add_setting('blog_title', array(
            'default'   => esc_html__('Blog', 'camaraderie'),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control('blog_title', array(
            'label'     => esc_html__('Blog Title', 'camaraderie'),
            'type'      => 'text',
            'section'   => 'blog_section',
            'settings'  => 'blog_title',
            'priority'  => 10,
        ));
        
        $wp_customize->add_setting('blog_description', array(
            'default'   => esc_html__('Latest News', 'camaraderie'),
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('blog_description', array(
            'label'     => esc_html__('Blog Description', 'camaraderie'),
            'type'      => 'textarea',
            'section'   => 'blog_section',
            'settings'  => 'blog_description',
            'priority'  => 10,
        ));
        
        // Testimonial Section
        $wp_customize->add_section('testimonial_section', array(
            'title'     => esc_html__('Testimonial Section', 'camaraderie'),
            'panel'     => 'home_section',
            'priority'  => 5
        ));
        
        $wp_customize->add_setting('testimonial_display', array(
            'sanitize_callback' => 'camaraderie_sanitize_checkbox',
        ));
        
        $wp_customize->add_control('testimonial_display', array(
            'label'     => esc_html__('Enable Testimonial Section', 'camaraderie'),
            'type'      => 'checkbox',
            'section'   => 'testimonial_section',
            'settings'  => 'testimonial_display',
            'priority'  => 5,
        ));
        
        $wp_customize->add_setting('testimonial_background', array(
            'default'   => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )); 
        
        $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'testimonial_background', array(
            'label'     => esc_html__('Background Color', 'camaraderie'),
            'section'   => 'testimonial_section',
            'settings'  => 'testimonial_background',
            'priority'  => 10
        )));
        
        $wp_customize->add_setting('testimonial_title', array(
            'default'   => esc_html__('Testimonials', 'camaraderie'),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control('testimonial_title', array(
            'label'     => esc_html__('Testimonial Title', 'camaraderie'),
            'type'      => 'text',
            'section'   => 'testimonial_section',
            'settings'  => 'testimonial_title',
            'priority'  => 10,
        ));
        
        $wp_customize->add_setting('testimonial_description', array(
            'default'   => esc_html__('What People Say About Us.', 'camaraderie'),
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('testimonial_description', array(
            'label'     => esc_html__('Testimonial Description', 'camaraderie'),
            'type'      => 'textarea',
            'section'   => 'testimonial_section',
            'settings'  => 'testimonial_description',
            'priority'  => 10,
        ));
        
        // Contact Information Section
        $wp_customize->add_section('contact_section', array(
            'title'     => esc_html__('Contact Section', 'camaraderie'),
            'panel'     => 'home_section',
        ));
        
        $wp_customize->add_setting('contact_display', array(
            'sanitize_callback' => 'camaraderie_sanitize_checkbox',
        ));
        
        $wp_customize->add_control('contact_display', array(
            'label'     => esc_html__('Enable Contact Section', 'camaraderie'),
            'description'   => esc_html__('This section is intended to be used only for contact form and will need to activate Contact Form 7 plugin for this to work.', 'camaraderie'),
            'type'      => 'checkbox',
            'section'   => 'contact_section',
            'settings'  => 'contact_display',
            'priority'  => 5,
        ));
        
        $wp_customize->add_setting('contact_background', array(
            'default'   => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )); 
        
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'contact_background', array(
            'label'     => esc_html__('Background Color', 'camaraderie'),
            'section'   => 'contact_section',
            'settings'  => 'contact_background',
            'priority'  => 10
        )));
        
        $wp_customize->add_setting('contact_description', array(
            'default'   => esc_html__('Questions or Hire Me.', 'camaraderie'),
            'sanitize_callback' => 'wp_kses_post',
        ));
        
        $wp_customize->add_control('contact_description', array(
            'label'     => esc_html__('Contact Description', 'camaraderie'),
            'type'      => 'textarea',
            'section'   => 'contact_section',
            'settings'  => 'contact_description',
            'priority'  => 15,
        ));
        
        $wp_customize->add_setting('contact_dropdown', array(
            'sanitize_callback' => 'camaraderie_sanitize_dropdown',
        ));
        
        $wp_customize->add_control('contact_dropdown', array(
            'type' => 'dropdown-pages',
            'section' => 'contact_section',
            'label' => __( 'Custom Dropdown Pages', 'camaraderie'),
        ) );
        
    }
    add_action('customize_register', 'camaraderie_jetpack_customize_register_setup', 11);
}

function camaraderie_jetpack_portfolio_custom_styles_setup() {
    $portfolio_background = get_theme_mod('jetpack_portfolio_background');
    $blog_background = get_theme_mod('blog_background'); 
    $testimonial_background = get_theme_mod('testimonial_background');
    $contact_background = get_theme_mod('contact_background'); ?>

    <style type="text/css">
        .section-portfolio {
            background: <?php echo esc_html($portfolio_background); ?>;
        }
        
        .section-blog {
            background: <?php echo esc_html($blog_background); ?>;
        }
        
        .section-testimonial {
            background: <?php echo esc_html($testimonial_background); ?>;
        }
        
        .section-contact {
            background: <?php echo esc_html($contact_background); ?>;
        }
    </style>
<?php
}
add_action('wp_head', 'camaraderie_jetpack_portfolio_custom_styles_setup');