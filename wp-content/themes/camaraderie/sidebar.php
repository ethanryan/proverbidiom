<?php
/*
================================================================================================
Entmaidens - sidebar.php
================================================================================================
This is the most generic template file in a WordPress theme and is one of the requirements to 
display widgets on the bottom of the page. This is the footer sidebar that is assigned in the 
widget area in the customizer and widget area.

@package        Entmaidens WordPress Theme
@copyright      Copyright (C) 2017. Benjamin Lu
@license        GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
@author         Benjamin Lu (https://www.lumiathemes.com/)
================================================================================================
*/
?>
<div id="widget-area" class="widget-area">
    <?php dynamic_sidebar('primary-sidebar'); ?>
</div>