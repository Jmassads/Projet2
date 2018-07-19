<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package strasbourg
 */

?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <html class="no-js" <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content">
                <?php esc_html_e( 'Skip to content', 'strasbourg' ); ?>
            </a>

            <header class="banner">
            <div class="wrap">



                <!-- Fixed navigation bar content -->

                <div class="menu_wrapper">

                    <div class="fixed-nav-bar">

                        <div class="top-menu">
                            <div class="logo">
                                <h1><a href="<?php echo get_home_url(); ?>"><strong><?php echo get_bloginfo( 'name' );?></strong> <span><?php echo get_bloginfo( 'description');?></span></a></h1>
                            </div>
                            <button class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i><span class="sr-only">Ouvrir le menu</span>
                            </button>
                            <button class="cross"><i class="fa fa-close" aria-hidden="true"></i><span class="sr-only">Fermer le menu</span></button>
                        </div>
                        <nav class="fixed-nav-bar-menu" role="navigation" aria-label="Menu Principal">
                            <?php 
                            wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container' => false
                            ));
                        ?>
                        </nav>
                    </div>


                    <div class="widgets">
                        <?php dynamic_sidebar('meteo');?>
                        <?php dynamic_sidebar('langues');?>
                        <?php dynamic_sidebar('search');?>
                    </div>

                </div>










                <nav class="fixed-nav-bar_bas"  role="navigation" aria-label="Menu Principal">
                    <?php 
                            wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container' => false
                            ));
                        ?>
                </nav></div>
            </header>

            <div id="content" class="site-content" role="main">
