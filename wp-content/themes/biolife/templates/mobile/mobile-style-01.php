<?php
/**
 * Name:  Mobile 01
 *
 * @var $account_link
 * @var $logo_link
 * @var $page_layout
 * @var $page_template
 **/
?>
<div class="main">
    <div class="container">
        <div class="inner">
            <?php echo biolife_get_logo(); ?>
            <?php biolife_header_search(); ?>
            <div class="control">
                <div class="inner-control">
                    <div class="block-userlink">
                        <a class="woo-user-link" href="<?php echo esc_url( $account_link ); ?>">
                            <span class="icon main-icon-user-6"></span>
                        </a>
                    </div>
                    <?php if ( function_exists( 'biolife_header_wishlist' ) ) biolife_header_wishlist(); ?>
                    <div class="block-minicart">
                        <?php if ( function_exists( 'biolife_header_cart_link' ) ) biolife_header_cart_link( false ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fixed">
    <div class="inner">
        <a href="<?php echo esc_url( $logo_link ); ?>" class="home-page">
            <span class="icon main-icon-home"></span>
            <span class="text"><?php echo esc_html__( 'Home', 'biolife' ); ?></span>
        </a>
        <a href="javascript:void(0)" class="menu-bar menu-toggle">
            <span class="icon main-icon-menu"></span>
            <span class="text"><?php echo esc_html__( 'Menu', 'biolife' ); ?></span>
        </a>
        <?php if ( $page_layout['layout'] != 'full' && $page_template == '' ) : ?>
            <a href="javascript:void(0)" class="open-sidebar">
                <span class="icon main-icon-sidebar"></span>
                <span class="text"><?php echo esc_html__( 'Sidebar', 'biolife' ); ?></span>
            </a>
        <?php elseif ( class_exists( 'WeDevs_Dokan' ) && dokan_is_store_page() ) : ?>
            <a href="javascript:void(0)" class="open-sidebar">
                <span class="icon main-icon-sidebar"></span>
                <span class="text"><?php echo esc_html__( 'Sidebar', 'biolife' ); ?></span>
            </a>
        <?php else: ?>
            <?php if ( function_exists( 'biolife_header_cart_link' ) ) biolife_header_cart_link( false ); ?>
        <?php endif; ?>
        <a href="javascript:void(0)" class="action-to-top">
            <span class="icon main-icon-back-2"></span>
            <span class="text"><?php echo esc_html__( 'Top', 'biolife' ); ?></span>
        </a>
    </div>
</div>
