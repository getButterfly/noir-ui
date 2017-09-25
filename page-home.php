<?php  
/* 
Template Name: Homepage
*/
get_header(); ?>

<section id="content-wide" role="main">
    <?php
    if(is_active_sidebar('home-widget-1')) dynamic_sidebar('home-widget-1');
    if(is_active_sidebar('home-widget-main')) dynamic_sidebar('home-widget-main');
    if(is_active_sidebar('home-widget-content')) dynamic_sidebar('home-widget-content');
    if(is_active_sidebar('home-widget-2')) dynamic_sidebar('home-widget-2');
    ?>
</section>

<?php get_footer();