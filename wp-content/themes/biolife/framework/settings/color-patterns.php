<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
if ( !function_exists( 'biolife_enqueue_inline_css' ) ) {
    function biolife_enqueue_inline_css()
    {
        $css                       = html_entity_decode( biolife_get_option( 'ace_style', '' ) );
        $body_typography           = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'body_typography',
            'body_typography'
        );
        $special_typo              = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'special_typography',
            'metabox_special_typography',
            ''
        );
        $default_color             = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'default_color',
            'metabox_default_color',
            '#222'
        );
        $main_color                = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color',
            'metabox_main_color',
            '#90bf2a'
        );
        $main_color_t              = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_te',
            'metabox_main_color_t',
            '#fff'
        );
        $main_color_2              = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_color_2',
            'metabox_main_color_2',
            '#ffb71a'
        );
        $container                 = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_container',
            'metabox_main_container',
            1170
        );
        $main_fw                   = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_fw',
            'metabox_main_fw',
            600
        );
        $main_tt                   = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_tt',
            'metabox_main_tt',
            'uppercase'
        );
        $main_bora                 = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'main_bora',
            'metabox_main_bora',
            2
        );
        $vertical_items            = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'vertical_items',
            'metabox_vertical_items'
        );
        $sidebar_width             = biolife_get_option( 'sidebar_width', 270 );
        $sidebar_space             = biolife_get_option( 'sidebar_space', 30 );
        $shop_sidebar_width        = biolife_get_option( 'shop_sidebar_width', 270 );
        $shop_sidebar_space        = biolife_get_option( 'shop_sidebar_space', 30 );
        $sidebar_width_tablet      = biolife_get_option( 'sidebar_width_tablet', 270 );
        $sidebar_space_tablet      = biolife_get_option( 'sidebar_space_tablet', 30 );
        $shop_sidebar_width_tablet = biolife_get_option( 'shop_sidebar_width_tablet', 270 );
        $shop_sidebar_space_tablet = biolife_get_option( 'shop_sidebar_space_tablet', 30 );

        $css .= 'body{
        --main-color-r:' . Biolife_Colors::hexToRgb( $main_color )['r'] . ';
        --main-color-g:' . Biolife_Colors::hexToRgb( $main_color )['g'] . ';
        --main-color-b:' . Biolife_Colors::hexToRgb( $main_color )['b'] . ';
        --main-color-2-r:' . Biolife_Colors::hexToRgb( $main_color_2 )['r'] . ';
        --main-color-2-g:' . Biolife_Colors::hexToRgb( $main_color_2 )['g'] . ';
        --main-color-2-b:' . Biolife_Colors::hexToRgb( $main_color_2 )['b'] . ';
        --main-color-h:' . Biolife_Colors::hexToHsl( $main_color )['h'] . ';
        --main-color-s:' . Biolife_Colors::hexToHsl( $main_color )['s'] . '%;
        --main-color-l:' . Biolife_Colors::hexToHsl( $main_color )['l'] . '%;
        --main-color-2-h:' . Biolife_Colors::hexToHsl( $main_color_2 )['h'] . ';
        --main-color-2-s:' . Biolife_Colors::hexToHsl( $main_color_2 )['s'] . '%;
        --main-color-2-l:' . Biolife_Colors::hexToHsl( $main_color_2 )['l'] . '%;
        ';
        if ( !empty( $body_typography ) ) {
            if ( !empty( $body_typography['font-family'] ) ) {
                $css .= '--main-ff:' . $body_typography['font-family'] . ';';
            }
            if ( !empty( $body_typography['font-size'] ) ) {
                $css .= '--main-fz:' . $body_typography['font-size'] . 'px;';
            }
            if ( !empty( $body_typography['line-height'] ) ) {
                $css .= '--main-lh:' . $body_typography['line-height'] . 'px;';
            }
            if ( !empty( $body_typography['color'] ) ) {
                $css .= '--main-cl:' . $body_typography['color'] . ';';
            }
        }
        if ( !empty( $special_typo ) ) {
            if ( !empty( $special_typo['font-family'] ) ) {
                $css .= '--main-special:' . $special_typo['font-family'] . ';';
            }
        }
        if ( $default_color != '#222' ) {
            $css .= '--default-color:' . $default_color . ';';
        }
        if ( $main_color != '#90bf2a' ) {
            $css .= '--main-color:' . $main_color . ';';
        }
        if ( $main_color_t != '#fff' ) {
            $css .= '--main-color-t:' . $main_color_t . ';';
        }
        if ( $main_color_2 != '#ffb71a' ) {
            $css .= '--main-color-2:' . $main_color_2 . ';';
        }
        if ( $sidebar_width != 270 ) {
            $css .= '--sidebar-width:' . $sidebar_width . 'px;';
        }
        if ( $sidebar_space != 30 ) {
            $css .= '--sidebar-space:' . $sidebar_space . 'px;';
        }
        if ( $shop_sidebar_width != 270 ) {
            $css .= '--shop-sidebar-width:' . $shop_sidebar_width . 'px;';
        }
        if ( $shop_sidebar_space != 30 ) {
            $css .= '--shop-sidebar-space:' . $shop_sidebar_space . 'px;';
        }
        if ( $main_fw != 600 ) {
            $css .= '--main-h-fw:' . $main_fw . ';';
        }
        if ( $main_tt != 'uppercase' ) {
            $css .= '--main-h-tt:' . $main_tt . ';';
            $css .= '--button-fz:15px;';
        }
        if ( $main_bora != 90 ) {
            $css .= '--main-bora:' . $main_bora . 'px;';
        }
        $css .= '}';
        $css .= '@media (max-width:1199px) and (min-width:992px){body{';
        if ( $sidebar_width_tablet != 270 ) {
            $css .= '--sidebar-width:' . $sidebar_width_tablet . 'px;';
        }
        if ( $sidebar_space_tablet != 30 ) {
            $css .= '--sidebar-space:' . $sidebar_space_tablet . 'px;';
        }
        if ( $shop_sidebar_width_tablet != 270 ) {
            $css .= '--shop-sidebar-width:' . $shop_sidebar_width_tablet . 'px;';
        }
        if ( $shop_sidebar_space_tablet != 30 ) {
            $css .= '--shop-sidebar-space:' . $shop_sidebar_space_tablet . 'px;';
        }
        $css .= '}}';
        if ( !empty( $special_typo ) ) {
            if ( !empty( $special_typo['font-family'] && $special_typo['font-family'] == 'Brushline' ) ) {
                $fonts_url = get_theme_file_uri( '/assets/fonts/Brushline.ttf' );
                $css       .= '@font-face{
                    font-family: Brushline;
                    src: url(' . $fonts_url . ') format(\'truetype\');
                    font-weight: 400;
                    font-style: normal;
                    font-display: swap;
                }';
            }
        }
        if ( !empty( $container ) && $container != 1140 ) {
            $container_padding = $container + 30;
            $media             = $container_padding < 1200 ? 1200 : ( $container_padding + 30 );
            $css               .= '
            @media (min-width: ' . $media . 'px){
                body{
                    --main-container:' . $container . 'px;
                }
                body.wcfm-store-page .site #main{
                    width:' . $container_padding . 'px !important;
                }
            }
            ';
        }
        if ( !empty( $vertical_items ) ) {
            $css .= '
            .vertical-menu > .menu-item:nth-child(n+' . ( $vertical_items + 1 ) . '){
                display: none;
            }
            ';
        }

        $css = preg_replace( '/\s+/', ' ', $css );

        wp_add_inline_style( 'biolife-main',
            apply_filters( 'biolife_custom_inline_css', $css, $main_color, $container )
        );
    }

    add_action( 'wp_enqueue_scripts', 'biolife_enqueue_inline_css', 30 );
}
