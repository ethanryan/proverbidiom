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
        <h1 class="entry-title"><?php echo camaraderie_custom_testimonial_title_setup(); ?></h1>
    </header>
    <div class="entry-content">
        <ul class="jetpack-testimonial-grid">
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <div class="featured-testimonials">
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <?php the_post_thumbnail('camaraderie-jetpack-testimonial'); ?>
                        </a>
                    </div>
                    <div class="jetpack-testimonial-caption">
                        <h3 class="jetpack-testimonial-caption-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                    </div>
                    <?php the_content(); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</article>


          