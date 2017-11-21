<?php
/*
================================================================================================
Camaraderie - content-archive-jetpack-portfolio.php
================================================================================================
This is the most generic template file in a WordPress theme and is one required files to display
archive in many ways. This should only works for jetpack portfolio.

@package        Camaraderie WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjaminlu.net/)
================================================================================================
*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php echo camaraderie_jetpack_portfolio_title_setup(); ?></h1>
    </header>
    <div class="entry-content">
        <ul class="jetpack-portfolio-grid">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php the_post_thumbnail('camaraderie-jetpack-portfolio'); ?>
                    </a>
                    <div class="jetpack-portfolio-caption">
                        <h3 class="jetpack-portfolio-caption-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                        <?php the_terms($post->ID, 'jetpack-portfolio-type'); ?>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</article>


          