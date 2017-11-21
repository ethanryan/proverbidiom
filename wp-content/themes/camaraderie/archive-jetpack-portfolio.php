<?php
/*
================================================================================================
Camaraderie - archive-jetpack-portfolio.php
================================================================================================
This will display automatically for portfolio, once you have succuessfully added content in the
portfolio in the dashboad. this is where all information  will come in and uses the the following
file content-archive-jetpack-portfolio.php to display information.

@package        Camaraderie WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjaminlu.net/)
================================================================================================
*/
?>
<?php get_header(); ?>
    <section id="site-main" class="site-main">
        <div id="content-area" class="content-area">
            <?php if (have_posts()) : ?>
                    <?php get_template_part('jetpack-portfolio/content', 'archive-jetpack-portfolio'); ?>
                    <?php
                        the_posts_navigation( array(
                            'prev_text'          => '<span class="post-previous" aria-hidden="true">' . __( 'Previous', 'camaraderie' ) . '</span>' . '<span class="post-title">Projects</span>',
                            'next_text' => '<span class="post-next" aria-hiddent="true">' . __('Next', 'camaraderie') . '</span>' . '<span class="post-title">Projects</span>',
                        ) );
                    ?>
            <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
            <?php endif; ?>
        </div>
    </section>
<?php get_footer(); ?>