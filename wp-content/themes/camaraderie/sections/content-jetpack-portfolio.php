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
<section id="section-portfolio" class="section-portfolio">
<div id="site-main" class="site-main">
    <header class="entry-header">
        <h1 class="entry-title"><?php camaraderie_jetpack_portfolio_title_setup(); ?></h1>
        <span class="entry-description"><?php camaraderie_jetpack_portfolio_content(); ?></span>
    </header>
    <div class="entry-content">
        <ul class="jetpack-portfolio-grid">
            <?php $posts_per_page = get_option('jetpack_portfolio_posts_per_page'); ?>
            <?php $query = new WP_Query(array('post_type'   => 'jetpack-portfolio', 'posts_per_page' => $posts_per_page)); ?>

            <?php if ($query->have_posts()) { ?>
                <?php while ($query->have_posts()) { ?>
                    <?php $query->the_post(); ?>
                       <?php if ( has_post_thumbnail() ) { ?>
                        <li>
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php the_post_thumbnail('camaraderie-large-thumbnails'); ?>
                                </a>
                                <div class="jetpack-portfolio-caption">
                                    <h3 class="jetpack-portfolio-caption-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                                    <?php the_terms($post->ID, 'jetpack-portfolio-type'); ?>
                                </div>
                        </li>
                    <?php } ?>
                <?php } ?> 
                <?php wp_reset_postdata(); ?>
            <?php } ?>
        </ul>
    </div>
</div>
</section>