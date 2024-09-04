<?php
/**
 * Name: Header 13
 **/
?>
<?php
$header_bg = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'header_background',
    'metabox_header_background'
);
if ( !empty( $header_bg ) ) {
    $css = 'background-image: url(' . wp_get_attachment_image_url( $header_bg, 'full' ) . ')';
} else {
    $css = '';
}
?>
<header id="header" class="header style-13 light <?php if ( !empty( $header_bg ) ) echo esc_attr( 'has-bg' ); ?>" style="<?php echo esc_attr( $css ); ?>">
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
    <div class="header-mid header-sticky">
        <div class="container">
            <div class="header-inner megamenu-wrap">
                <?php echo biolife_get_logo(); ?>
                <?php biolife_vertical_menu( 'default', 'ovic-icon-menu' ); ?>
                <div class="box-header-nav">
                    <?php biolife_primary_menu(); ?>
                </div>
                <div class="header-control">
                    <div class="inner-control">
                        <?php
                        biolife_header_menu_bar();
                        biolife_header_search_popup();
                        if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
