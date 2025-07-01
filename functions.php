<?php
/**
 * Funciones del tema nikocrowtheme2025
 * 
 * @package nikocrowtheme2025
 * @version 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuración inicial del tema
 */
function nikocrowtheme2025_setup() {
    // Soporte para idiomas
    load_theme_textdomain('nikocrowtheme2025', get_template_directory() . '/languages');
    
    // Soporte para títulos automáticos
    add_theme_support('title-tag');
    
    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');
    
    // Soporte para feeds automáticos
    add_theme_support('automatic-feed-links');
    
    // Soporte para HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    
    // Soporte para logos personalizados
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Soporte para fondos personalizados
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ));
    
    // Soporte para menús de navegación
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'nikocrowtheme2025'),
        'footer'  => __('Menú Footer', 'nikocrowtheme2025'),
        'mobile'  => __('Menú Móvil', 'nikocrowtheme2025'),
    ));
    
    // Tamaños de imagen personalizados
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('card-image', 400, 300, true);
    add_image_size('thumbnail-small', 150, 150, true);
    add_image_size('post-featured', 800, 450, true);
}
add_action('after_setup_theme', 'nikocrowtheme2025_setup');

/**
 * Configurar ancho de contenido
 */
function nikocrowtheme2025_content_width() {
    $GLOBALS['content_width'] = apply_filters('nikocrowtheme2025_content_width', 1200);
}
add_action('after_setup_theme', 'nikocrowtheme2025_content_width', 0);

/**
 * Obtener versión de archivos para cache busting
 */
function nikocrowtheme2025_get_file_version($file_path) {
    $full_path = get_template_directory() . $file_path;
    if (file_exists($full_path)) {
        return filemtime($full_path);
    }
    return '1.0.0';
}

/**
 * Registrar y cargar estilos y scripts con estructura de Gulp
 */
function nikocrowtheme2025_scripts() {

    wp_enqueue_style('nikocrowtheme2025-style',get_template_directory_uri() . '/assets/css/main.min.css',array(),nikocrowtheme2025_get_file_version('/assets/css/main.min.css')); 
    wp_enqueue_script('nikocrowtheme2025-script',get_template_directory_uri() . '/assets/js/main.min.js',array('jquery'),nikocrowtheme2025_get_file_version('/assets/js/main.min.js'),true);
       
    
    // Comentarios
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Localizar scripts para AJAX
    wp_localize_script('nikocrowtheme2025-script', 'nikocrowtheme2025_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('nikocrowtheme2025_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'nikocrowtheme2025_scripts');

/**
 * Cargar estilos del editor para que coincidan con el frontend
 */
function nikocrowtheme2025_editor_styles() {
    // SIEMPRE usar minificado
    add_editor_style('assets/css/main.min.css');
}
add_action('admin_init', 'nikocrowtheme2025_editor_styles');

/**
 * Registrar áreas de widgets
 */
function nikocrowtheme2025_widgets_init() {
    // Sidebar principal
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'nikocrowtheme2025'),
        'id'            => 'sidebar-1',
        'description'   => __('Widgets que aparecen en el sidebar principal.', 'nikocrowtheme2025'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Sidebar secundario
    register_sidebar(array(
        'name'          => __('Sidebar Secundario', 'nikocrowtheme2025'),
        'id'            => 'sidebar-2',
        'description'   => __('Sidebar adicional para páginas específicas.', 'nikocrowtheme2025'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer widgets
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer Widget %d', 'nikocrowtheme2025'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(__('Widgets del footer - Columna %d', 'nikocrowtheme2025'), $i),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
    
    // Widget área antes del contenido
    register_sidebar(array(
        'name'          => __('Antes del Contenido', 'nikocrowtheme2025'),
        'id'            => 'before-content',
        'description'   => __('Área de widgets que aparece antes del contenido principal.', 'nikocrowtheme2025'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'nikocrowtheme2025_widgets_init');

/**
 * Función para obtener el excerpt personalizado
 */
function nikocrowtheme2025_get_excerpt($length = 55, $post_id = null) {
    if (!$post_id) {
        global $post;
        $post_id = $post->ID;
    }
    
    $post_obj = get_post($post_id);
    
    if (has_excerpt($post_id)) {
        return get_the_excerpt($post_id);
    }
    
    $content = strip_shortcodes($post_obj->post_content);
    $content = wp_strip_all_tags($content);
    $words = explode(' ', $content);
    
    if (count($words) > $length) {
        $words = array_slice($words, 0, $length);
        return implode(' ', $words) . '...';
    }
    
    return implode(' ', $words);
}

/**
 * Personalizar el excerpt length
 */
function nikocrowtheme2025_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'nikocrowtheme2025_excerpt_length');

/**
 * Personalizar el excerpt more
 */
function nikocrowtheme2025_excerpt_more($more) {
    global $post;
    return '... <a href="' . get_permalink($post->ID) . '" class="read-more">' . __('Leer más', 'nikocrowtheme2025') . '</a>';
}
add_filter('excerpt_more', 'nikocrowtheme2025_excerpt_more');

/**
 * Agregar clases al body
 */
function nikocrowtheme2025_body_classes($classes) {
    // Agregar clase si no hay sidebar
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    
    // Agregar clase según el tipo de página
    if (is_page_template()) {
        $template = get_page_template_slug();
        $template_name = basename($template, '.php');
        $classes[] = 'template-' . $template_name;
    }
    
    return $classes;
}
add_filter('body_class', 'nikocrowtheme2025_body_classes');

/**
 * Agregar clases al post
 */
function nikocrowtheme2025_post_classes($classes) {
    global $post;
    
    // Agregar clase si el post tiene imagen destacada
    if (has_post_thumbnail()) {
        $classes[] = 'has-featured-image';
    }
    
    return $classes;
}
add_filter('post_class', 'nikocrowtheme2025_post_classes');

/**
 * Filtros de seguridad y limpieza
 */
// Remover versión de WordPress del head
remove_action('wp_head', 'wp_generator');

// Limpiar wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// Remover emoji scripts (opcional - mejora rendimiento)
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/**
 * Soporte para Gutenberg
 */
function nikocrowtheme2025_gutenberg_support() {
    // Soporte para estilos del editor
    add_theme_support('editor-styles');
    
    // Soporte para ancho completo
    add_theme_support('align-wide');
    
    // Soporte para paleta de colores personalizada
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => __('Azul Primario', 'nikocrowtheme2025'),
            'slug'  => 'primary-blue',
            'color' => '#007cba',
        ),
        array(
            'name'  => __('Azul Secundario', 'nikocrowtheme2025'),
            'slug'  => 'secondary-blue',
            'color' => '#0073aa',
        ),
        array(
            'name'  => __('Gris Oscuro', 'nikocrowtheme2025'),
            'slug'  => 'dark-gray',
            'color' => '#333333',
        ),
        array(
            'name'  => __('Gris Medio', 'nikocrowtheme2025'),
            'slug'  => 'medium-gray',
            'color' => '#666666',
        ),
        array(
            'name'  => __('Gris Claro', 'nikocrowtheme2025'),
            'slug'  => 'light-gray',
            'color' => '#f8f9fa',
        ),
        array(
            'name'  => __('Blanco', 'nikocrowtheme2025'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ));
    
    // Soporte para tamaños de fuente personalizados
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => __('Muy Pequeño', 'nikocrowtheme2025'),
            'size' => 12,
            'slug' => 'very-small'
        ),
        array(
            'name' => __('Pequeño', 'nikocrowtheme2025'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => __('Normal', 'nikocrowtheme2025'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => __('Mediano', 'nikocrowtheme2025'),
            'size' => 20,
            'slug' => 'medium'
        ),
        array(
            'name' => __('Grande', 'nikocrowtheme2025'),
            'size' => 24,
            'slug' => 'large'
        ),
        array(
            'name' => __('Extra Grande', 'nikocrowtheme2025'),
            'size' => 32,
            'slug' => 'extra-large'
        ),
    ));
    
    // Deshabilitar colores y tamaños por defecto si prefieres solo los personalizados
    // add_theme_support('disable-custom-colors');
    // add_theme_support('disable-custom-font-sizes');
}
add_action('after_setup_theme', 'nikocrowtheme2025_gutenberg_support');

/**
 * Función de utilidad para debugging
 */
function nikocrowtheme2025_debug($data, $die = false) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        echo '<pre style="background: #f1f1f1; padding: 10px; margin: 10px; border-left: 4px solid #0073aa;">';
        print_r($data);
        echo '</pre>';
        
        if ($die) {
            die();
        }
    }
}

/**
 * Customizer - Opciones del tema
 */
function nikocrowtheme2025_customize_register($wp_customize) {
    // Sección general
    $wp_customize->add_section('nikocrowtheme2025_general', array(
        'title'    => __('Configuración General', 'nikocrowtheme2025'),
        'priority' => 30,
    ));
    
    // Copyright text
    $wp_customize->add_setting('nikocrowtheme2025_copyright', array(
        'default'           => '© 2025 Mi Sitio Web',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('nikocrowtheme2025_copyright', array(
        'label'   => __('Texto de Copyright', 'nikocrowtheme2025'),
        'section' => 'nikocrowtheme2025_general',
        'type'    => 'text',
    ));
    
    // Sección de desarrollo
    $wp_customize->add_section('nikocrowtheme2025_dev', array(
        'title'    => __('Herramientas de Desarrollo', 'nikocrowtheme2025'),
        'priority' => 200,
    ));
    
    $wp_customize->add_setting('nikocrowtheme2025_show_template_info', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('nikocrowtheme2025_show_template_info', array(
        'label'   => __('Mostrar información de plantilla', 'nikocrowtheme2025'),
        'section' => 'nikocrowtheme2025_dev',
        'type'    => 'checkbox',
    ));
}
add_action('customize_register', 'nikocrowtheme2025_customize_register');

/**
 * Función para mostrar información de plantilla en desarrollo
 */
function nikocrowtheme2025_show_template_info() {
    if (get_theme_mod('nikocrowtheme2025_show_template_info', false)) {
        global $template;
        echo '<div style="position: fixed; top: 0; right: 0; background: #0073aa; color: white; padding: 10px; z-index: 9999; font-size: 12px;">';
        echo 'Plantilla: ' . basename($template);
        echo '</div>';
    }
}
add_action('wp_footer', 'nikocrowtheme2025_show_template_info');

/**
 * Agregar soporte para navegación con teclado
 */
function nikocrowtheme2025_add_navigation_js() {
    ?>
    <script>
    // Navegación con teclado para menús
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.menu-item a');
        menuItems.forEach(function(item) {
            item.addEventListener('focus', function() {
                let parent = this.parentNode;
                if (parent.classList.contains('menu-item-has-children')) {
                    parent.classList.add('focus');
                }
            });
            
            item.addEventListener('blur', function() {
                let parent = this.parentNode;
                if (parent.classList.contains('menu-item-has-children')) {
                    parent.classList.remove('focus');
                }
            });
        });
    });
    </script>
    <?php
}
add_action('wp_footer', 'nikocrowtheme2025_add_navigation_js');

/**
 * Función helper para obtener URL de assets
 */
function nikocrowtheme2025_asset_url($path) {
    return get_template_directory_uri() . '/assets/' . ltrim($path, '/');
}

/**
 * Función helper para obtener ruta completa de assets
 */
function nikocrowtheme2025_asset_path($path) {
    return get_template_directory() . '/assets/' . ltrim($path, '/');
}

/**
 * Funciones auxiliares para mostrar metadatos de posts
 */
if (!function_exists('nikocrowtheme2025_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function nikocrowtheme2025_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x('Publicado el %s', 'post date', 'nikocrowtheme2025'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('nikocrowtheme2025_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function nikocrowtheme2025_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('por %s', 'post author', 'nikocrowtheme2025'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (!function_exists('nikocrowtheme2025_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function nikocrowtheme2025_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'nikocrowtheme2025'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Publicado en %1$s', 'nikocrowtheme2025') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'nikocrowtheme2025'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Etiquetas: %1$s', 'nikocrowtheme2025') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Deja un comentario<span class="screen-reader-text"> en %s</span>', 'nikocrowtheme2025'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Editar <span class="screen-reader-text">%s</span>', 'nikocrowtheme2025'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;