<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php set_skip_link(); ?>

    <!-- site wrapper -->
    <div class="site-wrapper">
        <?php informations_box('Le PAKA Festival revient du 16/7 au 17/7 2022. <a href="'. get_permalink(54) .'">Voir la programmation</a>', true); ?>
        <header role="banner">
            <div class="container">
                <?php the_custom_logo(); ?>
                <label for="toggle-mobile-navigation" class="ml-auto leading-none cursor-pointer flex flex-col items-center justify-center lg:hidden">
                    <svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-7 w-7">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill="currentColor" d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z" />
                    </svg>
                    <span class="font-title">Menu</span>
                </label>
                <input type="checkbox" id="toggle-mobile-navigation" class="sr-only lg:hidden">
                <nav role="navigation" id="main-navigation" role="navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'main',
                        'container' => null,
                        'walker' => new Main_Nav_Walker
                    ))
                    ?>
                </nav>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'social',
                    'container' => 'nav',
                    'container_class' => 'hidden lg:block ml-auto',
                    'walker' => new Social_Nav_Walker
                ))
                ?>
            </div>
        </header>