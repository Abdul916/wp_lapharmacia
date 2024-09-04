<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Testimonial"
 * @version 1.0.0
 */
class Shortcode_Ovic_Testimonial extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_testimonial';
    public $default   = array(
        'style' => 'style-01',
    );

    public function content( $atts, $content = null )
    {
        $css_class = $this->main_class( $atts, array(
            'ovic-testimonial',
            $atts['style']
        ) );

        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <?php
            if ( !empty( $atts['items'] ) ) {
                $this->get_template( "layout/{$atts['style']}.php",
                    array(
                        'testmonial' => $this,
                        'atts'       => $atts,
                    )
                );
            }
            ?>
        </div>
        <?php
        return ob_get_clean();
    }
}