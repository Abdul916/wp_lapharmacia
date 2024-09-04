<?php
/***
 * Core Name: WooCommerce
 * Version: 1.0.0
 * Author: Khanh
 */
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if ( class_exists( 'YITH_WCWL' ) ) {
    /* Custom icon */
    add_filter( 'yith_wcwl_button_icon', function ( $icon_option ) {
        if ( $icon_option == '' ) {
            $icon_option = 'ovic-wl-icon';
        }

        return $icon_option;
    } );
    add_filter( 'yith_wcwl_button_added_icon', function ( $added_icon_option ) {
        if ( $added_icon_option == '' ) {
            $added_icon_option = 'ovic-wl-icon added';
        }

        return $added_icon_option;
    } );
    if ( !function_exists( 'biolife_function_shop_loop_item_wishlist' ) ) {
        function biolife_function_shop_loop_item_wishlist()
        {
            echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
        }

        add_action( 'biolife_function_shop_loop_item_wishlist', 'biolife_function_shop_loop_item_wishlist', 10 );
    }
    if ( !function_exists( 'biolife_wishlist_positions' ) ) {
        function biolife_wishlist_positions( $positions )
        {
            unset( $positions['add-to-cart'] );

            return $positions;
        }

        add_filter( 'yith_wcwl_positions', 'biolife_wishlist_positions' );
    }
    /**
     *
     * HEADER WISHLIST
     */
    if ( !function_exists( 'biolife_header_wishlist' ) ) {
        function biolife_header_wishlist()
        {
            if ( class_exists( 'YITH_WCWL' ) ) : ?>
                <?php
                $wishlist_url = YITH_WCWL()->get_wishlist_url();
                $count        = YITH_WCWL()->count_products();
                if ( !empty( $wishlist_url ) ) : ?>
                    <div class="block-wishlist block-woo">
                        <a class="woo-wishlist-link icon-link" href="<?php echo esc_url( $wishlist_url ); ?>">
                            <span class="icon main-icon-heart-6">
                                <span class="count"><?php echo esc_html( $count ); ?></span>
                            </span>
                            <span class="text">
                                <?php echo esc_html__( 'Wishlist', 'biolife' ) ?>
                            </span>
                        </a>
                    </div>
                <?php endif;
            endif;
        }
    }
}
if ( class_exists( 'YITH_WCQV_Frontend' ) ) {
    $yith_enable    = get_option( 'yith-wcqv-enable' );
    $yith_on_mobile = get_option( 'yith-wcqv-enable-mobile' );
    $yith_class     = YITH_WCQV_Frontend::get_instance();
    if ( ( !wp_is_mobile() && $yith_enable == 'yes' ) || ( wp_is_mobile() && $yith_on_mobile == 'yes' && $yith_enable == 'yes' ) ) {
        add_action( 'init', function () use ( $yith_class ) {
            remove_action( 'woocommerce_after_shop_loop_item', array(
                $yith_class,
                'yith_add_quick_view_button'
            ), 15 );
        } );
        add_action( 'biolife_function_shop_loop_item_quickview', array( $yith_class, 'yith_add_quick_view_button' ), 5 );
    }
}

if ( class_exists( 'YITH_Woocompare' ) && get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' ) {
    global $yith_woocompare;

    $is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );

    if ( $yith_woocompare->is_frontend() || $is_ajax ) {
        if ( $is_ajax ) {
            if ( !class_exists( 'YITH_Woocompare_Frontend' ) && file_exists( YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php' ) ) {
                require_once YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
            }
            $yith_woocompare->obj = new YITH_Woocompare_Frontend();
        }
        /* Remove button */
        add_action('init', function () use ($yith_woocompare){
            remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
            remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
        }, 30);
        /* Add compare button */
        if ( !function_exists( 'biolife_wc_loop_product_compare_btn' ) ) {
            function biolife_wc_loop_product_compare_btn()
            {
                global $product;
                if ( shortcode_exists( 'yith_compare_button' ) ) {
                    echo do_shortcode( '[yith_compare_button product_id="' . $product->get_id() . '"]' );
                } else {
                    if ( class_exists( 'YITH_Woocompare_Frontend' ) ) {
                        echo do_shortcode( '[yith_compare_button product_id="' . $product->get_id() . '"]' );
                    }
                }
            }
        }
        add_action( 'biolife_function_shop_loop_item_compare', 'biolife_wc_loop_product_compare_btn', 1 );
    }
}
/**
 *
 * CUSTOM RATING SINGLE
 */
if ( !function_exists( 'biolife_get_stock_html' ) ) {
    function biolife_get_stock_html( $html, $product )
    {
        $availability = $product->get_availability();

        if ( empty( $availability['availability'] ) && $product->is_type( 'simple' ) ) {
            ob_start();

            wc_get_template(
                'single-product/stock.php',
                array(
                    'product'      => $product,
                    'class'        => 'in-stock',
                    'availability' => esc_html__( 'in stock', 'biolife' ),
                )
            );

            $html = ob_get_clean();
        }

        return $html;
    }
}
add_filter( 'woocommerce_get_stock_html', 'biolife_get_stock_html', 10, 2 );
/**
 *
 * RATING BOUNT
 */
if ( !function_exists( 'biolife_get_star_rating_html' ) ) {
    function biolife_get_star_rating_html( $html, $rating, $count )
    {
        global $product;

        if ( !empty( $product ) && method_exists( $product, 'get_review_count' ) ) {
            $review_count = $product->get_review_count();
            $review_count = zeroise( $review_count, 2 );
            if ( $review_count <= 0 ) {
                $html .= '<div class="star-rating"><span style="width:0"></span></div>';
            }
            if ( $review_count == 1 ) {
                $html .= '<strong class="rating-count">' . $review_count . '<span class="text">' . esc_html__( ' Review', 'biolife' ) . '</span></strong>';
            } else {
                $html .= '<strong class="rating-count">' . $review_count . '<span class="text">' . esc_html__( ' Reviews', 'biolife' ) . '</span></strong>';
            }
            if ( $review_count > 0 ) {
                return '<div class="star-rating-wrap">' . $html . '</div>';
            }
        }

        return '';
    }
}
add_filter( 'woocommerce_product_get_rating_html', 'biolife_get_star_rating_html', 10, 3 );
/**
 *
 * EXCERPT
 */
if ( !function_exists( 'biolife_product_shop_loop_excerpt' ) ) {
    function biolife_product_shop_loop_excerpt( $count = null )
    {
        global $product;
        ?>
        <div class="product-excerpt">
            <?php
            if ( $count == null ) {
                echo wp_specialchars_decode( $product->get_short_description() );
            } else {
                echo wp_trim_words( $product->get_short_description(), $count, esc_html__( '...', 'biolife' ) );
            }
            ?>
        </div>
        <?php
    }
}
/**
 *
 * WOOCOMMERCE CUSTOM SHOP CONTROL
 */
if ( !function_exists( 'biolife_loop_shop_per_page' ) ) {
    function biolife_loop_shop_per_page()
    {
        $products_perpage = biolife_get_option( 'product_per_page', '12' );

        return $products_perpage;
    }
}
if ( !function_exists( 'biolife_woof_products_query' ) ) {
    function biolife_woof_products_query( $wr )
    {
        $products_perpage     = biolife_get_option( 'product_per_page', '12' );
        $wr['posts_per_page'] = $products_perpage;

        return $wr;
    }
}
if ( !function_exists( 'biolife_control_before_shop_loop' ) ) {
    function biolife_control_before_shop_loop()
    {
        $template     = 'default';
        $is_shortcode = wc_get_loop_prop( 'is_shortcode' );
        if ( !$is_shortcode ) {
            wc_get_template( "product-control/{$template}-before-control.php",
                array(
                    'template_type' => $template,
                )
            );
        }
    }
}
if ( !function_exists( 'biolife_control_after_shop_loop' ) ) {
    function biolife_control_after_shop_loop()
    {
        $template     = 'default';
        $is_shortcode = wc_get_loop_prop( 'is_shortcode' );
        if ( !$is_shortcode ) {
            wc_get_template( "product-control/{$template}-after-control.php",
                array(
                    'template_type' => $template,
                )
            );
        }
    }
}
if ( !function_exists( 'biolife_shop_per_page' ) ) {
    function biolife_shop_per_page()
    {
        global $wp;
        if ( '' === get_option( 'permalink_structure' ) ) {
            $form_action = remove_query_arg( array(
                'page',
                'paged',
                'product-page'
            ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
        } else {
            $form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
        }
        $values      = array();
        $limit       = biolife_get_option( 'product_per_page', 20 );
        $page_layout = wc_get_loop_prop( 'page_layout' );
        $columns     = wc_get_loop_prop( 'columns' );
        for ( $i = 2; $i < 9; $i++ ) {
            if ( $page_layout == 'list' ) {
                $values[] = $i * (int)$limit;
            } else {
                $values[] = $i * (int)$columns;
            }
        }
        ?>
        <form class="per-page-form" method="GET" action="<?php echo esc_url( $form_action ); ?>">
            <select name="product_per_page" class="option-perpage">
                <option value="<?php echo esc_attr( $limit ); ?>" <?php echo esc_attr( 'selected' ); ?>>
                    <?php
                    if ( $limit == -1 ) {
                        echo esc_html__( 'All products', 'biolife' );
                    } else {
                        echo sprintf( esc_html__( 'Show %s products', 'biolife' ), zeroise( $limit, 2 ) );
                    }
                    ?>
                </option>
                <?php foreach ( $values as $value ) : ?>
                    <?php if ( $value != $limit ) : ?>
                        <option value="<?php echo esc_attr( $value ); ?>">
                            <?php echo sprintf( esc_html__( 'Show %s products', 'biolife' ), zeroise( $value, 2 ) ); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
                <option value="-1">
                    <?php echo esc_html__( 'Show All', 'biolife' ); ?>
                </option>
            </select>
            <?php wc_query_string_form_fields( null, array(
                'product_per_page',
                'submit',
                'paged',
                'product-page'
            ) ); ?>
        </form>
        <?php
    }
}
if ( !function_exists( 'biolife_shop_display_mode' ) ) {
    function biolife_shop_display_mode()
    {
        global $wp;
        if ( '' === get_option( 'permalink_structure' ) ) {
            $form_action = remove_query_arg( array(
                'page',
                'paged',
                'product-page'
            ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
        } else {
            $form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
        }
        $shop_page_layout = biolife_get_option( 'shop_page_layout', 'grid' );
        ?>
        <div class="display-mode-control">
            <form class="display-mode" method="get" action="<?php echo esc_attr( $form_action ); ?>">
                <button type="submit" value="grid" name="shop_page_layout"
                        class="mode-grid <?php if ( $shop_page_layout == 'grid' ) {
                            echo esc_attr( 'active' );
                        } ?>">
                    <span class="main-icon-grid-2"></span>
                </button>
                <button type="submit" value="list" name="shop_page_layout"
                        class="mode-list <?php if ( $shop_page_layout == 'list' ) {
                            echo esc_attr( 'active' );
                        } ?>">
                    <span class="main-icon-list-2"></span>
                </button>
                <?php wc_query_string_form_fields( null, array(
                    'shop_page_layout',
                    'submit',
                    'paged',
                    'product-page'
                ) ); ?>
            </form>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_generate_carousel_products' ) ) {
    function biolife_generate_carousel_products( $prefix )
    {
        $enable_product = biolife_get_option( $prefix . '_enable', 'enable' );
        if ( $enable_product == 'disable' ) {
            return array();
        }
        $disable_labels  = biolife_get_option( 'disable_labels' );
        $disable_rating  = biolife_get_option( 'disable_rating' );
        $short_text      = biolife_get_option( 'short_text' );
        $style_product   = biolife_get_option( $prefix . '_style', 'style-01' );
        $icon            = biolife_get_option( $prefix . '_icon', '' );
        $title_product   = biolife_get_option( $prefix . '_title', '' );
        $subtitle        = biolife_get_option( $prefix . '_subtitle', '' );
        $desktop         = biolife_get_option( $prefix . '_desktop', 6 );
        $laptop          = biolife_get_option( $prefix . '_laptop', 5 );
        $ipad            = biolife_get_option( $prefix . '_ipad', 4 );
        $landscape       = biolife_get_option( $prefix . '_landscape', 4 );
        $portrait        = biolife_get_option( $prefix . '_portrait', 3 );
        $mobile          = biolife_get_option( $prefix . '_mobile', 2 );
        $margin          = array( 0, 0, 0, 0, 0 );
        $dots            = false;
        $nav_style       = '';
        $class_added     = '';
        $body_background = biolife_theme_option_meta(
            '_custom_metabox_theme_options',
            'body_background',
            'metabox_body_background'
        );
        if ( !empty( $body_background ) ) {
            $class_added .= 'border-full hide-border-yes';
        } else {
            $class_added .= 'border-simple';
        }
        $margin      = apply_filters( 'biolife_generate_carousel_products_margin', $margin );
        $dots        = apply_filters( 'biolife_generate_carousel_products_dots', $dots );
        $class_added .= apply_filters( 'biolife_generate_carousel_products_nav_style', $nav_style );
        if ( $disable_labels == 1 ) {
            $class_added .= ' labels-not-yes';
        }
        if ( $disable_rating == 1 ) {
            $class_added .= ' rating-not-yes';
        }
        if ( $short_text == 1 ) {
            $class_added .= ' short-text-yes';
        }
        $data_slick = apply_filters( 'biolife_generate_carousel_' . $prefix . '_products', array(
                'infinite'     => false,
                'slidesMargin' => $margin[0],
                'dots'         => $dots,
                'slidesToShow' => (int)$desktop,
                'responsive'   => array(
                    array(
                        'breakpoint' => 1500,
                        'settings'   => array(
                            'slidesToShow' => (int)$laptop,
                        ),
                    ),
                    array(
                        'breakpoint' => 1200,
                        'settings'   => array(
                            'slidesMargin' => $margin[1],
                            'slidesToShow' => (int)$ipad,
                        ),
                    ),
                    array(
                        'breakpoint' => 992,
                        'settings'   => array(
                            'slidesMargin' => $margin[2],
                            'slidesToShow' => (int)$landscape,
                        ),
                    ),
                    array(
                        'breakpoint' => 768,
                        'settings'   => array(
                            'slidesMargin' => $margin[3],
                            'slidesToShow' => (int)$portrait,
                        ),
                    ),
                    array(
                        'breakpoint' => 480,
                        'settings'   => array(
                            'slidesMargin' => $margin[4],
                            'slidesToShow' => (int)$mobile,
                        ),
                    ),
                ),
            )
        );
        $generate   = ' data-slick=' . json_encode( $data_slick ) . ' ';

        $style_css = '--show: ' . $desktop . ';--margin:' . $margin[0] . 'px;';
        $style_css .= '--show-laptop: ' . $laptop . ';--margin-laptop:' . $margin[0] . 'px;';
        $style_css .= '--show-ipad: ' . $ipad . ';--margin-ipad:' . $margin[1] . 'px;';
        $style_css .= '--show-landscape: ' . $landscape . ';--margin-landscape:' . $margin[2] . 'px;';
        $style_css .= '--show-portrait: ' . $portrait . ';--margin-portrait:' . $margin[3] . 'px;';
        $style_css .= '--show-mobile: ' . $mobile . ';--margin-mobile:' . $margin[4] . 'px;';

        return array(
            'icon'        => $icon,
            'title'       => $title_product,
            'subtitle'    => $subtitle,
            'style'       => $style_product,
            'carousel'    => $generate,
            'class_added' => $class_added,
            'style_css'   => $style_css,
        );
    }
}
if ( !function_exists( 'biolife_woocommerce_setup_loop' ) ) {
    function biolife_woocommerce_setup_loop( $args = array() )
    {
        $is_shortcode  = wc_get_loop_prop( 'is_shortcode' );
        $page_layout   = biolife_get_option( 'shop_page_layout', 'grid' );
        $product_style = biolife_get_option( 'shop_product_style', 'style-01' );
        $columns       = biolife_get_option( 'product_loop_columns', 4 );
        $short_title   = biolife_get_option( 'enable_short_title' );
        $product_hover = biolife_get_option( 'product_hover', '' );

        $classes = array();

        if ( $page_layout == 'list' ) {
            $columns       = 1;
            $product_style = 'list';
        }

        $default = array(
            'width'         => '',
            'height'        => '',
            'class'         => $classes,
            'page_layout'   => $page_layout,
            'style'         => $product_style,
            'columns'       => $columns,
            'short_title'   => $short_title,
            'product_hover' => $product_hover,
        );

        $args = wp_parse_args( $args, $default );

        if ( $is_shortcode == true || !class_exists( 'Ovic_Addon_Toolkit' ) ) {
            unset( $args['columns'] );
            unset( $args['page_layout'] );
        }

        foreach ( $args as $key => $value ) {
            wc_set_loop_prop( $key, $value );
        }
    }
}
if ( !function_exists( 'biolife_custom_available_variation' ) ) {
    function biolife_custom_available_variation( $data, $product, $variation )
    {
        $check = false;
        if ( is_ajax() && !empty( $_POST['custom_data'] ) ) {
            $check = true;
            list( $width, $height ) = explode( 'x', $_POST['custom_data'] );
        } elseif ( !empty( wc_get_loop_prop( 'width' ) ) && !empty( wc_get_loop_prop( 'height' ) ) ) {
            $check  = true;
            $width  = wc_get_loop_prop( 'width' );
            $height = wc_get_loop_prop( 'height' );
        }

        if ( $check ) {
            $image_variable             = biolife_resize_image( $data['image_id'], $width, $height, true, false );
            $data['image']['src']       = $image_variable['url'];
            $data['image']['url']       = $image_variable['url'];
            $data['image']['full_src']  = $image_variable['url'];
            $data['image']['thumb_src'] = $image_variable['url'];
            $data['image']['srcset']    = $image_variable['url'];
            $data['image']['src_w']     = $width;
            $data['image']['src_h']     = $height;
        }

        return $data;
    }

    add_filter( 'woocommerce_available_variation', 'biolife_custom_available_variation', 10, 3 );
}
if ( !function_exists( 'biolife_get_size_image' ) ) {
    function biolife_get_size_image()
    {
        // GET SIZE IMAGE SETTING
        $width  = 300;
        $height = 300;
        $size   = wc_get_image_size( 'shop_catalog' );
        if ( $size ) {
            $width  = $size['width'];
            $height = $size['height'];
        }
        $width  = wc_get_loop_prop( 'width' ) ? wc_get_loop_prop( 'width' ) : $width;
        $height = wc_get_loop_prop( 'height' ) ? wc_get_loop_prop( 'height' ) : $height;

        return apply_filters( 'biolife_get_size_image_product',
            array(
                'width'  => $width,
                'height' => $height,
            )
        );
    }
}
/**
 *
 * PRODUCT THUMBNAIL
 */
if ( !function_exists( 'biolife_template_loop_product_thumbnail' ) ) {
    function biolife_template_loop_product_thumbnail()
    {
        global $product;

        $size_image         = biolife_get_size_image();
        $crop               = true;
        $lazy_load          = true;
        $thumbnail_id       = $product->get_image_id();
        $gallery_ids        = $product->get_gallery_image_ids();
        $default_attributes = $product->get_default_attributes();
        $product_hover      = wc_get_loop_prop( 'product_hover' );
        $link               = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
        if ( !empty( $default_attributes ) ) {
            $lazy_load = false;
        }
        $class_wrapper = array(
            "thumb-wrapper",
        );
        $class_thumb   = array(
            'thumb-link',
            'hover-' . $product_hover,
            'woocommerce-product-gallery__image',
        );
        $class_img     = '';
        $owl_settings  = '';
        $image_second  = '';
        $image_slide   = '';
        if ( !biolife_is_mobile() && $product_hover == 'change' && !empty( $gallery_ids[0] ) ) {
            $second_thumb = biolife_resize_image( $gallery_ids[0], $size_image['width'], $size_image['height'], $crop, $lazy_load, true, 'wp-post-image' );
            $image_second = '<figure class="second-thumb">' . $second_thumb['img'] . '</figure>';
        } elseif ( $product_hover == 'slide' && !empty( $gallery_ids ) ) {
            $class_wrapper[] = 'owl-slick';
            foreach ( $gallery_ids as $gallery_id ) {
                $slick_data   = array(
                    'infinite'     => false,
                    'arrows'       => false,
                    'dots'         => true,
                    'slidesMargin' => 0,
                );
                $owl_settings = 'data-slick=' . json_encode( $slick_data ) . '';
                $second_slide = biolife_resize_image( $gallery_id, $size_image['width'], $size_image['height'], $crop, $lazy_load );
                $image_slide  .= '<a href="' . esc_url( $product->get_permalink() ) . '"><figure class="second-thumb">' . $second_slide['img'] . '</figure></a>';
            }
        } else {
            $class_img = 'wp-post-image';
        }
        $primary_thumb = biolife_resize_image( $thumbnail_id, $size_image['width'], $size_image['height'], $crop, $lazy_load, true, $class_img );
        $image_thumb   = '<figure class="primary-thumb">' . $primary_thumb['img'] . '</figure>';
        ?>
        <div class="<?php echo implode( ' ', $class_wrapper ) ?>" <?php echo esc_attr( $owl_settings ); ?>>
            <a class="<?php echo esc_attr( implode( ' ', $class_thumb ) ); ?>"
               href="<?php echo esc_url( $link ); ?>">
                <?php echo wp_specialchars_decode( $image_thumb . $image_second ); ?>
            </a>
            <?php echo wp_specialchars_decode( $image_slide ); ?>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_header_cart_link' ) ) {
    function biolife_header_cart_link( $dropdown = true )
    {
        $header = biolife_get_header(); ?>
        <a class="woo-cart-link icon-link" href="<?php echo wc_get_cart_url(); ?>"
           data-biolife="<?php if ( !is_cart() && !is_checkout() && $dropdown == true ) {
               echo esc_attr( 'biolife-dropdown' );
           } ?>">
            <?php if ( $header == 'style-07' ) : ?>
                <span class="icon main-icon-cart-4"></span>
                <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                <span class="item"><?php echo esc_html__( 'item', 'biolife' ); ?></span>
                <span class="total"> - <?php echo WC()->cart->get_cart_subtotal(); ?></span>
                <span class="text"><?php echo esc_html__( 'Go', 'biolife' ); ?></span>
            <?php elseif ( $header == 'style-10' ) : ?>
                <span class="icon main-icon-cart-4"></span>
                <span class="text"><?php echo esc_html__( 'My Bag', 'biolife' ); ?></span>
                <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            <?php elseif ( $header == 'style-11' ) : ?>
                <span class="icon main-icon-cart-4"></span>
                <span class="text"><?php echo esc_html__( 'My Cart', 'biolife' ); ?></span>
                <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
            <?php elseif ( $header == 'style-12' ) : ?>
                <span class="icon main-icon-cart">
                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </span>
                <span class="total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
            <?php else : ?>
                <span class="icon main-icon-cart-4">
                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </span>
                <span class="text"><?php echo esc_html__( 'My Cart', 'biolife' ); ?></span>
                <span class="total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
            <?php endif; ?>
        </a>
        <?php
    }
}
if ( !function_exists( 'biolife_header_mini_cart' ) ) {
    function biolife_header_mini_cart()
    {
        ?>
        <div class="block-minicart biolife-dropdown main-bora-2">
            <?php
            biolife_header_cart_link();
            the_widget( 'WC_Widget_Cart', 'title=' );
            ?>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_cart_link_fragment' ) ) {
    function biolife_cart_link_fragment( $fragments )
    {
        $count    = WC()->cart->get_cart_contents_count();
        $subtotal = WC()->cart->get_cart_subtotal();

        $fragments['a.woo-cart-link .count'] = '<span class="count">' . esc_html( $count ) . '</span>';
        $fragments['a.woo-cart-link .total'] = '<span class="total">' . wp_specialchars_decode( $subtotal ) . '</span>';

        return $fragments;
    }
}
if ( !function_exists( 'biolife_template_loop_product_title' ) ) {
    function biolife_template_loop_product_title()
    {
        global $product;

        $link  = apply_filters( 'woocommerce_loop_product_link', $product->get_permalink(), $product );
        $class = apply_filters( 'woocommerce_product_loop_title_classes', 'product-title' );

        echo '<h2 class="' . esc_attr( $class ) . '"><a href="' . esc_url( $link ) . '">' . $product->get_title() . '</a></h2>';
    }
}
if ( !function_exists( 'biolife_product_loop_countdown' ) ) {
    function biolife_product_loop_countdown( $style = 'style-01', $title = '', $day = '', $hour = '', $min = '', $sec = '' )
    {
        global $product;

        $date   = biolife_get_max_date_sale( $product );
        $enable = biolife_get_option( 'enable_countdown_product' );

        if ( is_product() && $enable == 0 ) {
            return;
        }

        if ( $product->is_on_sale() ) {
            $date = apply_filters( 'ovic_change_datetime_countdown', $date, $product->get_id() );
        }
        if ( $date > 0 ) {
            if ( !empty( $title ) ) {
                echo '<div class="countdown-title">' . esc_html( $title ) . '</div>';
            }
            echo biolife_do_shortcode( 'ovic_countdown',
                array(
                    'style'     => $style,
                    'date'      => wp_date( 'm/j/Y H:i:s', $date ),
                    'days_text' => $day,
                    'hrs_text'  => $hour,
                    'mins_text' => $min,
                    'secs_text' => $sec,
                )
            );
        }
    }
}
if ( !function_exists( 'biolife_get_max_date_sale' ) ) {
    function biolife_get_max_date_sale( $product )
    {
        $sale_to = $product->get_date_on_sale_to();
        // Loop through variations
        if ( !empty( $product->get_children() ) ) {
            $timestamp = array();
            foreach ( $product->get_children() as $key => $variation_id ) {
                $variations = wc_get_product( $variation_id );
                if ( !empty( $variations ) && $variations->is_on_sale() && $variations->get_date_on_sale_to() != '' ) {
                    $sale_to     = $variations->get_date_on_sale_to();
                    $timestamp[] = $sale_to->getTimestamp();
                }
            }
            if ( !empty( $timestamp ) ) {
                return max( $timestamp );
            }
        }
        // Loop through simple
        if ( $product->is_on_sale() && $sale_to != '' ) {
            return $sale_to->getTimestamp();
        }

        return 0;
    }
}
if ( !function_exists( 'biolife_sale_percent' ) ) {
    function biolife_sale_percent()
    {
        global $product;

        $percent = '';
        if ( $product->get_type() == 'variable' ) {
            $available_variations = $product->get_variation_prices();
            $max_percent          = 0;
            if ( !empty( $available_variations['regular_price'] ) ) {
                foreach ( $available_variations['regular_price'] as $key => $regular_price ) {
                    $sale_price = $available_variations['sale_price'][ $key ];
                    if ( $sale_price < $regular_price ) {
                        $percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
                        if ( $percent > $max_percent ) {
                            $max_percent = $percent;
                        }
                    }
                }
            }
            $percent = $max_percent;
        } elseif ( ( $product->get_type() == 'simple' || $product->get_type() == 'external' ) ) {
            $percent = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
        }

        return $percent;
    }
}
/**
 *
 * PRODUCT LOOP GALLERY
 */
if ( !function_exists( 'biolife_template_loop_gallery' ) ) {
    function biolife_template_loop_gallery()
    {
        global $product;

        $index          = 0;
        $size_image     = biolife_get_size_image();
        $attachment_ids = $product->get_gallery_image_ids();
        $primary_full   = biolife_resize_image( $product->get_image_id(), $size_image['width'], $size_image['height'], true, true );
        $primary_thumb  = biolife_resize_image( $product->get_image_id(), 36, 36, true, true );
        if ( !biolife_is_mobile() && !empty( $attachment_ids ) ) : ?>
            <div class="product-loop-gallery">
                <div class="list-gallery">
                    <a href="#" data-image="<?php echo esc_url( $primary_full['url'] ); ?>"
                       data-index="<?php echo esc_attr( $index ); ?>" class="gallery-active">
                        <?php echo wp_specialchars_decode( $primary_thumb['img'] ); ?>
                    </a>
                    <?php foreach ( $attachment_ids as $attachment_id ) : ?>
                        <?php
                        $index++;
                        $gallery_full  = biolife_resize_image( $attachment_id, $size_image['width'], $size_image['height'], true, true );
                        $gallery_thumb = biolife_resize_image( $attachment_id, 36, 36, true, true );
                        ?>
                        <a href="#" data-image="<?php echo esc_url( $gallery_full['url'] ); ?>"
                           data-index="<?php echo esc_attr( $index ); ?>">
                            <?php echo wp_specialchars_decode( $gallery_thumb['img'] ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif;
    }
}
/**
 *
 * PRODUCT ITEM LOOP VARIABLE
 */
if ( !function_exists( 'biolife_template_loop_variable' ) ) {
    function biolife_template_loop_variable()
    {
        global $product;

        if ( $product->get_type() == 'variable' ) : ?>
            <?php
            $attributes = $product->get_variation_attributes();
            $size_image = biolife_get_size_image();
            if ( !empty( $attributes ) ):?>
                <form class="variations_form cart" method="post" enctype='multipart/form-data'
                      data-product_id="<?php echo absint( $product->get_id() ); ?>"
                      data-product_variations="false"
                      data-price="<?php echo esc_attr( $product->get_price_html() ); ?>"
                      data-custom_data="<?php echo absint( $size_image['width'] ); ?>x<?php echo absint( $size_image['height'] ); ?>">
                    <table class="variations">
                        <tbody>
                        <?php
                        foreach ( $attributes as $attribute_name => $options ) : ?>
                            <tr>
                                <td class="value">
                                    <?php
                                    $selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );
                                    wc_dropdown_variation_attribute_options(
                                        array(
                                            'options'   => $options,
                                            'attribute' => $attribute_name,
                                            'product'   => $product,
                                            'selected'  => $selected,
                                        )
                                    );
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php woocommerce_template_loop_price(); ?>
                    <div class="single_variation_wrap">
                        <div class="woocommerce-variation-add-to-cart variations_button">
                            <button type="submit" class="single_add_to_cart_button button alt">
                                <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                            </button>
                            <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>"/>
                            <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>"/>
                            <input type="hidden" name="variation_id" class="variation_id" value="0"/>
                        </div>
                    </div>
                </form>
            <?php
            endif;
        else:
            woocommerce_template_loop_price();
            woocommerce_template_loop_add_to_cart();
        endif;
    }
}
/**
 *
 * WOOCOMMERCE OPTIONS FLEXSLIDER
 */
if ( !function_exists( 'biolife_more_product_thumbnails' ) ) {
    function biolife_more_product_thumbnails()
    {
        global $product;

        $main_image    = false;
        $attachment_id = biolife_theme_option_meta( '_custom_metabox_product_options', null, 'poster' );
        $video_url     = biolife_theme_option_meta( '_custom_metabox_product_options', null, 'video' );
        $galleries     = biolife_theme_option_meta( '_custom_metabox_product_options', null, 'gallery' );

        $attachment_id     = !empty( $attachment_id ) ? $attachment_id : $product->get_image_id();
        $flexslider        = (bool)apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
        $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
        $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array(
            $gallery_thumbnail['width'],
            $gallery_thumbnail['height']
        ) );
        $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
        $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
        $image_src         = wp_get_attachment_image_src( $attachment_id, $image_size );
        $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
        $alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
        $image             = wp_get_attachment_image(
            $attachment_id,
            $image_size,
            false,
            apply_filters(
                'woocommerce_gallery_image_html_attachment_image_params',
                array(
                    'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ),
                        ENT_QUOTES, 'UTF-8', true ),
                    'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ),
                        ENT_QUOTES, 'UTF-8', true ),
                    'data-src'                => esc_url( $full_src[0] ),
                    'data-large_image'        => esc_url( $full_src[0] ),
                    'data-large_image_width'  => esc_attr( $full_src[1] ),
                    'data-large_image_height' => esc_attr( $full_src[2] ),
                    'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
                ),
                $attachment_id,
                $image_size,
                $main_image
            )
        );
        // VIDEO
        if ( !empty( $video_url ) ) {
            $thumbnail_src = get_theme_file_uri( 'assets/images/video.png' );

            $html = wp_video_shortcode( array(
                'src'     => $video_url,
                'poster'  => $image_src[0],
                'width'   => $image_src[1],
                'height'  => $image_src[2],
                'preload' => 'auto',
            ) );

            echo '<div data-thumb="' . esc_url( $thumbnail_src ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image none-zoom"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a>' . $html . '</div>';
        }
        // 360 DEGREE
        if ( !empty( $galleries ) ) {
            $thumbnail_src = get_theme_file_uri( 'assets/images/360degree.png' );
            $gallery       = explode( ',', $galleries );
            if ( !empty( $gallery[0] ) ) {
                $full_src = wp_get_attachment_image_src( $gallery[0], $full_size );
                $alt_text = trim( wp_strip_all_tags( get_post_meta( $gallery[0], '_wp_attachment_image_alt', true ) ) );
                $image    = wp_get_attachment_image(
                    $gallery[0],
                    $image_size,
                    false,
                    apply_filters(
                        'woocommerce_gallery_image_html_attachment_image_params',
                        array(
                            'title'                   => _wp_specialchars( get_post_field( 'post_title', $gallery[0] ),
                                ENT_QUOTES, 'UTF-8', true ),
                            'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt',
                                $gallery[0] ),
                                ENT_QUOTES, 'UTF-8', true ),
                            'data-src'                => esc_url( $full_src[0] ),
                            'data-large_image'        => esc_url( $full_src[0] ),
                            'data-large_image_width'  => esc_attr( $full_src[1] ),
                            'data-large_image_height' => esc_attr( $full_src[2] ),
                            'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
                        ),
                        $gallery[0],
                        $image_size,
                        $main_image
                    )
                );
            }

            $html = biolife_do_shortcode( 'ovic_360degree', array(
                'ovic_vc_custom_id' => uniqid( 'ovic_vc_custom_' ),
                'gallery_degree'    => $galleries,
                'width'             => $image_src[1],
                'height'            => $image_src[2],
            ) );
            echo '<div data-thumb="' . esc_url( $thumbnail_src ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image none-zoom"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a>' . $html . '</div>';
        }
    }
}
if ( !function_exists( 'biolife_product_query' ) ) {
    function biolife_product_query( $my_query )
    {
        if ( is_shop() || is_product_taxonomy() ) {
            $orderby_value = isset( $_GET['orderby'] ) ? wc_clean( (string)wp_unslash( $_GET['orderby'] ) ) : wc_clean( get_query_var( 'orderby' ) ); // WPCS: sanitization ok, input var ok, CSRF ok.
            switch ( $orderby_value ) {
                case 'sale':
                    $my_query->set( 'meta_key', 'total_sales' );
                    $my_query->set( 'orderby', 'meta_value_num' );

                    break;

                case 'on-sale':
                    $product_ids_on_sale   = wc_get_product_ids_on_sale();
                    $product_ids_on_sale[] = 0;
                    $my_query->set( 'post__in', $product_ids_on_sale );
                    $my_query->set( 'orderby', 'post__in' );

                    break;

                case 'feature':
                    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                    $my_query->set( 'tax_query', array(
                            array(
                                'taxonomy' => 'product_visibility',
                                'field'    => 'term_taxonomy_id',
                                'terms'    => $product_visibility_term_ids['featured'],
                            ),
                        )
                    );
                    $my_query->set( 'order', 'desc' );

                    break;
            };
        }
    }
}
if ( !function_exists( 'biolife_product_review_comment_form_args' ) ) {
    function biolife_product_review_comment_form_args( $comment_form )
    {
        $fields                 = biolife_comment_form_args();
        $comment_form['fields'] = array();
        $comment_form['fields'] = $fields;

        return $comment_form;
    }
}
add_filter( 'woocommerce_product_review_comment_form_args', 'biolife_product_review_comment_form_args' );
// SKU
if ( !function_exists( 'biolife_single_product_sku' ) ) {
    function biolife_single_product_sku()
    {
        global $product;
        if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
            <span class="sku_wrapper">
                <span class="title"><?php esc_html_e( 'Product Code', 'biolife' ); ?></span>
                <span class="sku">
                    <?php
                    if ( $sku = $product->get_sku() ) {
                        echo esc_html( $sku );
                    } else {
                        echo esc_html__( 'N/A', 'biolife' );
                    }
                    ?>
                </span>
            </span>
        <?php endif;
    }
}
// CATEGORIES
if ( !function_exists( 'biolife_single_product_categories' ) ) {
    function biolife_single_product_categories()
    {
        global $product;
        echo wc_get_product_category_list(
            $product->get_id(),
            ', ',
            '<span class="posted_in"><span class="title">' . _n( 'Category', 'Categories', count( $product->get_category_ids() ), 'biolife' ) . '</span><span class="categories"> ',
            '</span></span>'
        );
    }
}
// TAGS
if ( !function_exists( 'biolife_single_product_tags' ) ) {
    function biolife_single_product_tags()
    {
        global $product;
        echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as"><span class="title">' . _n( 'Tag', 'Tags', count( $product->get_tag_ids() ), 'biolife' ) . '</span><span class="tags"> ', '</span></span>' );
    }
}
// SHARE
if ( !function_exists( 'biolife_product_share' ) ) {
    function biolife_product_share()
    {
        if ( biolife_get_option( 'enable_share_product' ) == 1 && function_exists( 'ovic_share_button' ) ) : ?>
            <div class="share-product">
                <?php ovic_share_button(); ?>
            </div>
            <div class="clear"></div>
        <?php endif;
    }
}
// FLASH STOCK
if ( !function_exists( 'biolife_single_product_flash_stock' ) ) {
    function biolife_single_product_flash_stock()
    {
        global $product;
        if ( $product->get_type() == 'simple' ) :
            $availability = $product->get_availability();
            $class = 'stock ovic-stock available-product ' . $availability['class'];
            $text = $availability['availability'] ? $availability['availability'] : esc_html__( 'In Stock', 'biolife' );
            ?>
            <span class="<?php echo esc_attr( $class ); ?>">
                <span class="title"><?php echo esc_html__( 'Availability', 'biolife' ); ?></span>
                <span class="text"><?php echo esc_html( $text ); ?></span>
            </span>
        <?php
        endif;
    }
}
// PROCESS AVAILABLE
if ( !function_exists( 'biolife_process_valiable' ) ) {
    function biolife_process_valiable()
    {
        global $product;
        if ( $product->get_type() == 'simple' ) {
            $valiable = $product->get_stock_quantity();
            $sold     = get_post_meta( $product->get_id(), 'total_sales', true );
            if ( $valiable === 0 ) {
                $total   = $sold;
                $percent = 100;
            } elseif ( !$valiable ) {
                $total   = esc_html__( 'Unlimit', 'biolife' );
                $percent = 0;
            } else {
                $total   = $valiable + $sold;
                $percent = round( ( ( $sold / $total ) * 100 ), 0 );
            }
            ?>
            <div class="process-valiable">
                <span class="total">
                    <span class="process" style="width: <?php echo esc_attr( $percent ) . '%' ?>"></span>
                </span>
                <span class="text"><?php echo esc_html__( 'Sold:', 'biolife' ); ?></span>
                <span class="number"><?php echo esc_html( $sold . '/' . $total ); ?></span>
            </div>
            <?php
        }
    }
}
// DELIVERY
if ( !function_exists( 'biolife_single_product_delivery' ) ) {
    function biolife_single_product_delivery()
    {
        $new_delivery = biolife_get_option( 'add_delivery' );
        if ( !empty( $new_delivery ) ) { ?>
            <div class="more-devivery">
                <a href="<?php echo wp_specialchars_decode( $new_delivery ); ?>">
                    <?php echo esc_html__( 'Delivery & Return', 'biolife' ); ?>
                </a>
            </div>
        <?php }
    }
}
// DISPLAY CATEGORY
if ( !function_exists( 'biolife_loop_display_category' ) ) {
    function biolife_loop_display_category()
    {
        global $product;
        $cat_ids = $product->get_category_ids();
        if ( !empty( $cat_ids ) ) {
            foreach ( $cat_ids as $cat_id ) {
                if ( $term = get_term_by( 'id', $cat_id, 'product_cat' ) ) {
                    ?>
                    <div class="product-category">
                        <a href="<?php echo get_term_link( $term ) ?>"><?php echo esc_html( $term->name ); ?></a>
                    </div>
                    <?php
                    break;
                }
            }
        }
    }
}
// PERCENT DISCOUNT
if ( !function_exists( 'biolife_loop_display_percent_discount' ) ) {
    function biolife_loop_display_percent_discount()
    {
        $percent = biolife_get_percent_discount();
        if ( $percent != '' ) {
            ?>
            <span class="onsale custom"><?php echo wp_specialchars_decode( $percent ); ?></span>
            <?php
        }

    }
}
// PERCENTS
if ( !function_exists( 'biolife_get_percent_discount' ) ) {
    function biolife_get_percent_discount()
    {
        global $product;
        $percent = '';
        if ( $product->is_on_sale() ) {
            if ( $product->is_type( 'variable' ) ) {
                $available_variations = $product->get_available_variations();
                $maximumper           = 0;
                $minimumper           = 0;
                $percentage           = 0;
                for ( $i = 0; $i < count( $available_variations ); ++$i ) {
                    $variation_id      = $available_variations[ $i ]['variation_id'];
                    $variable_product1 = new WC_Product_Variation( $variation_id );
                    $regular_price     = $variable_product1->get_regular_price();
                    $sales_price       = $variable_product1->get_sale_price();
                    if ( $regular_price > 0 && $sales_price > 0 ) {
                        $percentage = round( ( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ), 0 );
                    }
                    if ( $minimumper == 0 ) {
                        $minimumper = $percentage;
                    }
                    if ( $percentage > $maximumper ) {
                        $maximumper = $percentage;
                    }
                    if ( $percentage < $minimumper ) {
                        $minimumper = $percentage;
                    }
                }
                if ( $minimumper == $maximumper ) {
                    $percent .= '<span class="percent">-' . $minimumper . '</span><small class="lab">%</small>';
                } else {
                    $percent .= '<span class="percent">-(' . $minimumper . '-' . $maximumper . ')<span><small>%</small>';
                }
            } else {
                if ( $product->get_regular_price() > 0 && $product->get_sale_price() > 0 ) {
                    $percentage = round( ( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ), 0 );
                    $percent    .= '<span class="percent">-' . $percentage . '</span><small>%</small>';
                }
            }
        }

        return $percent;
    }
}
/**
 * Retrieves the previous product.
 *
 * @param  bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param  array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param  string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 *
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
if ( !function_exists( 'biolife_get_previous_product' ) ) {
    function biolife_get_previous_product( $in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat' )
    {
        if ( !class_exists( 'Ovic_WooCommerce_Adjacent_Products' ) ) {
            return false;
        }
        $product = new Ovic_WooCommerce_Adjacent_Products( $in_same_term, $excluded_terms, $taxonomy, true );

        return $product->get_product();
    }
}
/**
 * Retrieves the next product.
 *
 * @param  bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param  array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param  string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 *
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
if ( !function_exists( 'biolife_get_next_product' ) ) {
    function biolife_get_next_product( $in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat' )
    {
        if ( !class_exists( 'Ovic_WooCommerce_Adjacent_Products' ) ) {
            return false;
        }
        $product = new Ovic_WooCommerce_Adjacent_Products( $in_same_term, $excluded_terms, $taxonomy );

        return $product->get_product();
    }
}
if ( !function_exists( 'biolife_single_product_pagination' ) ) {
    function biolife_single_product_pagination()
    {
        // Show only products in the same category?
        $in_same_term   = apply_filters( 'biolife_single_product_pagination_same_category', true );
        $excluded_terms = apply_filters( 'biolife_single_product_pagination_excluded_terms', '' );
        $taxonomy       = apply_filters( 'biolife_single_product_pagination_taxonomy', 'product_cat' );
        // Get previous and next products.
        $previous_product = biolife_get_previous_product( $in_same_term, $excluded_terms, $taxonomy );
        $next_product     = biolife_get_next_product( $in_same_term, $excluded_terms, $taxonomy );

        if ( !$previous_product && !$next_product ) {
            return;
        }
        ?>
        <nav class="pagination-product">
            <?php if ( $previous_product ):
                $previous_permalink = apply_filters( 'woocommerce_loop_product_link', $previous_product->get_permalink(), $previous_product ); ?>
                <a class="item prev" href="<?php echo esc_url( $previous_permalink ); ?>"
                   title="<?php echo esc_attr( $previous_product->get_name() ); ?>">
                    <?php echo esc_html__( 'Prev', 'biolife' ); ?>
                    <figure class="thumb"><?php echo wp_specialchars_decode( $previous_product->get_image( array(
                            100,
                            100
                        ) ) ); ?></figure>
                </a>
            <?php endif; ?>
            <?php if ( $next_product ):
                $next_permalink = apply_filters( 'woocommerce_loop_product_link', $next_product->get_permalink(), $next_product ); ?>
                <a class="item next" href="<?php echo esc_url( $next_permalink ); ?>"
                   title="<?php echo esc_attr( $next_product->get_name() ); ?>">
                    <?php echo esc_html__( 'Next', 'biolife' ); ?>
                    <figure class="thumb"><?php echo wp_specialchars_decode( $next_product->get_image( array(
                            100,
                            100
                        ) ) ); ?></figure>
                </a>
            <?php endif; ?>
        </nav>
        <div class="clear"></div>
        <?php
    }
}
/**
 *
 * WOOCOMMERCE OPTIONS FLEXSLIDER
 */
if ( !function_exists( 'biolife_single_product_carousel_options' ) ) {
    function biolife_single_product_carousel_options( $options )
    {
        $thumbnail = biolife_get_option( 'single_product_thumbnail', 'standard' );
        if ( $thumbnail == 'slide' ) {
            $options['directionNav'] = true;
            $options['controlNav']   = true;
            $options['slideshow']    = true;
            $options['touch']        = true;
        }

        return $options;
    }
}
add_filter( 'woocommerce_single_product_carousel_options', 'biolife_single_product_carousel_options' );
/**
 *
 *PRODUCT MULTIPRICE
 */
if ( !function_exists( 'biolife_loop_list_prices' ) ) {
    function biolife_loop_list_prices()
    {
        global $product;
        ?>
        <div class="group-prices">
            <?php if ( $product->is_type( 'variable' ) ) {
                foreach ( $product->get_available_variations() as $variation ) {
                    echo wp_specialchars_decode( $variation['price_html'] );
                }
            } else {
                woocommerce_template_loop_price();
            } ?>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_sale_process_availability' ) ) {
    function biolife_sale_process_availability()
    {
        global $product;

        $units_sold   = get_post_meta( $product->get_id(), 'total_sales', true );
        $availability = $product->get_stock_quantity();
        ?>
        <div class="availability-wrap">
            <div class="availability">
                <p class="availability-available">
                    <?php
                    $stock = esc_html__( 'Unlimit', 'biolife' );
                    if ( !empty( $availability ) && $availability > 0 ) {
                        $stock = $availability;
                    }
                    echo sprintf( '<span>%s</span><strong>%s</strong>', esc_html__( 'Available', 'biolife' ), $stock );
                    ?>
                </p>
                <p class="availability-sold">
                    <?php echo sprintf( '<span>%s</span><strong>%s</strong>', esc_html__( 'Already Sold', 'biolife' ), $units_sold ); ?>
                </p>
            </div>
        </div>
        <?php
    }
}

if ( !function_exists( 'biolife_display_loop_extra_content' ) ) {
    function biolife_display_loop_extra_content()
    {
        global $product;
        $meta = get_post_meta( $product->get_id(), '_custom_metabox_product_options', true );
        if ( !empty( $meta['custom_content'] ) || !empty( $meta['short_info'] ) ) { ?>
            <div class="group-info">
                <?php if ( !empty( $meta['short_info'] ) ) { ?>
                    <div class="short-info"><?php echo wp_specialchars_decode( $meta['short_info'] ); ?></div>
                <?php }
                if ( !empty( $meta['custom_content'] ) ) { ?>
                    <div class="custom-info">
                        <?php foreach ( $meta['custom_content'] as $custom_content ) {
                            if ( $custom_content ) { ?>
                                <div class="item">
                                    <?php
                                    if ( !empty( $custom_content['label'] ) ) { ?>
                                        <div class="label"><?php echo esc_html( $custom_content['label'] ); ?></div>
                                    <?php }
                                    if ( !empty( $custom_content['content'] ) ) { ?>
                                        <div class="content"><?php echo esc_html( $custom_content['content'] ); ?></div>
                                    <?php } ?>
                                </div>
                            <?php }
                        } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }
}
/**
 *
 * DELIVERY INFORMATION
 */
if ( !function_exists( 'biolife_single_product_delivery_2' ) ) {
    function biolife_single_product_delivery_2()
    {
        global $product;
        $views     = biolife_get_option( 'product_views' );
        $delivery  = biolife_get_option( 'delivery_info' );
        $meta_post = get_post_meta( $product->get_id(), '_custom_metabox_product_options', true );
        if ( !empty( $meta_post['enable_product_info'] ) ) {
            $delivery = $meta_post['delivery_info'];
        }
        if ( $views == 1 || !empty( $delivery ) ) { ?>
            <div class="delivery-info">
                <?php if ( $views == 1 ) echo biolife_post_views(); ?>
                <?php if ( !empty( $delivery ) ) : ?>
                    <?php foreach ( $delivery as $item ): ?>
                        <div class="item">
                            <?php if ( !empty( $item['icon'] ) ): ?>
                                <span class="icon <?php echo esc_attr( $item['icon'] ); ?>"></span>
                            <?php endif; ?>
                            <?php if ( !empty( $item['text'] ) ): ?>
                                <span class="text"><?php echo wp_specialchars_decode( $item['text'] ) ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php }
    }
}