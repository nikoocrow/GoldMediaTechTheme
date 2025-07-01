<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#primary"><?php _e('Ir al contenido principal', 'nikocrowtheme2025'); ?></a>
<header id="masthead" class="header">
    <div class="header__container">
        <div class="header__branding">
            <div class="header__logo">
                <?php
                if (has_custom_logo()) {
                    $custom_logo_id = get_theme_mod('custom_logo');
                    $logo = wp_get_attachment_image($custom_logo_id, 'full', false, array(
                        'class' => 'header__logo-image',
                        'alt' => get_bloginfo('name'),
                        'loading' => 'lazy'
                    ));
                    echo '<a href="' . esc_url(home_url('/')) . '" class="header__logo-link">' . $logo . '</a>';
                }
                ?>
            </div>
            
            <?php 
            $nikocrowtheme2025_description = get_bloginfo('description', 'display');
            if ($nikocrowtheme2025_description || is_customize_preview()) :
            ?>
                <p class="header__description"><?php echo $nikocrowtheme2025_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
            <?php endif; ?>
            <nav id="site-navigation" class="navigation navigation--main">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'container' => false,
                    'menu_class' => 'navigation__menu navigation__menu--primary',
                    'fallback_cb' => 'wp_page_menu',
                )
            );
            ?>
        </nav><!-- .navigation -->
        </div><!-- .header__branding -->
          <div class="hero-container__content">
            <h1 class="hero-container__title"><?php the_field('hero_heading'); ?></h1>
            <p class="hero-container__description"><?php the_field('sub_heading'); ?></p>
        </div>
    </div><!-- .header__container -->
</header><!-- .header -->

<main id="primary" class="main">
    <div class="main__container"><!-- Contenedor para el contenido principal -->