<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=kid_star" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">
        <?php _e('Ir al contenido principal', 'nikocrowtheme2025'); ?>
    </a>
    
    <header id="masthead" class="header">     
        <div class="header__hero" id="hero-section" style="background-size: 100% 120%; background-position: center center; background-repeat: no-repeat;">
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
                    <p class="header__description"><?php echo $nikocrowtheme2025_description; ?></p>
                <?php endif; ?>
                
                <nav id="site-navigation" class="header__navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'container' => false,
                            'menu_class' => 'header__menu',
                            'fallback_cb' => 'wp_page_menu',
                        )
                    );
                    ?>
                </nav>
            </div>
             
            <div class="header__content">
                <h1 class="header__title"><?php the_field('hero_heading'); ?></h1>
                <p class="header__subtitle"><?php the_field('sub_heading'); ?></p>
                <div class="header__call-to-action">
                    <a href="<?php the_field('hero_button_link'); ?>"><?php the_field('hero_button_label');?></a>
                    <span>
                          <a class="shop-cofee" href="">SHOP COFEE</a>
                    </span>
                  
                </div>
            </div>

            <div class="header__content--rating">
                <div class="stars-container">
                   <span class="material-symbols-outlined">
                    kid_star
                    </span>
                   <span class="material-symbols-outlined">
                    kid_star
                    </span>
                   <span class="material-symbols-outlined">
                    kid_star
                    </span>
                   <span class="material-symbols-outlined">
                    kid_star
                    </span>
                   <span class="material-symbols-outlined">
                    kid_star
                    </span>
                </div>
                <p>4.9 out of 5 Overall Star</p>
                <p>Railing for All Local Business.</p>
            </div>
            
        </div>
    </header>

<script>
function setHeroImage() {
    const hero = document.getElementById('hero-section');
    const desktopImg = '<?php echo get_field('hero_image_desktop'); ?>';
    const mobileImg = '<?php echo get_field('hero_image'); ?>';
    
    // Cambia 768 por tu resolución específica
    const backgroundImage = window.innerWidth <= 768 ? mobileImg : desktopImg;
    
    hero.style.backgroundImage = `url(${backgroundImage})`;
}

// Ejecutar al cargar y al redimensionar
document.addEventListener('DOMContentLoaded', setHeroImage);
window.addEventListener('resize', setHeroImage);
</script>