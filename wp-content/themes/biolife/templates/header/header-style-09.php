<?php
/**
 * Name: Header 09
 **/
?>
<header id="header" class="header style-09">
    <div class="header-top">
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
    <div class="header-mid header-sticky">
        <div class="header-inner megamenu-wrap">
            <?php echo biolife_get_logo(); ?>
            <div class="box-header-nav">
                <?php biolife_primary_menu(); ?>
            </div>
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
</header>
