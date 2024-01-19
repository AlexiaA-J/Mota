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

add_action( 'wp_enqueue_scripts', 'mota_enqueue_styles' );
function mota_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/assets/scss/theme.css' );
    wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/scripts.js', array(), true );
}

// Add text to footer menu

add_filter( 'wp_nav_menu_items', 'add_extra_item_to_nav_menu', 10, 2 );
function add_extra_item_to_nav_menu( $items, $args ) {
    if ($args-> theme_location === 'footer') {
        $items .= '<li><p class="copyright">TOUS DROITS RÉSERVÉS</p></li>';
    }
    return $items;
}

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

// add_filter( 'wpcf7_ajax_loader', '__return_false' );


function mota_supports()
{
    // Ajouter la prise en charge des images mises en avant
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'mota_supports');


remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
add_action( 'shutdown', function() {
   while ( @ob_end_flush() );
} );

// LOAD MORE

function load_more() {
    $paged = $_POST['paged'];
    $posts_per_page = 8;

    $ajaxposts = new WP_Query(array(
        'post_type'      => 'photo',
        'posts_per_page' => $posts_per_page,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'paged'          => $paged,
    ));

    $response = '';
    $has_more_posts = false;

    if ($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) : $ajaxposts->the_post();
                $response .= '<a href="' . get_the_permalink() . '">';
                $response .= '<img src="' . get_the_post_thumbnail_url() . '" alt="Photo">';
                $response .= '</a>';
        endwhile;

        // Check if there are more posts beyond the current page
        $has_more_posts = $ajaxposts->max_num_pages > $paged;

        wp_reset_postdata();
    }

    echo json_encode(array('html' => $response, 'has_more_posts' => $has_more_posts));
    wp_die();
}

add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');


// FILTERS AND SORT

function ajax_filter() {
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $sortByDate = isset($_POST['sortByDate']) ? $_POST['sortByDate'] : '';

    $gallery_args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => ($sortByDate === 'DESC') ? 'DESC' : 'ASC',
        'post_status' => 'publish',
        'paged' => 1,
    );

    if ($category && $category !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    if ($format && $format !== 'all') {
        $gallery_args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $query = new WP_Query($gallery_args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) : $query->the_post();
            ?>
            <a href="<?php echo get_the_permalink(); ?>">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Photo">
            </a>
            <?php
        endwhile;
        $content = ob_get_clean();
        echo $content;
    }

    die();
}
add_action('wp_ajax_ajax_filter', 'ajax_filter');
add_action('wp_ajax_nopriv_ajax_filter', 'ajax_filter'); // For non-logged in users

