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

