<?php
get_header();
?>
<div class="home-content">
    <div class="hero">
        <h1 class="hero__title">PHOTOGRAPHE EVENT</h1>

        <div class="hero__banner">
        <?php
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'orderby' => 'rand',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'format',
                        'field' => 'slug',
                        'terms' => 'paysage',
                    ),
                ),
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php
                endwhile;
                wp_reset_postdata();
            }
        ?>
        </div>
    </div>
    <div class="gallery-home">
        <div class="filters">
            <div class="categories-formats">
                <div class="categories-filter">
                    <select id="categories" class="selector">
                        <option value="all" selected>CATÉGORIES</option>
                            <?php
                                $categories = get_terms(array(
                                    "taxonomy" => "category",
                                    "hide_empty" => false,
                                ));
                                foreach ($categories as $category) {
                                    echo '<option value="' . $category->slug . '">' . mb_convert_case($category->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                                }
                            ?>
                    </select>
                </div>
                <div class="formats-filter">
                    <select id="formats" class="selector">
                        <option value="all" selected>FORMATS</option>
                            <?php
                                $formats = get_terms(array(
                                    "taxonomy" => "format",
                                    "hide_empty" => false,
                                ));
                                foreach ($formats as $format) {
                                    echo '<option value="' . $format->slug . '">' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                                }
                            ?>
                    </select>
                </div>
            </div>
            <div class="sort-date" >
                <select id="sort-by-date" class="selector">
                    <option value="all" selected>TRIER PAR</option>
                    <option value="DESC">Les Plus Récentes</option>
                    <option value="ASC">Les Plus Anciennes</option>
                </select>
            </div>
        </div>
        <div class="gallery-container">
            <?php
                $paged = get_query_var( 'paged', 1 );
                $gallery = array(
                    'post_type' => 'photo',
                    'posts_per_page' => 8,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'post_status' => 'publish',
                    'paged' => $paged,
                );

                $query = new WP_Query($gallery);

                if ($query->have_posts()){
                    while ($query->have_posts()) : $query->the_post();
                            ?>
                            <div class="photo-suggested" data-photo-src="<?php echo get_the_post_thumbnail_url(); ?>">
                                <img class="photo" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Photo">
                                <div class="overlay">
                                    <div class="overlay__full">
                                        <a href="<?php echo get_the_permalink(); ?>" class="open-photopage icon">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Ouvrir la page de la photo">
                                        </a>
                                        <img class="fullsize icon" src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_fullscreen.png" alt="Voir l'image en plein écran">
                                        <p class="overlay-title overlay-text"><?php echo get_the_title(); ?></p>
                                        <p class="overlay-category overlay-text"><?php echo get_the_terms(get_the_ID(), 'category')[0]->name; ?></p>                                
                                    </div>
                                </div>
                            </div>
                            <?php
                    endwhile;
                }
            ?>
        </div>
        <div class="btn-container">
            <a id="load-more" href="<?php echo home_url('/'); ?>">
                <span class="btn more-btn">Charger plus</span>
            </a>
        </div>
    </div>
</div>
<?php
get_footer();
?>