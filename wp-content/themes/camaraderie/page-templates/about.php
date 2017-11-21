<?php
/*
================================================================================================
Camaraderie - about.php
Template Name: About
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
?>
<?php get_header(); ?>
    <section id="site-main" class="site-main">
        <div id="global-layout" class="<?php echo esc_attr(get_theme_mod('global_layout', 'no-sidebar')); ?>">
            <div id="content-area" class="content-area">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', 'page'); ?>
                <?php endwhile; ?>
                <?php comments_template(); ?>
            </div>
            <?php if ('left-sidebar' == get_theme_mod('global_layout')) { ?>
                <?php get_sidebar('about'); ?>
            <?php } else if ('right-sidebar' == get_theme_mod('global_layout')) { ?>
                <?php get_sidebar('about'); ?>
            <?php } ?>
        </div>
    </section>
<?php get_footer(); ?>