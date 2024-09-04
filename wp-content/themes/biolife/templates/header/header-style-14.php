<?php
/**
 * Name: Header 14
 **/
?>
<?php
$header_menu   = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_submenu',
    'metabox_header_submenu'
);
$header_menu_2 = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_submenu_2',
    'metabox_header_submenu_2'
);
$social_menu   = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'social_menu',
    'metabox_social_menu'
);
?>
<header id="header" class="header style-14">
    <?php if ( !empty( $header_menu ) || !empty( $header_menu_2 ) || $social_menu == 1 ): ?>
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
    <?php endif; ?>
    <div class="header-mid header-sticky">
        <div class="container">
            <div class="header-inner megamenu-wrap">
                <div class="box-header-nav">
                    <?php biolife_primary_menu(); ?>
                </div>
                <?php echo biolife_get_logo(); ?>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        biolife_header_user();
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
