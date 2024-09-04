<?php
/**
 * Name: Header 03.05
 **/
?>
<header id="header" class="header style-03">
    <div class="header-top main-bg light">
        <div class="container">
            <div class="header-inner">
                <div class="header-start">
                    <?php biolife_header_submenu( 'header_submenu' ); ?>
                </div>
                <div class="header-end">
                    <?php biolife_header_social(); ?>
                    <?php biolife_header_submenu( 'header_submenu_2' ); ?>
                    <?php biolife_header_user(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mid header-sticky">
        <div class="container">
            <div class="header-inner megamenu-wrap">
                <?php echo biolife_get_logo(); ?>
                <div class="box-header-nav">
                    <?php biolife_primary_menu(); ?>
                </div>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        biolife_header_menu_bar();
                        biolife_header_search_popup();
                        if ( function_exists( 'biolife_header_wishlist' ) ) biolife_header_wishlist();
                        if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot">
        <div class="container">
            <div class="header-inner">
                <?php biolife_vertical_menu(); ?>
            </div>
        </div>
    </div>
</header>
