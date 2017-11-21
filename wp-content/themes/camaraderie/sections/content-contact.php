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
<section id="section-contact" class="section-contact">
<div id="site-main" class="site-main">
    <?php $query = new WP_Query(array('p' => $page_id = get_theme_mod('contact_dropdown'), 'post_type' => 'page')); ?>
    <?php if ($query->have_posts()) { ?>
        <?php while ($query->have_posts()) { ?>
            <?php $query->the_post(); ?>
                <header class="entry-header">
                     <h1 class="entry-title"><?php the_title(); ?></h1>
                    <span class="entry-description"><?php camaraderie_custom_contact_description_setup(); ?></span>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
        <?php } ?>
            <?php wp_reset_postdata(); ?>
    <?php } ?>
</div>
</section>
