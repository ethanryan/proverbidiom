<?php
/*
================================================================================================
Camaraderie - functions.php
================================================================================================
This is the most generic template file in a WordPress theme and is one of the two required files 
for a theme (the other being template-tags.php). This functions.php template file allows you to 
add features and functionality to a WordPress theme which is stored in the theme's sub-directory
in the theme folder. The second template file template-tags.php allows you to add additional 
features and functionality to the WordPress theme which is stored in the includes folder and it's 
called in the functions.php.

@package        Camaraderie WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjaminlu.net/)
================================================================================================
*/

/*
================================================================================================
Table of Content
================================================================================================
 1.0 - Theme Setup
 2.0 - Enqueue Scripts and Styles
 3.0 - Content Width
 4.0 - Register Sidebars
 5.0 - Required Files
================================================================================================
*/

/*
================================================================================================
 1.0 - Theme Setup
================================================================================================
*/
function camaraderie_theme_setup() {
    /*
    ============================================================================================
    Enable and activate add_theme_support('title-tag); for Camaraderie WordPress Theme. This 
    feature should be used in place instead of wp_title() function. 
    ============================================================================================
    */
    add_theme_support('title-tag');
    
    /*
    ============================================================================================
    Enable and activate load_theme_textdomain('camaraderie'); for Camaraderie WordPress
    Theme. This feature make this theme available for translation. 
    ============================================================================================
    */
    load_theme_textdomain('camaraderie');
    
    /*
    ============================================================================================
    Enable and activate add_theme_support('automatic-feed-links'); for Camaraderie WordPress
    Theme. This feature when enabled allows feed links for posts and comments in the head. This
    should be used in place of the deprecated automatic_feed_link(); function.
    ============================================================================================
    */
    add_theme_support('automatic-feed-links');
    
    /*
    ============================================================================================
    Enable and activate register_nav_menus(); for Nu Snowflakes WordPress Theme. This feature
    when enabled, allows you to create a Primary Navigation and Social Navigation
    menus in the dashboard under Menus.
    ============================================================================================
    */
	register_nav_menus(array(
		'primary-navigation' 	=> esc_html__('Primary Navigation', 'camaraderie'),
        'social-navigation'     => esc_html__('Social Navigation', 'camaraderie'),
	));
    
    /*
    ============================================================================================
    Enable and activate add_theme_support('html5'); for Camaraderie WordPress Theme. This 
    feature allows the use of HTML5 markup for search forms, comment forms, comment list, gallery, 
    and captions.
    ============================================================================================
    */
    add_theme_support('html5', array(
        'comment-list',
        'comment-form',
        'search-form', 
        'gallery',
        'caption'
    ));
    
    /*
    ============================================================================================
    Enable and activate add_theme_support('cusom-background'); for Camaraderie WordPress Theme. This 
    feature allows the use of HTML5 markup for search forms, comment forms, comment list, gallery, 
    and captions.
    ============================================================================================
    */
    add_theme_support('custom-background', array(
        'default-color' => 'eeeeee',
    ));
    
    /*
    ============================================================================================
    Enable and activate add_theme_support('post-thumbnails); for Camaraderie WordPress Theme. 
    This feature enables Post Thumbnails (Featured Images) support for a theme. If you wish to 
    display thumbnails, use the following to display the_post_thumbnail();. If you need to to 
    check of there is a post thumbnail, then use has_post_thumbnail();.
    ============================================================================================
    */
    add_theme_support('post-thumbnails');
    
    /*
    ============================================================================================
    add_image_size('camaraderie-small-thumbnails', 300, 300, true); should be used under the
    following files. content.php
    ============================================================================================
    */
    add_image_size('camaraderie-small-thumbnails', 300, 300, true);
    
    /*
    ============================================================================================
    add_image_size('camaraderie-medium-thumbnails', 834, 250, true); should be used under the
    following files. single.php
    ============================================================================================
    */
    add_image_size('camaraderie-medium-thumbnails', 834, 250, true);
    
    /*
    ============================================================================================
    add_image_size('camaraderie-large-thumbnails', 1200, 630, true); should be used under the
    following files. single-portfolio.phpi mea
    ============================================================================================
    */
    add_image_size('camaraderie-jetpack-portfolio', 1200, 630, true);
    
    /*
    ============================================================================================
    add_image_size('camaraderie-jetpack-testimonial', 200, 200, true); should be used under the
    following files. content.php
    ============================================================================================
    */
    add_image_size('camaraderie-jetpack-testimonial', 200, 200, true);
    
    /*
    ============================================================================================
    add_post_type_support('page', 'excerpt'); should be used under the pages, you will need to
    select Excerpt in the Screen Option to enable this feature.
    ============================================================================================
    */
    add_post_type_support('page', 'excerpt');
    
    /*
    ============================================================================================
    load_theme_textdomain(); allows the WordPress Core to take care of all transations rather than
    using a .pot file. A pot file is not required, but recommended.
    ============================================================================================
    */
    load_theme_textdomain('camaraderie');
}
add_action('after_setup_theme', 'camaraderie_theme_setup');

/*
================================================================================================
 2.0 - Enqueue Scripts and Styles
================================================================================================
*/
function camaraderie_enqueue_scripts_styles_setup() {
    /*
    ============================================================================================
    Enable and activate the main stylesheet and custom stylesheet if available for Camaraderie
    WordPress Theme. The main stylesheet should be enqueued rather than using @import.
    ============================================================================================
    */
    wp_enqueue_style('camaraderie-style', get_stylesheet_uri());
    
    /*
    ============================================================================================
    Enable and activate Google Fonts (Sanchez and Merriweather) locally for Camaraderie WordPress 
    Theme. For more information regarding this feature, please go the following url to begin the 
    awesomeness of Google WebFonts Helper. 
    Reference: (https://google-webfonts-helper.herokuapp.com/fonts)
    ============================================================================================
    */
    wp_enqueue_style('camaraderie-custom-fonts', get_template_directory_uri() . '/extras/fonts/custom-fonts.css', '08012017', true);
    
    /*
    ============================================================================================
    Enable and activate Font Awesome 4.7 locally for Camaraderie WordPress Theme. For more 
    information about Font Awesome, please navigate to the URL for more information. 
    Reference: (http://fontawesome.io/)
    ============================================================================================
    */
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/extras/font-awesome/css/font-awesome.css', '08012017', true);
    
    /*
    ============================================================================================
    Enable and activate (JavaScript/JQuery) to support Navigation Menu for Primary Navigation for 
    Camaraderie WordPress Theme. This allows you to use click feature for dropdowns and multiple 
    depths, When using this new feature of the navigation. The Menu for mobile side is now at the 
    bottom of the page.
    ============================================================================================
    */
    wp_enqueue_script('camaraderie-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '08012017', true);
	wp_localize_script('camaraderie-navigation', 'camaraderieScreenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __('expand child menu', 'camaraderie') . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __('collapse child menu', 'camaraderie') . '</span>',
	));
    
    /*
    ============================================================================================
    Enable and activate the threaded comments for Camaraderie WordPress Theme. This allows 
    users to comment by clicking on reply so that it gets nested to the comments you are trying 
    to response too. Please do remember that you can change the depth of comment's reply in the
    comments setting in the dashboard.
    ============================================================================================
    */
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'camaraderie_enqueue_scripts_styles_setup');

/*
================================================================================================
 3.0 - Content Width
================================================================================================
*/
function camaraderie_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'camaraderie_content_width', 800 );
}
add_action( 'after_setup_theme', 'camaraderie_content_width', 0 );

/*
================================================================================================
 4.0 - Register Sidebars
================================================================================================
*/
function camaraderie_register_sidebars_setup() {
    /*
    ============================================================================================
    Enable and activate Primary Sidebar for Camaraderie WordPress Theme. The Primary Sidebar
    should only show in the blog posts only rather in the pages. 
    ============================================================================================
    */
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'camaraderie'),
        'description'   => __('Add widgets here to appear in your sidebar on Blog Posts and Archives only', 'camaraderie'),
        'id'            => 'primary-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    /*
    ============================================================================================
    Enable and activate Secondary Sidebar for Camaraderie WordPress Theme. The Primary Sidebar
    should only show in the blog posts only rather in the page. 
    ============================================================================================
    */
    register_sidebar(array(
        'name'          => __('Secondary Sidebar', 'camaraderie'),
        'description'   => __('Add widgets here to appear in your sidebar on Pages only.', 'camaraderie'),
        'id'            => 'secondary-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    /*
    ============================================================================================
    Enable and activate Custom Sidebar for Camaraderie WordPress Theme. The Primary Sidebar
    should only show in the blog posts only rather in the page. 
    ============================================================================================
    */
    register_sidebar(array(
        'name'          => __('Custom Sidebar', 'camaraderie'),
        'description'   => __('Add widgets here in your sidebar on Custom Pages only.', 'camaraderie'),
        'id'            => 'custom-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    /*
    ============================================================================================
    Enable and activate About Sidebar for Camaraderie WordPress Theme. The About Sidebar should 
    only show in the about page only rather in the default page. 
    ============================================================================================
    */
    register_sidebar(array(
        'name'          => __('About Sidebar', 'camaraderie'),
        'description'   => __('Add widgets here in your sidebar on About Page only.', 'camaraderie'),
        'id'            => 'about-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    /*
    ============================================================================================
    Enable and activate Portfolio Sidebar for Camaraderie WordPress Theme. The Portfolio Sidebar 
    should only show in the Portfolio only rather in the default page. 
    ============================================================================================
    */
    register_sidebar(array(
        'name'          => __('Portfolio Sidebar', 'camaraderie'),
        'description'   => __('Add widgets here in your sidebar on About Page only.', 'camaraderie'),
        'id'            => 'portfolio-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'camaraderie_register_sidebars_setup');

/*
================================================================================================
 5.0 - Required Files
================================================================================================
*/
require_once(get_template_directory() . '/extras/inline-styles/custom-image.php');
require_once(get_template_directory() . '/extras/inline-styles/header-image.php');
require_once(get_template_directory() . '/includes/custom-header.php');
require_once(get_template_directory() . '/includes/customizer/control-radio-image.php');
require_once(get_template_directory() . '/includes/customizer/customizer.php');
require_once(get_template_directory() . '/includes/extras.php');
require_once(get_template_directory() . '/includes/jetpack.php');
require_once(get_template_directory() . '/includes/template-tags.php');