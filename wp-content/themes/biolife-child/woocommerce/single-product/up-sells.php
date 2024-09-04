<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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
 * @version     3.0.0
 * @var $upsells
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

$data    = biolife_generate_carousel_products( 'woo_upsell' );
$section = array(
    'up-sells upsells products ovic-products',
    $data['style'],
    $data['class_added']
);

if ( $upsells && !empty( $data ) ) : ?>

    <section class="<?php echo esc_attr( implode( ' ', $section ) ); ?>">

        <?php
        $heading  = !empty( $data['title'] ) ? $data['title'] : esc_html__( 'Up Sells Products', 'biolife' );
        $subtitle = !empty( $data['subtitle'] ) ? $data['subtitle'] : '';
        $icon     = !empty( $data['icon'] ) ? $data['icon'] : '';
        $heading  = apply_filters( 'woocommerce_product_up_sells_products_heading', $heading );
        ?>

        <?php if ( !empty( $heading ) || !empty( $subtitle ) ): ?>
            <div class="ovic-title style-01">
                <?php
                if ( !empty( $icon ) ) {
                    echo '<span class="icon ' . esc_attr( $icon ) . '"></span>';
                }
                if ( !empty( $subtitle ) ) {
                    echo '<p class="subtitle">' . esc_html( $subtitle ) . '</p>';
                }
                if ( !empty( $heading ) ) {
                    echo '<h2 class="title">' . esc_html( $heading ) . '</h2>';
                }
                ?>
            </div>
        <?php endif; ?>

        <div class="owl-slick products product-list-owl equal-container better-height" <?php echo esc_attr( $data['carousel'] ); ?> style="<?php echo esc_attr($data['style_css']);?>">

            <?php foreach ( $upsells as $upsell ) : ?>

                <?php
                $post_object = get_post( $upsell->get_id() );
                $classes     = array( 'product-item', $data['style'] );

                setup_postdata( $GLOBALS['post'] =& $post_object );
                ?>
                <div <?php wc_product_class( $classes, $upsell ); ?>>
                    <?php wc_get_template_part( 'product-style/content-product', $data['style'] ); ?>
                </div>

            <?php endforeach; ?>

            <?php
            wp_reset_postdata();
            wc_reset_loop();
            ?>

        </div>

    </section>

<?php endif;
