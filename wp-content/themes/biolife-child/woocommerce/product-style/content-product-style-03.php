<?php
/**
 *
 * Name: Product Style 03
 * Shortcode: true
 * Theme Option: true
 **/
?>
<div class="product-inner tooltip-wrap tooltip-top">
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );
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
        <?php
        biolife_product_loop_countdown( 'style-01' );
        biolife_single_product_categories();
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
        biolife_product_shop_loop_excerpt( 12 );
        ?>
        <div class="group-button">
            <?php
            if ( !biolife_is_mobile() ) {
                do_action( 'biolife_function_shop_loop_item_wishlist' );
            }
            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            if ( !biolife_is_mobile() ) {
                do_action( 'biolife_function_shop_loop_item_compare' );
            }
            ?>
        </div>
    </div>
</div>
