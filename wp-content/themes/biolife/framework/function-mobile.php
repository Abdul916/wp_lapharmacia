<?php if ( !defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.

if ( !function_exists( 'biolife_mobile_template' ) ) {
    function biolife_mobile_template()
    {
        $layout       = biolife_get_option( 'mobile_layout', 'style-01' );
        $logo_link    = apply_filters( 'ovic_get_link_logo', home_url( '/' ) );
        $account_link = wp_login_url();
        if ( class_exists( 'WooCommerce' ) ) {
            $account_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
        }
        $page_layout   = biolife_page_layout();
        $page_template = get_page_template_slug();
        $account_link  = apply_filters( 'ovic_shortcode_vc_link', $account_link );
        $classes       = array(
            'header-mobile',
            biolife_get_header(),
            'mobile-' . $layout
        );
        $light         = array( 'style-01', 'style-08', 'style-13', 'style-15' );
        if ( in_array( biolife_get_header(), $light ) ) {
            $classes[] = 'light';
        }
        ?>
        <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <?php
            do_action( 'biolife_before_mobile_header' );

            biolife_get_template(
                "templates/mobile/mobile-{$layout}.php",
                array(
                    'layout'        => $layout,
                    'account_link'  => $account_link,
                    'logo_link'     => $logo_link,
                    'page_layout'   => $page_layout,
                    'page_template' => $page_template,
                )
            );

            do_action( 'biolife_after_mobile_header' );
            ?>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_mobile_menu_top' ) ) {
    function biolife_mobile_menu_top()
    {
        $menu_top = biolife_get_option( 'mobile_menu_top' );
        if ( !empty( $menu_top ) ) {
            $term = get_term_by( 'slug', $menu_top, 'nav_menu' );
            if ( !is_wp_error( $term ) && !empty( $term ) ) {
                echo '<div class="mobile-submenu header-top"><div class="container">';
                wp_nav_menu( array(
                        'menu'            => $menu_top,
                        'theme_location'  => $menu_top,
                        'depth'           => 2,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'biolife-nav header-submenu top-menu',
                    )
                );
                echo '</div></div>';
            }
        }
    }

    add_action( 'biolife_before_mobile_header', 'biolife_mobile_menu_top', 10 );
}
if ( !function_exists( 'biolife_mobile_menu_bottom' ) ) {
    function biolife_mobile_menu_bottom()
    {
        $menu_bottom = biolife_get_option( 'mobile_menu_bottom' );
        if ( !empty( $menu_bottom ) ) {
            $term = get_term_by( 'slug', $menu_bottom, 'nav_menu' );
            if ( !is_wp_error( $term ) && !empty( $term ) ) {
                echo '<div class="mobile-submenu header-bot"><div class="container">';
                wp_nav_menu( array(
                        'menu'            => $menu_bottom,
                        'theme_location'  => $menu_bottom,
                        'depth'           => 2,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'biolife-nav header-submenu bottom-menu',
                    )
                );
                echo '</div></div>';
            }
        }
    }

    add_action( 'biolife_after_mobile_header', 'biolife_mobile_menu_bottom', 10 );
}