<?php
/*
================================================================================================
Camaraderie - customizer.php
================================================================================================
The customizer.php gives the user the ability to change features within the customizer. This has
been setup to allow users to set different layouts within the theme and other features that the
WordPress functionality is included.

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
 1.0 - Customize Register (Setup)
 2.0 - Customize Register (Validation)
================================================================================================
*/

/*
================================================================================================
 1.0 - Customize Register (Setup)
================================================================================================
*/
function camaraderie_customize_register_setup($wp_customize) { 
    // Enable Custom Background for Static Page Only
    $wp_customize->add_panel('header_section', array(
        'title' => esc_html__('Header Section', 'camaraderie'),
        'priority'  => 5
    ));
    
    $wp_customize->add_section('custom_image', array(
        'title' => esc_html__('Custom Image', 'camaraderie'),
        'panel'     => 'header_section',
        'priority'  => 5,
    ));
    
    $wp_customize->add_setting('custom_image', array(
        'default'   => get_template_directory_uri() . '/images/custom-image.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_image', array(
        'label'     => esc_html__('Custom Image', 'camaraderie'),
        'section'   => 'custom_image',
        'settings'  => 'custom_image',
    )));   
    
    $wp_customize->add_section('custom_avatar', array(
        'title' => esc_html__('Avatar Image', 'camaraderie'),
        'panel'     => 'header_section',
        'priority'  => 5,
    ));
    
    $wp_customize->add_setting('custom_avatar', array(
        'default'   => get_template_directory_uri() . '/images/avatar.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'custom_avatar', array(
        'label'     => esc_html__('Avatar Image', 'camaraderie'),
        'section'   => 'custom_avatar',
        'settings'  => 'custom_avatar',
    )));
}
add_action('customize_register', 'camaraderie_customize_register_setup');

/*
================================================================================================
 2.0 - Customize Register (Validation)
================================================================================================
*/
function camaraderie_sanitize_checkbox($value) {
    return((isset($value) && true == $value) ? true : false);
}

function camaraderie_sanitize_textarea($textbox) {
	return wp_kses_post(force_balance_tags($textbox));
}

function camaraderie_sanitize_dropdown($page_id, $setting) {
  $page_id = absint($page_id);
    
  return ('publish' == get_post_status($page_id) ? $page_id : $setting->default );
}