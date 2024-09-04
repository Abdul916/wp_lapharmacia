<?php
/**
 * Name: Header 10
 **/
?>
<header id="header" class="header style-10">
    <div class="header-top">
        <div class="container">
            <div class="header-inner">
                <div class="header-start">
                    <?php biolife_header_submenu( 'header_submenu' ); ?>
                </div>
                <div class="header-end">
                    <?php biolife_header_social(); ?>
                    <?php biolife_header_submenu( 'header_submenu_2' ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mid">
        <div class="container">
            <div class="header-inner megamenu-wrap">
                <?php echo biolife_get_logo(); ?>
                <div class="box-header-nav">
                    <?php biolife_primary_menu(); ?>
                </div>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        if ( function_exists( 'biolife_header_wishlist' ) ) biolife_header_wishlist();
                        biolife_header_user();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot header-sticky">
        <div class="container">
            <div class="header-inner">
                <?php biolife_header_menu_bar(); ?>
                <?php biolife_vertical_menu(); ?>
                <?php biolife_header_search(); ?>
                <div class="wrap-submenu">
                    <?php biolife_header_submenu( 'header_submenu_3' ); ?>
                </div>
                <?php if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart(); ?>
            </div>
        </div>
    </div>
</header>
