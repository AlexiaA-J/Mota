<?php

/* Rajout de l'option Logo dans le customizer */

function yourNewThemeCustomizerSettings($wp_customize) {
    $wp_customize->add_setting('your_theme_logo');
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'your_theme_logo',
    array(
    'label' => 'Upload Logo',
    'section' => 'title_tagline',
    'settings' => 'your_theme_logo',
    ) ) );
    }
    add_action('customize_register', 'yourNewThemeCustomizerSettings');

/* Rajout des emplacements Menu */
function registerMenus()
{
    register_nav_menus(
        array(
            'main' => __('Header'),
            'footer' => __('Bas de page'),
        )
    );
}
add_action('after_setup_theme', 'registerMenus');

// Enqueuing

include_once get_template_directory() . '/assets/inc/ajax-functions.php';

add_action('wp_enqueue_scripts', 'motaEnqueueStyles');
function motaEnqueueStyles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/assets/scss/theme.css');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
    wp_enqueue_style('select2-style', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
    wp_enqueue_script('select2-script', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0-rc.0', true);
    wp_enqueue_script('menu-script', get_template_directory_uri() . '/assets/js/modules/menu.js', array('jquery'), null, true);
    wp_enqueue_script('modal-script', get_template_directory_uri() . '/assets/js/modules/modal.js', array('jquery'), null, true);
    wp_enqueue_script('arrow-positions-script', get_template_directory_uri() . '/assets/js/modules/arrowPositions.js', array('jquery'), null, true);
    wp_enqueue_script('select-2', get_template_directory_uri() . '/assets/js/modules/select2.js', array('jquery'), null, true);
    wp_enqueue_script('load-more', get_template_directory_uri() . '/assets/js/modules/loadMore.js', array('jquery'), null, true);
    wp_enqueue_script('filters', get_template_directory_uri() . '/assets/js/modules/filters.js', array('jquery'), null, true);
    wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/modules/lightbox.js', array('jquery'), null, true);
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);
}

// Add text to footer menu

add_filter( 'wp_nav_menu_items', 'addExtraItemToNavMenu', 10, 2 );
function addExtraItemToNavMenu( $items, $args ) {
    if ($args-> theme_location === 'footer') {
        $items .= '<li><p class="copyright">TOUS DROITS RÉSERVÉS</p></li>';
    }
    return $items;
}

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');


function motaSupports()
{
    // Ajouter la prise en charge des images mises en avant
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'motaSupports');


remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );

