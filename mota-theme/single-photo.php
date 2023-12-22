<?php
get_header();
?>
    <div class="page-content">
    <!-- Section Superieur -->
        <section class="main-content">
            <div class="upper-content">
                <div class="infos-container">
                    <p class=photo-title><?php echo get_the_title()?></p>
                    <p> Référence : <span class="ref-value"><?php /*Add php content here */ ?></span><p>
                    <p> Catégorie : <?php /*Add php content here */ ?></p>
                    <p> Format : <?php /*Add php content here */ ?></p>
                    <p> Type : <?php /*Add php content here */ ?></p>
                    <p> Année : <?php /*Add php content here */ ?></p>
                </div>
                <div class="photos-container">
                    <img src="<?php /*Add php content here */?>">
                </div>
            </div>
        </section>
    </div>    
<?php
get_footer();
?>