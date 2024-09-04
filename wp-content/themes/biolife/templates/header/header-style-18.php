<?php
/**
 * Name: Header 18
 **/
?>
<header id="header" class="header style-18">
    <div class="header-top default-bg light">
        <div class="container">
            <div class="header-inner">
                <div class="header-start">
                    <?php biolife_header_social(); ?>
                    <?php biolife_header_submenu( 'header_submenu' ); ?>
                </div>
                <?php biolife_header_message(); ?>
                <div class="header-end">
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
</header>
