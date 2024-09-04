<?php
$style = '';
$bg    = biolife_get_option( 'head_bg' );
if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
    $bg_woo = biolife_get_option( 'head_bg_shop' );
    if ( !empty( $bg_woo ) )
        $bg = $bg_woo;
    if ( is_product_taxonomy() && 0 === absint( get_query_var( 'paged' ) ) ) {
        $term = get_queried_object();
        if ( $term && $term->taxonomy !== 'dc_vendor_shop' ) {
            $bg_taxonomy = get_term_meta( $term->term_id, 'banner_id', true );
            if ( $term->taxonomy === 'product_brand' )
                $bg_taxonomy = get_term_meta( $term->term_id, 'thumbnail_id', true );
            if ( !empty( $bg_taxonomy ) )
                $bg = $bg_taxonomy;
        }
    }
}
if ( is_page() ) {
    $bg_page = biolife_theme_option_meta( '_custom_page_side_options', null, 'page_head_bg' );
    if ( !empty( $bg_page ) )
        $bg = $bg_page;
}
if ( !empty( $bg ) ) {
    $style .= 'background-image: url(' . wp_get_attachment_image_url( $bg, 'full' ) . ');';
}
?>
<div class="page-head" <?php if ( !empty( $style ) ) echo 'style="' . esc_attr( $style ) . '""'; ?>>
    <div class="container">
        <div class="head-inner">
            <?php
            biolife_page_title();
            biolife_breadcrumb();
            ?>
        </div>
    </div>
</div>
