<?php
/**
 * Name: Header 20
 **/
?>
<header id="header" class="header style-20">
    <div class="header-top">
        <div class="container">
            <div class="header-inner">
                <div class="header-start">
                    <?php biolife_header_submenu( 'header_submenu' ); ?>
                    <?php biolife_header_user(); ?>
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
            <div class="header-inner">
                <?php echo biolife_get_logo(); ?>
                <?php biolife_header_search(); ?>
                <?php biolife_header_info(); ?>
            </div>
        </div>
    </div>
    <div class="header-bot header-sticky">
        <div class="container">
            <div class="header-inner megamenu-wrap">
                <?php biolife_vertical_menu( 'default', 'ovic-icon-menu' ); ?>
                <?php biolife_header_menu_bar(); ?>
                <div class="box-header-nav">
                    <?php biolife_primary_menu(); ?>
                </div>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        if ( function_exists( 'biolife_header_wishlist' ) ) biolife_header_wishlist();
                        if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
