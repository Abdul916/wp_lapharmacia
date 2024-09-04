<?php
/**
 * Name: Header 07
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
<header id="header" class="header style-07" style="<?php echo esc_attr( $css ); ?>">
    <div class="header-top">
        <div class="container">
            <div class="header-inner">
                <div class="header-start">
                    <?php biolife_header_submenu( 'header_submenu' ); ?>
                    <?php biolife_header_social(); ?>
                </div>
                <div class="header-end">
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
                <?php biolife_header_search(); ?>
                <?php biolife_header_info(); ?>
            </div>
        </div>
    </div>
    <div class="header-bot header-sticky">
        <div class="container">
            <div class="header-inner megamenu-wrap">
                <?php biolife_vertical_menu(); ?>
                <?php biolife_header_menu_bar( 'ovic-icon-menu-2' ); ?>
                <div class="box-header-nav">
                    <?php biolife_primary_menu(); ?>
                </div>
                <?php if ( function_exists( 'biolife_header_mini_cart' ) ) biolife_header_mini_cart(); ?>
            </div>
        </div>
    </div>
</header>
