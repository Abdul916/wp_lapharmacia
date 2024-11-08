<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Biolife
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="profile" href="https://gmpg.org/xfn/11"/>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a href="#" class="overlay-body" aria-hidden="true"></a>

<!-- #page -->
<div id="page" class="site">

    <?php biolife_header_template(); ?>
