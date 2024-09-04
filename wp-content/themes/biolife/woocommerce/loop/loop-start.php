<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * SETUP SHOP LOOP
 */
biolife_woocommerce_setup_loop();

$disable_labels = biolife_get_option( 'disable_labels' );
$disable_rating = biolife_get_option( 'disable_rating' );
$short_text     = biolife_get_option( 'short_text' );
$columns        = wc_get_loop_prop( 'columns' );
$product_style  = wc_get_loop_prop( 'style' );
$class          = array(
    "products",
    "shop-page",
    "response-content",
    "columns-{$columns}",
    "ovic-products {$product_style}",
);
if ( $disable_labels == 1 )
    $class[] = 'labels-not-yes';
if ( $disable_rating == 1 )
    $class[] = 'rating-not-yes';
if ( $short_text == 1 )
    $class[] = 'short-text-yes';

/**
 *
 * SHOP CONTROL
 */
biolife_control_before_shop_loop();
?>
<ul class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
