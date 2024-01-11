<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nathalie Mota - Photographe Event</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php wp_head(); ?>
</head>
<body>
    <?php wp_body_open(); ?>
    <header class="header">
        <?php
            if ( get_theme_mod( 'your_theme_logo' ) ) : ?>
            <a href="<?php echo home_url(); ?>">
                <img class="header__logo" src="<?php echo get_theme_mod( 'your_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
            </a>
        <?php //
            else : ?>
                <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
        <?php endif; 
        ?>
        <div class="header__navDesktop">
            <?php wp_nav_menu(array('theme_location' => 'main')); ?>
        </div>
        <div class="header__navMobile">
            <div id="menu_burger" class="nav_burger">
                <div class="navMobile-top">
                    <?php
                    if ( get_theme_mod( 'your_theme_logo' ) ) : ?>
                        <a href="<?php echo home_url(); ?>">
                            <img class=header__logo src="<?php echo get_theme_mod( 'your_theme_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
                        </a>
                    <?php //
                    else : ?>
                        <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
                    <?php endif; 
                    ?>
                    <a id="closeBtn" href="#" class="close">&times;</a>
                </div>
                <?php wp_nav_menu(array('theme_location' => 'main')); ?>
            </div>

            <a href="#" id="openBtn">
                <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
        </div>
    </header>