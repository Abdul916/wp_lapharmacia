<?php if ( !defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.

if ( biolife_is_mobile() ) {
    require_once get_theme_file_path( '/framework/function-mobile.php' );
}

add_filter( 'ovic_get_api_libary_elementor', function ( $url, $api, $info ) {
    return str_replace(
        '{THEME_URI}/libary-elementor/',
        'https://new-biolife.kutethemes.net/biolife/',
        $api
    );
}, 10, 3 );

add_filter( 'ovic_menu_toggle_mobile', '__return_false' );
add_filter( 'ovic_menu_locations_mobile', 'biolife_extend_mobile_menu', 10, 2 );
add_filter( 'ovic_override_footer_template', 'biolife_footer_template' );
add_filter( 'elementor/icons_manager/native', 'biolife_elementor_icons' );
add_action( 'import_sample_data_after_install_sample_data', 'biolife_after_install_sample_data' );
add_action( 'biolife_before_mobile_header', 'biolife_mobile_menu_top', 10 );
add_action( 'biolife_after_mobile_header', 'biolife_mobile_menu_bottom', 10 );
add_action( 'dynamic_sidebar_before', 'biolife_dynamic_sidebar_before', 10, 2 );
add_action( 'dynamic_sidebar_after', 'biolife_dynamic_sidebar_after', 10, 2 );
add_action( 'dgwt/wcas/search_query/args', 'biolife_search_query_args' );

/**
 *
 * ajax search query
 */
if ( !function_exists( 'biolife_search_query_args' ) ) {
    function biolife_search_query_args( $args )
    {
        if ( !empty( $_REQUEST['product_cat'] ) ) {

            $product_cat = sanitize_text_field( $_REQUEST['product_cat'] );

            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => array( $product_cat ),
            );
        }

        return $args;
    }
}
/**
 *
 * dynamic sidebar
 */
if ( !function_exists( 'biolife_dynamic_sidebar_before' ) ) {
    function biolife_dynamic_sidebar_before()
    {
        if ( !is_admin() ) {
            if ( biolife_is_mobile() ) :?>
                <div class="sidebar-head">
                    <span class="title"><?php echo esc_html__( 'Sidebar', 'biolife' ); ?></span>
                    <a href="#" class="close-sidebar"></a>
                </div>
            <?php endif;
            echo '<div class="sidebar-inner">';
        }
    }
}
if ( !function_exists( 'biolife_dynamic_sidebar_after' ) ) {
    function biolife_dynamic_sidebar_after()
    {
        if ( !is_admin() ) {
            echo '</div>';
        }
    }
}
/**
 *
 * TEMPLATE HEADER
 */
if ( !function_exists( 'biolife_header_template' ) ) {
    function biolife_header_template()
    {
        if ( biolife_is_mobile() ) {
            biolife_mobile_template();
        } else {
            $sticky_menu = biolife_get_option( 'sticky_menu', 'none' );
            get_template_part( 'templates-parts/header', 'banner' );
            get_template_part( 'templates/header/header', biolife_get_header() );
            if ( $sticky_menu == 'template' ) {
                get_template_part( 'templates-parts/header', 'sticky' );
            }
            if ( !class_exists( 'Ovic_Megamenu_Settings' ) ) {
                biolife_mobile_menu( 'primary' );
            }
        }
    }
}
if ( !function_exists( 'biolife_footer_template' ) ) {
    function biolife_footer_template()
    {
        return biolife_get_footer();
    }
}
if ( !function_exists( 'biolife_extend_mobile_menu' ) ) {
    function biolife_extend_mobile_menu( $menus, $locations )
    {

        $vertical_menu = apply_filters( 'biolife_extend_mobile_menu_vertical', biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'vertical_menu',
            'metabox_vertical_menu'
        ) );
        $primary_menu  = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            null,
            'metabox_primary_menu'
        );
        if ( !empty( $primary_menu ) ) {
            $term = get_term_by( 'slug', $primary_menu, 'nav_menu' );
            if ( !is_wp_error( $term ) && !empty( $term ) ) {
                $menus = array( $primary_menu );
            }
        }
        if ( empty( $menus ) && !empty( $locations['primary'] ) ) {
            $mobile_menu = wp_get_nav_menu_object( $locations['primary'] );
            $menus[]     = $mobile_menu->slug;
        }
        if ( !empty( $vertical_menu ) ) {
            $menus[] = $vertical_menu;
        }

        return $menus;
    }
}
/**
 *
 * PRIMARY MENU
 */
if ( !function_exists( 'biolife_primary_menu' ) ) {
    function biolife_primary_menu( $layout = 'horizontal' )
    {
        $enable_metabox = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            null,
            "enable_metabox_options"
        );
        $primary_menu   = '';
        if ( $enable_metabox == 1 ) {
            $primary_menu = biolife_theme_option_meta(
                '_custom_metabox_theme_options',
                null,
                "metabox_primary_menu"
            );
        }
        if ( !empty( $primary_menu ) ) {
            $term = get_term_by( 'slug', $primary_menu, 'nav_menu' );
            if ( !is_wp_error( $term ) && !empty( $term ) ) {
                wp_nav_menu( array(
                        'menu'            => $primary_menu,
                        'theme_location'  => $primary_menu,
                        'depth'           => 3,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'link_before'     => '<span class="hover"></span>',
                        'menu_class'      => 'biolife-nav main-menu ' . $layout . '-menu',
                        'megamenu_layout' => $layout,
                    )
                );
            }
        } else {
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                        'menu'            => 'primary',
                        'theme_location'  => 'primary',
                        'depth'           => 3,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'biolife-nav main-menu ' . $layout . '-menu',
                        'megamenu_layout' => $layout,
                    )
                );
            }
        }
    }
}
if ( !function_exists( 'biolife_header_menu_bar' ) ) {
    function biolife_header_menu_bar( $icon_class = 'ovic-icon-menu' )
    {
        ?>
        <div class="mobile-block block-menu-bar">
            <a href="javascript:void(0)" class="menu-bar menu-toggle">
                <span class="icon <?php echo esc_attr( $icon_class ); ?>"><span class="inner"><span></span><span></span><span></span></span></span>
                <span class="text"><?php echo esc_html__( 'Menu', 'biolife' ); ?></span>
            </a>
        </div>
        <?php
    }
}
/**
 *
 * VERTICAL MENU
 */
if ( !function_exists( 'biolife_vertical_menu' ) ) {
    function biolife_vertical_menu( $layout = 'default', $icon = 'ovic-icon-menu-2' )
    {
        biolife_get_template(
            "templates-parts/header-vertical.php",
            array(
                'layout' => $layout,
                'icon'   => $icon,
            )
        );
    }
}
if ( !function_exists( 'biolife_vertical_menu_button' ) ) {
    function biolife_vertical_menu_button()
    {
        $vertical_menu = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'vertical_menu',
            'metabox_vertical_menu'
        );
        if ( !biolife_is_mobile() && !empty( $vertical_menu ) ): ?>
            <div class="button-vertical">
                <a href="#" class="vertical-open">
                    <span class="icon ovic-icon-menu"><span class="inner"><span></span><span></span><span></span></span></span>
                </a>
            </div>
        <?php endif;
    }
}
/**
 *
 * HEADER SUBMENU
 */
if ( !function_exists( 'biolife_header_submenu' ) ) {
    function biolife_header_submenu( $menu_location, $depth = 2 )
    {
        $header_menu = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            $menu_location,
            "metabox_{$menu_location}"
        );
        if ( !empty( $header_menu ) ) {
            do_action( "biolife_before_header_menu_{$header_menu}", $header_menu );
            wp_nav_menu( array(
                    'menu'           => $header_menu,
                    'theme_location' => $header_menu,
                    'link_before'    => '<span class="text">',
                    'link_after'     => '</span>',
                    'depth'          => $depth,
                    'menu_class'     => 'ovic-menu header-submenu ' . $menu_location,
                )
            );
            do_action( "biolife_after_header_menu_{$header_menu}", $header_menu );
        }
    }
}
/**
 *
 * HEADER BANNER
 */
if ( !function_exists( 'biolife_header_banner' ) ) {
    function biolife_header_banner()
    {
        get_template_part( 'templates-parts/header', 'banner' );
    }
}
/**
 *
 * HEADER SOCIAL
 */
if ( !function_exists( 'biolife_header_social' ) ) {
    function biolife_header_social()
    {
        get_template_part( 'templates-parts/header', 'social' );
    }
}
/**
 *
 * HEADER MESSAGE
 */
if ( !function_exists( 'biolife_header_message' ) ) {
    function biolife_header_message()
    {
        get_template_part( 'templates-parts/header', 'mess' );
    }
}
/**
 *
 * HEADER INFO
 */
if ( !function_exists( 'biolife_header_info' ) ) {
    function biolife_header_info()
    {
        get_template_part( 'templates-parts/header', 'info' );
    }
}
/**
 *
 * HEADER SEARCH
 */
if ( !function_exists( 'biolife_header_search' ) ) {
    function biolife_header_search( $category = false, $text = '' )
    {
        echo '<div class="block-search">';
        biolife_get_template(
            "templates-parts/header-search.php",
            array(
                'category' => $category,
                'text'     => $text,
            )
        );
        echo '</div>';
    }
}
/**
 *
 * HEADER SEARCH POPUP
 */
if ( !function_exists( 'biolife_header_search_popup' ) ) {
    function biolife_header_search_popup( $category = false, $text = '' )
    {
        ?>
        <div class="block-search biolife-dropdown">
            <a data-biolife="biolife-dropdown" class="woo-search-link" href="javascript:void(0)">
                <span class="icon main-icon-search-2"></span>
                <span class="text"><?php echo esc_html__( 'Search', 'biolife' ); ?></span>
            </a>
            <div class="sub-menu">
                <?php
                biolife_get_template(
                    "templates-parts/header-search.php",
                    array(
                        'category' => $category,
                        'text'     => $text,
                    )
                );
                ?>
            </div>
        </div>
        <?php
    }
}
/**
 *
 * HEADER ACCOUNT MENU
 */
if ( !function_exists( 'biolife_header_user' ) ) {
    function biolife_header_user( $text = '' )
    {
        biolife_get_template( "templates-parts/header-user.php",
            array(
                'text' => $text,
            )
        );
    }
}
/**
 *
 * CUSTOM MOBILE MENU
 */
if ( !function_exists( 'biolife_before_mobile_menu' ) ) {
    function biolife_before_mobile_menu( $menu_locations, $data_menus )
    {
        biolife_get_template(
            "templates-parts/mobile-header.php",
            array(
                'menu_locations' => $menu_locations,
                'data_menus'     => $data_menus,
            )
        );
    }

    add_action( 'ovic_before_html_mobile_menu', 'biolife_before_mobile_menu', 10, 2 );
}
if ( !function_exists( 'biolife_after_mobile_menu' ) ) {
    function biolife_after_mobile_menu( $menu_locations, $data_menus )
    {
        biolife_get_template(
            "templates-parts/mobile-footer.php",
            array(
                'menu_locations' => $menu_locations,
                'data_menus'     => $data_menus,
            )
        );
    }

    add_action( 'ovic_after_html_mobile_menu', 'biolife_after_mobile_menu', 10, 2 );
}
/**
 *
 * CUSTOM FONT
 */
add_filter( 'elementor/fonts/additional_fonts', 'biolife_elementor_fonts' );
if ( !function_exists( 'biolife_elementor_fonts' ) ) {
    function biolife_elementor_fonts( $additional_fonts )
    {
        return array(
            'Brushline' => 'system',
        );
    }
}
add_filter( 'ovic_field_typography_customwebfonts', 'biolife_customwebfonts' );
if ( !function_exists( 'biolife_customwebfonts' ) ) {
    function biolife_customwebfonts( $additional_fonts )
    {
        $additional_fonts[] = 'Brushline';

        return $additional_fonts;
    }
}
/**
 *
 * MEGAMENU ICON
 */
if ( !function_exists( 'biolife_theme_options_icons' ) ) {
    function biolife_theme_options_icons( $icon )
    {
        biolife_get_template( "templates-parts/icon-options.php" );

        return biolife_get_icon_options( $icon );
    }

    add_filter( 'ovic_field_icon_add_icons', 'biolife_theme_options_icons' );
}
/**
 *
 * MEGAMENU ICON
 */
if ( !function_exists( 'biolife_megamenu_options_icons' ) ) {
    function biolife_megamenu_options_icons()
    {
        biolife_get_template( "templates-parts/icon-megamenu.php" );

        return biolife_get_icon_megamenu();
    }

    add_filter( 'ovic_menu_icons_setting', 'biolife_megamenu_options_icons' );
}
if ( !function_exists( 'biolife_elementor_icons' ) ) {
    function biolife_elementor_icons( $tabs )
    {
        $tabs['main-icon'] = [
            'name'          => 'main-icon',
            'label'         => esc_html__( 'Theme Icons', 'biolife' ),
            'url'           => '',
            'enqueue'       => [],
            'prefix'        => '',
            'displayPrefix' => '',
            'labelIcon'     => 'fab fa-font-awesome-alt',
            'ver'           => '1.0.0',
            'fetchJson'     => get_theme_file_uri( '/assets/json/main-icons.json' ),
            'native'        => true,
        ];

        return $tabs;
    }
}
if ( !function_exists( 'biolife_after_install_sample_data' ) ) {
    function biolife_after_install_sample_data()
    {
        $cpt_support   = get_option( 'elementor_cpt_support', [ 'page', 'post' ] );
        $cpt_support[] = 'ovic_menu';
        $cpt_support[] = 'ovic_footer';

        update_option( 'elementor_cpt_support', $cpt_support );
        update_option( 'elementor_disable_color_schemes', 'yes' );
        update_option( 'elementor_disable_typography_schemes', 'yes' );
        update_option( 'elementor_load_fa4_shim', 'yes' );

        if ( class_exists( 'Elementor\Plugin' ) ) {
            $manager = new Elementor\Core\Files\Manager();
            $manager->clear_cache();
        }
    }
}
/**
 *
 * POPUP NEWSLETTER
 */
if ( !function_exists( 'biolife_popup_newsletter' ) ) {
    function biolife_popup_newsletter()
    {
        global $post;
        $enable = biolife_get_option( 'enable_popup' );
        if ( $enable != 1 ) {
            return;
        }
        if ( isset( $_COOKIE['biolife_disabled_popup_by_user'] ) && $_COOKIE['biolife_disabled_popup_by_user'] == 'true' ) {
            return;
        }
        $page = (array)biolife_get_option( 'popup_page' );
        if ( isset( $post->ID ) && is_array( $page ) && in_array( $post->ID, $page ) && $post->post_type == 'page' ) {
            wp_enqueue_style( 'magnific-popup' );
            wp_enqueue_script( 'magnific-popup' );
            get_template_part( 'templates-parts/popup', 'newsletter' );
        }
    }
}