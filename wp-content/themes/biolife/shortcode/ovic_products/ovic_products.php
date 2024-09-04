<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Products"
 * @version 1.0.0
 */
class Shortcode_Ovic_Products extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $is_woocommerce = true;
    public $shortcode      = 'ovic_products';
    public $default        = array(
        'product_style'               => 'style-01',
        'pagination'                  => 'none',
        'target'                      => 'recent_products',
        'list_style'                  => 'none',
        'product_image_size'          => '300x300',
        'product_custom_thumb_width'  => '300',
        'product_custom_thumb_height' => '300',
        'slides_rows_space'           => '',
        'attribute'                   => '',
        'filter'                      => '',
        'ids'                         => '',
        'skus'                        => '',
        'limit'                       => '6',
        'order'                       => '',
        'orderby'                     => '',
        'category'                    => '',
        'category_brand'              => '',
        'slide_nav'                   => '',
        'slide_dot'                   => '',
        'overflow_visible'            => '',
    );

    public function content($atts, $content = null)
    {
        $html      = '';
        $css_class = array(
            'ovic-products',
            $atts['slide_dot'],
            $atts['slide_nav'],
            $atts['product_style'],
        );
        if (empty($atts['_id'])) {
            $atts['_id'] = uniqid();
        }
        if ($atts['pagination'] != 'none') {
            $css_class[] = "products_{$atts['_id']}";
            $css_class[] = "{$atts['pagination']}-products";
        }
        if ($atts['overflow_visible'] == 'yes') {
            $css_class[] = "content-overflow";
        }
        $css_class = $this->main_class($atts, $css_class);
        /**
         * BEFORE SHORTCODE
         */
        $this->get_template('layout/shortcode_before.php',
            array(
                'atts'          => $atts,
                'ovic_products' => $this,
            )
        );
        /**
         * CONTENT PRODUCTS
         */
        ob_start();
        if (!empty($atts['head_icon'])) {
            \Elementor\Icons_Manager::render_icon($atts['head_icon'], ['aria-hidden' => 'true']);
        }
        $icon = ob_get_clean();
        $html .= '<div data-id="products_'.esc_attr($atts['_id']).'" class="'.esc_attr($css_class).'">';
        if ($atts['product_style'] == 'style-12' && !empty($atts['head_title'])) {
            $item['head_link']['url'] = apply_filters('ovic_shortcode_vc_link', $atts['head_link']['url']);
            $link                     = $this->add_link_attributes($atts['head_link'], true);
            $html                     .= '<div class="head">';
            $html                     .= '<span class="icon">'.wp_specialchars_decode($icon).'</span>';
            $html                     .= '<h2 class="title">'.esc_html($atts['head_title']).'</h2>';
            if (!empty($atts['head_subtitle']))
                $html .= '<p class="subtitle">'.esc_html($atts['head_subtitle']).'</p>';
            if (!empty($atts['head_button']))
                $html .= '<div class="button-wrap"><a '.esc_attr($link).' class="link">'.esc_html($atts['head_button']).'</a></div>';
            $html .= '</div>';
        }
        if ($atts['target'] == 'products' && $atts['ids'] == '') {
            $atts['target'] = '';
        }
        if ($atts['target'] != '') {
            $html .= ovic_do_shortcode($atts['target'], biolife_shortcode_products_query($atts));
        } else {
            $html .= '<span>'.esc_html__('No Product', 'biolife').'</span>';
        }
        if (!empty($atts['special_label']['id'])) {
            $html .= '<div class="special-label">'.wp_get_attachment_image($atts['special_label']['id'], 'full').'</div>';
        }
        $html .= '</div>';
        /**
         * AFTER SHORTCODE
         */
        $this->get_template('layout/shortcode_after.php',
            array(
                'atts'          => $atts,
                'ovic_products' => $this,
            )
        );

        return $html;
    }
}