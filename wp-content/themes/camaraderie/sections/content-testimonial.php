<?php
/*
================================================================================================
Camaraderie - content-testimonial.php
================================================================================================
This is the most generic template file in a WordPress theme and is one required files to display
content. This content.php is the main content that will be displayed when is on front page, home
or index.

@package        Camaraderie WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.benjaminlu.net/)
================================================================================================
*/
?>
<section id="section-testimonial" class="section-testimonial">
<div id="site-main" class="site-main">
    <header class="entry-header">
        <h1 class="entry-title"><?php camaraderie_custom_testimonial_title_setup(); ?></h1>
        <span class="entry-description"><?php camaraderie_custom_testimonial_description_setup(); ?></span>
    </header>
    <div class="entry-content">
        <ul class="jetpack-testimonial-grid">
            <?php $posts_per_page = 3; ?>
            <?php $query = new WP_Query(array('post_type' => 'jetpack-testimonial', 'orderby' => 'rand', 'posts_per_page' => $posts_per_page)); ?>

            <?php if ($query->have_posts()) { ?>
                <?php while ($query->have_posts()) { ?>
                    <?php $query->the_post(); ?>
                    <li>
                        <div class="featured-testimonials">
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <?php the_post_thumbnail('camaraderie-jetpack-testimonial'); ?>
                            </a>
                        </div>
                        <header class="recent-header">
                            <h2 class="recent-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
                        </header>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </li> 
                <?php } ?> 
                <?php wp_reset_postdata(); ?>
            <?php } ?>
        </ul>
    </div>
</div>
</section>