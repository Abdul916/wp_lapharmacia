<?php
/**
 *
 * Name: Product Style 14
 * Shortcode: true
 * Theme Option: false
 **/
?>
<?php
global $product;
$thumbnail = wp_get_attachment_image_url( $product->get_image_id(), array( 96, 96 ) );
?>
<div class="product-inner">
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>
    <div class="product-thumb" data-thumbnail="<?php echo esc_url( $thumbnail ) ?>">
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
    <div class="product-info">
        <div class="inner-info">
            <?php
            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            <div class="custom-nav">
                <div class="inner">
                    <a class="slick-prev"></a>
                    <a class="slick-next"></a>
                </div>
            </div>
            <?php
            biolife_product_loop_countdown(
                'style-04',
                esc_html__( 'Hurry Up! Offer End In :', 'biolife' ),
                esc_html__( 'Days', 'biolife' ),
                esc_html__( 'Hours', 'biolife' ),
                esc_html__( 'Mins', 'biolife' ),
                esc_html__( 'Secs', 'biolife' )
            );
            ?>
        </div>
        <?php biolife_sale_process_availability(); ?>
    </div>
</div>