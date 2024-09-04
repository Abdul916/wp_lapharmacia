<?php
/**
 * Name: Header 15
 **/
?>
<header id="header" class="header style-15 light">
    <div class="header-mid">
        <div class="container">
            <div class="header-inner">
                <div class="header-start">
                    <div class="inner">
                        <?php biolife_header_submenu( 'header_submenu' ); ?>
                        <?php biolife_header_social(); ?>
                        <?php biolife_header_search_popup(); ?>
                    </div>
                </div>
                <?php echo biolife_get_logo(); ?>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        biolife_header_user();
                        biolife_header_menu_bar();
                        if ( function_exists( 'biolife_header_wishlist' ) ) biolife_header_wishlist();
                        if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bot header-sticky">
        <div class="container">
            <div class="box-header-nav megamenu-wrap">
                <?php biolife_primary_menu(); ?>
            </div>
        </div>
    </div>
</header>
