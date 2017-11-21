<?php
/*
================================================================================================
Camaraderie - content-blog.php
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
<section id="section-blog" class="section-blog">
<div id="site-main" class="site-main">
    <header class="entry-header">
        <h1 class="entry-title"><?php camaraderie_custom_blog_title_setup(); ?></h1>
        <span class="entry-description"><?php camaraderie_custom_blog_description_setup(); ?></span>
    </header>
    <div class="entry-content">
        <ul class="blog-grid">
            <?php $posts_per_page = 2; ?>
            <?php $query = new WP_Query(array('post_type' => 'post', 'ignore_sticky_posts' => 1, 'posts_per_page' => $posts_per_page)); ?>

            <?php if ($query->have_posts()) { ?>
                <?php while ($query->have_posts()) { ?>
                    <?php $query->the_post(); ?>
                    <li>
                        <?php the_post_thumbnail('camaraderie-medium-thumbnails'); ?>
                        <header class="recent-header">
                            <span><?php echo camaraderie_entry_time_stamp_setup(); ?></span>
                            <h2 class="recent-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
                        </header>
                        <div class="entry-excerpt">
                            <?php the_excerpt(); ?>
                            <?php if (!is_singular() || is_front_page()) { ?>
                                <div class="continue-reading">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <?php
                                            printf(
                                                wp_kses(__('Read More %s', 'camaraderie'), array('span' => array('class' => array()))),
                                                the_title('<span class="screen-reader-text">"', '"</span>', false)
                                            );
                                        ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </li> 
                <?php } ?> 
                <?php wp_reset_postdata(); ?>
            <?php } ?>
        </ul>
    </div>
</div>
</section>