<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use Elementor\Core\Files\Assets\Svg\Svg_Handler;

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Newsletter"
 * @version 1.0.0
 */
class Shortcode_Ovic_Newsletter extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_newsletter';
    public $default   = array(
        'style' => 'style-01',
    );

    public function newsletter_form( $html, $form_id )
    {
        if ( function_exists( 'mc4wp_show_form' ) ) {
            $api_key = mc4wp_get_api_key();
            if ( empty( $api_key ) ) {
                echo sprintf( '<div class="alert alert-warning"><strong>%s</strong> <a href="' . esc_url( 'https://wordpress.org/plugins/mailchimp-for-wp/' ) . '">%s</a></div>',
                    esc_html__( 'Warning!', 'biolife' ),
                    esc_html__( 'API key is empty.', 'biolife' )
                );
            }
            if ( $form_id == get_option( 'mc4wp_default_form_id', '0' ) ) {
                add_filter( 'mc4wp_form_content',
                    function ( $content, $form, $element ) use ( $html ) {
                        return $html;
                    }, 10, 3
                );
                mc4wp_show_form( $form_id );
                remove_all_filters( 'mc4wp_form_content' );
            } else {
                mc4wp_show_form( $form_id );
            }
        } else {
            echo sprintf( '<div class="alert alert-warning"><strong>%s</strong> <a href="' . esc_url( 'https://wordpress.org/plugins/mailchimp-for-wp/' ) . '">%s</a></div>',
                esc_html__( 'Warning!', 'biolife' ),
                esc_html__( 'Please Active plugin "Mailchimp for WordPress".', 'biolife' )
            );
        }
    }

    public function content( $atts, $content = null )
    {
        $css_class = $this->main_class( $atts, array(
            'ovic-newsletter',
            $atts['style']
        ) );
        if ( $atts['style'] == 'style-04' )
            $css_class .= ' style-03';
        $form_id = get_option( 'mc4wp_default_form_id', '0' );
        if ( !empty( $atts['form_id'] ) ) {
            $form_id = $atts['form_id'];
        }
        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <div class="inner">
                <?php if ( $atts['selected_media'] == 'icon' ): ?>
                    <?php if ( !empty( $atts['selected_icon']['value'] ) ): ?>
                        <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $atts['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ( !empty( $atts['selected_image']['url'] ) ): ?>
                        <span class="icon">
                        <?php if ( strpos( basename( $atts['selected_image']['url'] ), '.svg' ) === false ) {
                            echo wp_get_attachment_image( $atts['selected_image']['id'], 'full' );
                        } else {
                            echo Svg_Handler::get_inline_svg( $atts['selected_image']['id'] );
                        } ?>
                    </span>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ( $atts['style'] == 'style-08' || $atts['style'] == 'style-10' ) echo '<div class="content">'; ?>
                <?php if ( !empty( $atts['title'] ) ): ?>
                    <h2 class="title"><?php echo esc_html( $atts['title'] ); ?></h2>
                <?php endif; ?>
                <?php if ( !empty( $atts['subtitle'] ) ): ?>
                    <p class="subtitle"><?php echo esc_html( $atts['subtitle'] ); ?></p>
                <?php endif; ?>
                <?php if ( $atts['style'] == 'style-08' || $atts['style'] == 'style-10' ) echo '</div>'; ?>
                <?php ob_start(); ?>
                <label class="text-field field-email">
                    <input class="input-text email-newsletter" type="email" name="EMAIL" required="required" placeholder="<?php echo esc_html( $atts['placeholder'] ); ?>">
                    <span class="input-focus"></span>
                </label>
                <button type="submit" class="submit-newsletter" value="">
                    <?php if ( !empty( $atts['button'] ) ) echo esc_html( $atts['button'] ); ?>
                </button>
                <?php
                $html = ob_get_clean();
                $this->newsletter_form( $html, $form_id );
                ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}