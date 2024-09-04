<div id="header-sticky" class="header-sticky megamenu-wrap">
    <div class="container">
        <div class="header-inner">
            <?php echo biolife_get_logo(); ?>
            <div class="box-header-nav">
                <?php biolife_primary_menu(); ?>
            </div>
            <div class="header-control">
                <div class="inner-control">
                    <?php
                    biolife_header_search_popup();
                    biolife_header_user();
                    if ( function_exists( 'biolife_header_wishlist' ) ) biolife_header_wishlist();
                    if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>