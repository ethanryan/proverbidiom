<?php
/*
================================================================================================
Camaraderie - portfolio.php
Template Name: Portfolio
Template Post Type: page
================================================================================================
This is the most generic template file in a WordPress theme and is one of the two required files 
for a theme (the other footer.php). The header.php template file only displays the header section
of this theme. This also displays the navigation menu as well or any extra features such s social
navigation.

@package        Camaraderie WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjaminlu.net/)
================================================================================================
*/
$jetpack_portfolio_display = get_theme_mod('jetpack_portfolio_display');
$blog_display = get_theme_mod('blog_display');
$testimonial_display = get_theme_mod('testimonial_display');
$contact_display = get_theme_mod('contact_display');
?>
<?php get_header(); ?>
    <?php if (isset($jetpack_portfolio_display) && $jetpack_portfolio_display != 0) { ?>
        <?php get_template_part('sections/content', 'jetpack-portfolio'); ?>
    <?php } ?>
    <?php if (isset($blog_display) && $blog_display != 0) { ?>
        <?php get_template_part('sections/content', 'blog'); ?>
    <?php } ?>
    <?php if (isset($testimonial_display) && $testimonial_display != 0) { ?>
        <?php get_template_part('sections/content', 'testimonial'); ?>
    <?php } ?>
    <?php if (isset($contact_display) && $contact_display != 0) { ?>
        <?php get_template_part('sections/content', 'contact'); ?>
    <?php } ?>
<?php get_footer(); ?>