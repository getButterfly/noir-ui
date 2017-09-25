<!doctype html>
<html class="ui" <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<meta http-equiv="cleartype" content="on">
<meta name="MobileOptimized" content="320">
<meta name="HandheldFriendly" content="True">
<meta name="apple-mobile-web-app-capable" content="yes">

<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="ui-base" id="menu">
    <?php if(is_active_sidebar('responsive-menu-widget-1')) dynamic_sidebar('responsive-menu-widget-1'); ?>
    <?php wp_nav_menu(array('theme_location' => 'responsive-menu', 'container' => false)); ?>
    <?php if(is_active_sidebar('responsive-menu-widget-2')) dynamic_sidebar('responsive-menu-widget-2'); ?>
</div>

<div id="panel">
    <div class="js-slideout-toggle ui-base"><i class="material-icons">menu</i></div>

    <?php // Main menu bar ?>
    <div class="hmenu">
        <nav class="ui-base">
            <?php wp_nav_menu(array('theme_location' => 'main-menu', 'container' => false)); ?>
        </nav>
    </div>
    <?php // ?>

    <div id="wrap">
        <div id="wrapper" class="hfeed">
            <div id="container">
