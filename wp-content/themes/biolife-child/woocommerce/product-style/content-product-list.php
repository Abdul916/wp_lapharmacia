<?php
/**
 * Name: Product List Style 01
 **/
?>
<?php

global $product;

$functions = array(
    array('remove_action', 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5),
);
biolife_add_action($functions);
?>
    <div class="product-inner">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('woocommerce_before_shop_loop_item');
        ?>
        <div class="product-thumb images tooltip-wrap tooltip-top">
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action('woocommerce_before_shop_loop_item_title');
            ?>
        </div>
        <div class="product-info">
            <div class="inner-info">
                <?php
                biolife_single_product_categories();

                /**
                 * Hook: woocommerce_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_product_title - 10
                 */
                do_action('woocommerce_shop_loop_item_title');

                biolife_product_shop_loop_excerpt();

                /**
                 * Hook: woocommerce_after_shop_loop_item_title.
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action('woocommerce_after_shop_loop_item_title');
                ?>
                <div class="group-button">
                    <?php
                    /**
                     * Hook: woocommerce_after_shop_loop_item.
                     *
                     * @hooked woocommerce_template_loop_product_link_close - 5
                     * @hooked woocommerce_template_loop_add_to_cart - 10
                     */
                    do_action('woocommerce_after_shop_loop_item');
                    do_action('biolife_function_shop_loop_item_wishlist');
                    do_action('biolife_function_shop_loop_item_compare');
                    ?>
                </div>
            </div>
            <?php biolife_display_loop_extra_content() ?>
        </div>
    </div>
<?php
biolife_add_action($functions, true);
