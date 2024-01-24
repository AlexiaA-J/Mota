<?php
get_header();
?>
    <main id="primary" class="site-main">
        <div class="page-content">
            <div class="main-content">
                <div class="single-photo-content">
                    <div class="infos-container">
                        <p class=photo-title><?php echo get_the_title()?></p>
                        <p> Référence : <span class="ref-value"><?php echo get_field('ref');?></span></p>
                        <p> Catégorie : <?php echo get_the_terms(get_the_ID(), 'category')[0]->name; ?></p>
                        <p> Format : <?php echo get_the_terms(get_the_ID(), 'format') [0]->name; ?></p>
                        <p> Type : <?php echo get_field('type'); ?></p>
                        <p> Année : <?php echo get_the_terms(get_the_ID(), 'date') [0]->name; ?></p>
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
                        <button class="btn contact-btn">Contact</button>
                    </div>
                    <div class="preview">
                        <?php
                        $previouspost = get_previous_post();
                        $nextpost = get_next_post();
                        ?>
                        <div class="arrows">
                            <?php if ($previouspost) : ?>
                                <?php $previous_photo = get_field('photo', $previouspost->ID); ?>
                                <a href="<?php echo get_permalink($previouspost); ?>" class="arrow-link arrow-left">
                                    <img class="arrow arrow-left" src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-left.svg" alt="Arrow for previous picture">
                                    <div class="hover-thumbnail thumbnail-left">
                                    <img src="<?php echo get_the_post_thumbnail_url($previouspost->ID, array(81, 71)) ?>" alt="Photo précédente">
                                    </div>
                                </a>
                            <?php endif; ?>
                            <?php if ($nextpost) : ?>
                                <?php $next_photo = get_field('photo', $nextpost->ID); ?>
                                <a href="<?php echo get_permalink($nextpost); ?>" class="arrow-link arrow-right">
                                    <img class="arrow arrow-right" src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow-right.svg" alt="Arrow for next picture">
                                    <div class="hover-thumbnail thumbnail-right">
                                        <img src="<?php echo get_the_post_thumbnail_url($nextpost->ID, array(81, 71)) ?>" alt="Photo suivante">
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator">
                <hr>
            </div>
            <div>
                <div class="gallery">
                    <p class="you-may-also-like">VOUS AIMEREZ AUSSI</p>
                    <div class="gallery-container">
                        
                        <?php
                        $current_post_id = get_the_ID();
                        $current_category = get_the_terms(get_the_ID(), 'category');
                        $category_name = $current_category ? $current_category[0]->name : '';

                        $args = array(
                            'post_type' => 'photo',
                            'category_name' => $category_name,
                            'posts_per_page' => 2,
                            'orderby' => 'rand',
                            'post__not_in'   => array($current_post_id),
                        );

                        $query = new WP_Query($args);
                        if ($query->have_posts()){
                            while ($query->have_posts()) : $query->the_post();
                                get_template_part('assets/template-parts/photo-block');
                            endwhile;
                        } else {
                            ?> <p> Cette catégorie n'a pas d'autres photos. </p> <?php
                        }
                        wp_reset_postdata();
                        ?>

                    </div>
                </div>
            </div>
            <div class="btn-container">
                <a href="<?php echo home_url('/'); ?>">
                    <span class="btn home-btn">Toutes les photos</span>
                </a>
            </div>
        </div>
    </main><!-- #main -->  
<?php
get_footer();
?>