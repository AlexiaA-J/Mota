<?php

/* Rajout de l'option Logo dans le customizer */

function your_theme_new_customizer_settings($wp_customize) {
    $wp_customize->add_setting('your_theme_logo');
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'your_theme_logo',
    array(
    'label' => 'Upload Logo',
    'section' => 'title_tagline',
    'settings' => 'your_theme_logo',
    ) ) );
    }
    add_action('customize_register', 'your_theme_new_customizer_settings');

/* Rajout des emplacements Menu */
function register_my_menus()
{
    register_nav_menus(
        array(
            'main' => __('Header'),
            'footer' => __('Bas de page'),
        )
    );
}
add_action('after_setup_theme', 'register_my_menus');

// Enqueuing

add_action( 'wp_enqueue_scripts', 'chicdressing_enqueue_styles' );
function chicdressing_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/css/theme.css' );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array(), true );
}

// Add text to footer menu

add_filter( 'wp_nav_menu_items', 'add_extra_item_to_nav_menu', 10, 2 );
function add_extra_item_to_nav_menu( $items, $args ) {
    error_log('Debug: Inside add_extra_item_to_nav_menu function');
    if ($args-> theme_location === 'footer') {
        error_log('Debug: Adding item to footer menu');
        $items .= '<li><p class="copyright">TOUS DROITS RÉSERVÉS</p></li>';
    }
    return $items;
}

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');
