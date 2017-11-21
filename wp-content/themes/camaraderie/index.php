<?php
/*
================================================================================================
Camaraderie - header.php
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
    <div id="site-main" class="site-main">
        <div id="content-area" class="content-area">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', get_post_format()); ?>
            <?php endwhile; ?>
                <?php the_posts_pagination(); ?>
            <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer(); ?>