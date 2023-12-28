<?php
get_header();
?>
    <main id="primary" class="site-main">
        <div class="page-content">
        <!-- Section Superieur -->
            <section class="main-content">
                <div class="single-photo-content">
                    <div class="infos-container">
                        <p class=photo-title><?php echo get_the_title()?></p>
                        <p> Référence : <span class="ref-value"><?php echo get_field('ref');?></span></p>
                        <p> Catégorie : <?php display_taxonomy_terms($post->ID, 'category'); ?></p>
                        <p> Format : <?php display_taxonomy_terms($post->ID, 'format'); ?></p>
                        <p> Type : <?php echo get_field('type'); ?></p>
                        <p> Année : <?php display_taxonomy_terms($post->ID, 'date'); ?></p>
                        <div class="line">    
                            <hr>
                        </div>
                    </div>
                    <div class="photos-container">
                        <img src="<?php $photo = get_field('photo');
                                        echo $photo['url'];
                                    ?>" alt="Photographie">
                    </div>
                </div>
                <div class="contact-content">
                    <div class="contact">
                        <p class="contact-text">Cette photo vous intéresse ?</p>
                        <button class="contact-btn">Contact</button>
                    </div>
                    <div class="preview">
                    </div>
                </div>
            </section>
        </div>
    </main><!-- #main -->  
<?php
get_footer();
?>