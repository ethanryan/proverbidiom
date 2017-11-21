<?php
/*
================================================================================================
Camaraderie - sidebar-portfolio.php
================================================================================================
This is the most generic template file in a WordPress theme and is one of the requirements to 
display widgets on the bottom of the page. This is the footer sidebar that is assigned in the 
widget area in the customizer and widget area.

@package        Camaraderie WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjaminlu.net)
================================================================================================
*/
?>
<div id="widget-area" class="widget-area">
    <?php if (has_post_thumbnail()) { ?>
        <aside id="widget" class="widget widget_text">
            <?php the_post_thumbnail('camaraderie_large_thumbnails'); ?>
        </aside>
    <?php } ?>
    <?php if (!dynamic_sidebar('portfolio-sidebar')) { ?>
        <?php the_widget('WP_Widget_Categories', array(
            'dropdown'  => true,
            'hierarchical' => true), array(
            'before_widget' => '<aside id="widget" class="widget widget_categories">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )); 
        ?>
    
        <?php the_widget('WP_Widget_Tag_Cloud', array(), array(
            'before_widget' => '<aside id="widget" class="widget widget_tag_cloud">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )); 
        ?>
    
        <?php the_widget('WP_Widget_Meta', array(), array(
            'before_widget' => '<aside id="widget" class="widget widget_meta">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )); 
        ?>
    <?php } ?>
</div>