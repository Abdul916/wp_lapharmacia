<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
echo woocommerce_maybe_show_product_subcategories();
?>
<div class="shop-control shop-before-control">
    <?php woocommerce_result_count(); ?>
    <div class="display-per-page">
        <p class="title"><?php echo esc_html__( 'Show', 'biolife' ); ?></p>
        <?php biolife_shop_per_page(); ?>
    </div>
    <div class="display-sort-by">
        <p class="title"><?php echo esc_html__( 'Sort', 'biolife' ); ?></p>
        <?php woocommerce_catalog_ordering(); ?>
    </div>
    <?php biolife_shop_display_mode() ?>
</div>
