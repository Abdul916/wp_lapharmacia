<?php
/**
 * Name: Header 12
 **/
?>
<header id="header" class="header style-12">
    <div class="header-top">
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
    <div class="header-mid">
        <div class="container">
            <div class="header-inner">
                <?php echo biolife_get_logo(); ?>
                <?php biolife_header_search( true ); ?>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        biolife_header_menu_bar();
                        if ( function_exists( 'biolife_header_wishlist' ) ) biolife_header_wishlist();
                        if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot header-sticky main-bg light">
        <div class="container">
            <div class="header-inner">
                <div class="header-start">
                    <?php biolife_vertical_menu(); ?>
                </div>
                <div class="header-center megamenu-wrap">
                    <div class="box-header-nav">
                        <?php biolife_primary_menu(); ?>
                    </div>
                    <?php biolife_header_message(); ?>
                </div>
                <div class="header-end"></div>
            </div>
        </div>
    </div>
</header>
