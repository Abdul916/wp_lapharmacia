<?php
/**
 *
 * Name: Product Style 18
 * Shortcode: true
 * Theme Option: true
 **/
?>
<?php
global $product;
$functions = array(
    array( 'remove_action', 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ),
);
biolife_add_action( $functions );
?>
    <div class="product-inner product-02">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'woocommerce_before_shop_loop_item' );
        biolife_product_loop_countdown( 'style-06' );
        ?>
        <div class="product-thumb images">
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
        </div>
        <div class="product-info equal-elem">
            <div class="info-inner">
                <?php
                woocommerce_show_product_loop_sale_flash();
                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action( 'woocommerce_shop_loop_item_title' );
                biolife_single_product_categories();
                biolife_single_product_tags();
                ?>
                <span class="add-to-cart">
                    <a href="<?php echo esc_url( $product->get_permalink() ) ?>" class="button">
                        <?php
                        if ( ( $product->get_type() == 'simple' || $product->get_type() == 'external' ) ) {
                            $regular  = $product->get_regular_price() ? $product->get_regular_price() : 0;
                            $sale     = $product->get_sale_price() ? $product->get_sale_price() : $regular;
                            $discount = $regular - $sale;
                            if ( $discount != 0 ) {
                                $discount = wc_price( $discount, array( 'decimals' => 0 ) );
                                echo wp_specialchars_decode( $discount );
                                echo '<span class="delimiter">/</span>';
                            }
                        }
                        echo esc_html__( 'Order now!', 'biolife' );
                        ?>
                    </a>
                </span>
            </div>
        </div>
    </div>
<?php
biolife_add_action( $functions, true );