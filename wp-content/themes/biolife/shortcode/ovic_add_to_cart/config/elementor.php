<?php
if (!defined('ABSPATH')) {
    exit();
}

use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Button;
use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Add_To_Cart extends Widget_Button
{
    /**
     * Get widget name.
     *
     * Retrieve image widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'ovic_add_to_cart';
    }

    /**
     * Get widget title.
     *
     * Retrieve image widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Add To Cart', 'biolife');
    }

    /**
     * Get widget icon.
     *
     * Retrieve image widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-woocommerce';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the image widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @return array Widget categories.
     * @since 2.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return array('ovic');
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_product',
            [
                'label' => esc_html__('Product', 'biolife'),
            ]
        );

        if (class_exists('ElementorPro\Modules\QueryControl\Module')) {
            $this->add_control(
                'product_id',
                [
                    'label'        => esc_html__('Search Product', 'biolife'),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'options'      => [],
                    'label_block'  => true,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'product'
                        ],
                    ],
                    'export'       => false,
                ]
            );
        } else {
            $this->add_control(
                'product_id',
                [
                    'label'       => esc_html__('Product', 'biolife'),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => '1',
                    'label_block' => true,
                ]
            );
        }

        $this->add_control(
            'show_title',
            [
                'label'     => esc_html__('Show Title', 'biolife'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Hide', 'biolife'),
                'label_on'  => esc_html__('Show', 'biolife'),
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label'     => esc_html__('Show Price', 'biolife'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Hide', 'biolife'),
                'label_on'  => esc_html__('Show', 'biolife'),
            ]
        );

        $this->add_control(
            'show_quantity',
            [
                'label'       => esc_html__('Show Quantity', 'biolife'),
                'type'        => Controls_Manager::SWITCHER,
                'label_off'   => esc_html__('Hide', 'biolife'),
                'label_on'    => esc_html__('Show', 'biolife'),
                'description' => esc_html__('Please note that switching on this option will disable some of the design controls.', 'biolife'),
            ]
        );

        $this->add_control(
            'quantity',
            [
                'label'     => esc_html__('Quantity', 'biolife'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1,
                'condition' => [
                    'show_quantity' => '',
                ],
            ]
        );

        $this->end_controls_section();
        parent::register_controls();

        $this->update_control(
            'link',
            [
                'type'    => Controls_Manager::HIDDEN,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->update_control(
            'text',
            [
                'default'     => esc_html__('Add to Cart', 'biolife'),
                'placeholder' => esc_html__('Add to Cart', 'biolife'),
            ]
        );

        $this->update_control(
            'selected_icon',
            [
                'default' => [
                    'value'   => 'fas fa-shopping-cart',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->update_control(
            'size',
            [
                'condition' => [
                    'show_quantity' => '',
                ],
            ]
        );

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'biolife'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_title',
                'label'    => __('Title', 'biolife'),
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .product-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_price',
                'label'    => __('Price', 'biolife'),
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .price',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['product_id'])) {
            $product_id = $settings['product_id'];
        } elseif (wp_doing_ajax()) {
            $product_id = $_POST['post_id'];
        } else {
            $product_id = get_queried_object_id();
        }

        global $product;

        $product = wc_get_product($product_id);

        if ('yes' === $settings['show_title'] && !empty($product)) {
            biolife_template_loop_product_title();
        }

        if ('yes' === $settings['show_price'] && !empty($product)) {
            woocommerce_template_loop_price();
        }

        $this->add_render_attribute('wrapper', 'class', 'add-to-cart');

        if ('yes' === $settings['show_quantity']) {
            $this->render_form_button($product);
        } else {
            $this->render_ajax_button($product);
        }
    }

    public function unescape_html($safe_text, $text)
    {
        return $text;
    }

    /**
     * @param  \WC_Product  $product
     */
    private function render_ajax_button($product)
    {
        $settings = $this->get_settings_for_display();

        if ($product) {
            if (version_compare(WC()->version, '3.0.0', '>=')) {
                $product_type = $product->get_type();
            } else {
                $product_type = $product->product_type;
            }

            $class = implode(' ', array_filter([
                'product_type_'.$product_type,
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
            ]));

            $this->add_render_attribute('button',
                [
                    'rel'             => 'nofollow',
                    'href'            => $product->add_to_cart_url(),
                    'data-quantity'   => (isset($settings['quantity']) ? $settings['quantity'] : 1),
                    'data-product_id' => $product->get_id(),
                    'class'           => $class,
                ]
            );

        } elseif (current_user_can('manage_options')) {
            $settings['text'] = esc_html__('Please set a valid product', 'biolife');
            $this->set_settings($settings);
        }

        parent::render();
    }

    private function render_form_button($product)
    {
        if (!$product && current_user_can('manage_options')) {
            echo esc_html__('Please set a valid product', 'biolife');

            return;
        }

        $text_callback = function () {
            ob_start();
            $this->render_text();

            return ob_get_clean();
        };

        add_filter('woocommerce_get_stock_html', '__return_empty_string');
        add_filter('woocommerce_product_single_add_to_cart_text', $text_callback);
        add_filter('esc_html', [$this, 'unescape_html'], 10, 2);

        ob_start();

        woocommerce_template_single_add_to_cart();

        $form = ob_get_clean();
        $form = str_replace('single_add_to_cart_button', 'single_add_to_cart_button elementor-button', $form);

        echo wp_specialchars_decode($form);

        call_user_func('remove'.'_'.'filter', 'woocommerce_product_single_add_to_cart_text', $text_callback);
        call_user_func('remove'.'_'.'filter', 'woocommerce_get_stock_html', '__return_empty_string');
        call_user_func('remove'.'_'.'filter', 'esc_html', [$this, 'unescape_html']);
    }
}