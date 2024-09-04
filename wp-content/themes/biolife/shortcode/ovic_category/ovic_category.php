<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Category"
 * @version 1.0.0
 */
class Shortcode_Ovic_Category extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode      = 'ovic_category';
    public $is_woocommerce = true;
    public $default        = array(
        'style' => 'style-01',
    );

    public function content( $atts, $content = null )
    {
        $css_class = $this->main_class( $atts, array(
            'ovic-category',
            $atts['style']
        ) );
        if ( $atts['style'] == 'style-05' || $atts['style'] == 'style-06' ) {
            $css_class .= ' style-03';
        }
        ob_start(); ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <?php if ( !empty( $atts['category'] ) ):
                $term = get_term_by( 'slug', $atts['category'], 'product_cat' );
                if ( !is_wp_error( $term ) && !empty( $term ) ): ?>
                    <?php
                    $term_link = get_term_link( $term->term_id, 'product_cat' );
                    if ( !empty( $atts['image']['id'] ) ) {
                        $image = $atts['image']['id'];
                    } else {
                        $image = get_term_meta( $term->term_id, 'thumbnail_id', true );
                    }
                    if ( !empty( $atts['title'] ) ) {
                        $title = $atts['title'];
                    } else {
                        $title = $term->name;
                    }
                    ?>
                    <a href="<?php echo esc_url( $term_link ); ?>" class="link <?php echo esc_attr( $atts['image_effect'] ); ?>">
                        <?php if ( !empty( $image ) ): ?>
                            <span class="thumb">
                                <?php echo wp_get_attachment_image( $image, 'full' ); ?>
                            </span>
                        <?php endif; ?>
                        <span class="content">
                            <span class="title"><?php echo esc_html( $title ); ?></span>
                            <?php if ( $atts['count'] == 'yes' ): ?>
                                <span class="clear"></span>
                                <?php if ( $atts['style'] == 'style-08' ): ?>
                                    <span class="count"><?php echo esc_html( $term->count ) . esc_html__( ' Items', 'biolife' ); ?></span>
                                <?php else : ?>
                                    <span class="count"><?php echo '(' . esc_html( $term->count ) . esc_html__( ' Items', 'biolife' ) . ')'; ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ( $atts['style'] == 'style-04' ): ?>
                                <span class="button"><?php echo esc_html__( 'View Now', 'biolife' ); ?></span>
                            <?php endif; ?>
                        </span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}