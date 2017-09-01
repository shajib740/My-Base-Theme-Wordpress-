<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pranon-base
 */

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
    extract(pranon_base_split_option(array(
        'show_preloader'  => array('0', 'opt-switch-pageLoader'),
        'show_toolbox'  => array('0', 'opt-switch-header-toolbox'),
    )));

 if ( $show_preloader == 1 ): ?>
    <div id="page-pre-loader" class="page-pre-loader-wrapper">
        <div class="page-pre-loader">
            <svg width="50" height="50" class="circular" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20"></circle>
            </svg>
        </div>
    </div> <!-- #page-pre-loader -->
<?php endif; ?>

<div class = "container">
	<div class = "row">
		<div class = "col-md-12">
            <div id="page" class="site">
                <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'pranon-base'); ?></a>

                <?php if ( $show_toolbox == 1 ): ?>
                        <!-- header toolbox will be shown here. -->
                <?php endif; ?>

                <header id="masthead" class="site-header" role="banner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <?php get_template_part('template-parts/header/header', 'image'); ?>
                            </div><!--.col-md-12-->

                            <div class="col-md-12 text-center">
                                <?php if (has_nav_menu('top')) : ?>
                                <div class="navigation-top">
                                    <div class="wrap">
                                        <?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
                                    </div><!-- .wrap -->
                                </div><!-- .navigation-top -->
                                <?php endif; ?><!-- #site-navigation -->
                            </div><!--col-md-12-->
                        </div><!--.row-->

                    </div><!--.container-->

                </header><!-- #masthead -->
        <?php
        if ((is_single() || (is_page() && !(is_front_page() && !is_home()))) && has_post_thumbnail(get_queried_object_id())) :
            echo '<div class="single-featured-image-header">';
            echo get_the_post_thumbnail(get_queried_object_id(), 'twentyseventeen-featured-image');
            echo '</div><!-- .single-featured-image-header -->';
        endif;
        ?>

    <div class="site-content-contain">
        <div id="content" class="site-content">