<?php
get_header();
?>
    <main id="primary" class="site-main">
        <div class="page-content">
        <!-- Section Superieur -->
            <section class="main-content">
                <div class="upper-content">
                    <div class="infos-container">
                        <p class=photo-title><?php echo get_the_title()?></p>
                        <p> Référence : <span class="ref-value"><?php echo get_field('ref');?></span></p>
                        <p> Catégorie : <?php $categories = get_the_terms( $post->ID, 'category' );
                                        foreach( $categories as $category ) {
                                        echo $category->name;
                                        } ?></p>
                        <p> Format : <?php $formats = get_the_terms( $post->ID, 'format' );
                                        foreach( $formats as $format ) {
                                        echo $format->name;
                                        } ?></p>
                        <p> Type : <?php echo get_field('type'); ?></p>
                        <p> Année : <?php $dates = get_the_terms( $post->ID, 'date' );
                                        foreach( $dates as $date ) {
                                        echo $date->name;
                                        } ?></p>
                    </div>
                    <div class="photos-container">
                        <img src="<?php $photo = get_field('photo');
                                        echo $photo['url'];
                                    ?>" alt="Photographie">
                    </div>
                </div>
            </section>
        </div>
    </main><!-- #main -->  
<?php
get_footer();
?>