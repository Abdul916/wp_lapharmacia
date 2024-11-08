<?php
/**
 *
 * Name: Product Style 04
 * Shortcode: true
 * Theme Option: true
 **/
?>
<?php
$functions = array(
    array( 'remove_action', 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ),
    array( 'add_action', 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 ),
);
biolife_add_action( $functions );
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
            ?>
        </div>
    </div>
<?php
biolife_add_action( $functions, true );