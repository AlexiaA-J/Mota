<?php
get_header();
?>

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
<?php
get_footer();
?>