<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Tabs extends Ovic_Widget_Elementor
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
        return 'ovic_tabs';
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
        return esc_html__( 'Tabs', 'biolife' );
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
        return 'eicon-product-tabs';
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'general_section',
            [
                'tab'   => Controls_Manager::TAB_CONTENT,
                'label' => esc_html__( 'General', 'biolife' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Tab style', 'biolife' ),
                'options' => biolife_preview_options( $this->get_name() ),
                'default' => 'style-01',
            ]
        );

        $this->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'active',
            [
                'label'   => esc_html__( 'Active', 'biolife' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
                'min'     => 1,
            ]
        );

        $this->add_control(
            'is_ajax',
            [
                'label' => esc_html__( 'Enable ajax', 'biolife' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'image_active',
            [
                'type'      => Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Image Active', 'biolife' ),
                'selectors' => [
                    '{{WRAPPER}}' => '--cate-active: url({{URL}});',
                ],
                'condition' => [
                    'style' => [
                        'style-04',
                        'style-09',
                        'style-13'
                    ],
                ],
            ]
        );

        $this->add_control(
            'banner',
            [
                'type'      => Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Banner', 'biolife' ),
                'condition' => [
                    'style' => [
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'banner_link',
            [
                'type'      => Controls_Manager::URL,
                'label'     => esc_html__( 'Banner Link', 'biolife' ),
                'condition' => [
                    'style' => [
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'banner_effect',
            [
                'type'      => Controls_Manager::SELECT,
                'label'     => esc_html__( 'Banner Effect', 'biolife' ),
                'options'   => biolife_effect_style(),
                'default'   => '',
                'condition' => [
                    'style' => [
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'button',
            [
                'type'      => Controls_Manager::TEXT,
                'label'     => esc_html__( 'Button', 'biolife' ),
                'condition' => [
                    'style' => [
                        'style-15'
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_link',
            [
                'type'      => Controls_Manager::URL,
                'label'     => esc_html__( 'Button Link', 'biolife' ),
                'condition' => [
                    'style' => [
                        'style-15'
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'biolife' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'biolife' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'biolife' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'biolife' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tabs-head' => 'text-align: {{VALUE}};',
                ],
                'default'   => '',
                'condition' => [
                    'style!' => [
                        'style-08',
                        'style-09',
                        'style-10',
                        'style-12',
                        'style-15'
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tab_section',
            [
                'tab'   => Controls_Manager::TAB_CONTENT,
                'label' => esc_html__( 'Tab Content', 'biolife' ),
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->start_controls_tabs( 'tab_repeater' );

        $repeater->start_controls_tab(
            'tab_title',
            [
                'label' => esc_html__( 'Title', 'biolife' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tab Title', 'biolife' ),
                'placeholder' => esc_html__( 'Tab Title', 'biolife' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'   => esc_html__( 'Content', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'product'  => esc_html__( 'Products', 'biolife' ),
                    'template' => esc_html__( 'Template', 'biolife' ),
                    'link'     => esc_html__( 'Simple Link', 'biolife' ),
                ],
                'default' => 'product',
            ]
        );

        $repeater->add_control(
            'selected_media',
            [
                'label'   => esc_html__( 'Media', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'image' => esc_html__( 'Image', 'biolife' ),
                    'icon'  => esc_html__( 'Icon', 'biolife' ),
                ],
                'default' => 'image',
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label'            => esc_html__( 'Icon', 'biolife' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition'        => [
                    'selected_media' => 'icon'
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label'     => esc_html__( 'Image', 'biolife' ),
                'type'      => Controls_Manager::MEDIA,
                'condition' => [
                    'selected_media' => 'image'
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__( 'Link', 'biolife' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'biolife' ),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'content' => 'link',
                ],
            ]
        );

        $repeater->add_control(
            'class',
            [
                'label'       => esc_html__( 'Class', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_template',
            [
                'label'     => esc_html__( 'Template', 'biolife' ),
                'condition' => [
                    'content' => 'template',
                ],
            ]
        );

        if ( class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ) {
            $repeater->add_control(
                'template_id',
                [
                    'label'        => esc_html__( 'Template ID', 'biolife' ),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'options'      => [],
                    'label_block'  => true,
                    'multiple'     => false,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'elementor_library'
                        ],
                    ],
                    'description'  => sprintf( '%s <a href="%s" target="_blank">%s</a>',
                        esc_html__( 'Create template from', 'biolife' ),
                        admin_url( 'edit.php?post_type=elementor_library&tabs_group=library' ),
                        esc_html__( 'Here', 'biolife' )
                    ),
                    'export'       => false,
                ]
            );
        } else {
            $repeater->add_control(
                'template_id',
                [
                    'label'       => esc_html__( 'Template ID', 'biolife' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => '1',
                    'description' => sprintf( '%s <a href="%s" target="_blank">%s</a>',
                        esc_html__( 'Create template from', 'biolife' ),
                        admin_url( 'edit.php?post_type=elementor_library&tabs_group=library' ),
                        esc_html__( 'Here', 'biolife' )
                    ),
                ]
            );
        }

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_product',
            [
                'label'     => esc_html__( 'Product', 'biolife' ),
                'condition' => [
                    'content' => 'product',
                ],
            ]
        );

        $repeater->add_control(
            'target',
            [
                'label'   => esc_html__( 'Target', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'recent_products'       => esc_html__( 'Recent Products', 'biolife' ),
                    'featured_products'     => esc_html__( 'Feature Products', 'biolife' ),
                    'sale_products'         => esc_html__( 'Sale Products', 'biolife' ),
                    'best_selling_products' => esc_html__( 'Best Selling Products', 'biolife' ),
                    'top_rated_products'    => esc_html__( 'Top Rated Products', 'biolife' ),
                    'products'              => esc_html__( 'Products', 'biolife' ),
                    'product_category'      => esc_html__( 'Products Category', 'biolife' ),
                    'related_products'      => esc_html__( 'Products Related', 'biolife' ),
                ],
                'default' => 'recent_products',
            ]
        );

        if ( class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ) {
            $repeater->add_control(
                'ids',
                [
                    'label'        => esc_html__( 'Search Product', 'biolife' ),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'options'      => [],
                    'label_block'  => true,
                    'multiple'     => true,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'product'
                        ],
                    ],
                    'condition'    => [
                        'target' => 'products'
                    ],
                    'export'       => false,
                ]
            );
        } else {
            $repeater->add_control(
                'ids',
                [
                    'label'       => esc_html__( 'Product', 'biolife' ),
                    'type'        => Controls_Manager::TEXT,
                    'description' => esc_html__( 'Product ids', 'biolife' ),
                    'placeholder' => '1,2,3',
                    'label_block' => true,
                    'condition'   => [
                        'target' => 'products'
                    ],
                ]
            );
        }

        $repeater->add_control(
            'category',
            [
                'label'       => esc_html__( 'Products Category', 'biolife' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_taxonomy( [
                    'hide_empty' => true,
                    'taxonomy'   => 'product_cat',
                ] ),
                'label_block' => true,
                'condition'   => [
                    'target!' => 'products'
                ],
            ]
        );

        $repeater->add_control(
            'limit',
            [
                'label'       => esc_html__( 'Limit', 'biolife' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 6,
                'placeholder' => 6,
            ]
        );

        $repeater->add_control(
            'orderby',
            [
                'label'   => esc_html__( 'Order by', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''              => esc_html__( 'None', 'biolife' ),
                    'date'          => esc_html__( 'Date', 'biolife' ),
                    'ID'            => esc_html__( 'ID', 'biolife' ),
                    'author'        => esc_html__( 'Author', 'biolife' ),
                    'title'         => esc_html__( 'Title', 'biolife' ),
                    'modified'      => esc_html__( 'Modified', 'biolife' ),
                    'rand'          => esc_html__( 'Random', 'biolife' ),
                    'comment_count' => esc_html__( 'Comment count', 'biolife' ),
                    'menu_order'    => esc_html__( 'Menu order', 'biolife' ),
                    'price'         => esc_html__( 'Price: low to high', 'biolife' ),
                    'price-desc'    => esc_html__( 'Price: high to low', 'biolife' ),
                    'rating'        => esc_html__( 'Average Rating', 'biolife' ),
                    'popularity'    => esc_html__( 'Popularity', 'biolife' ),
                    'post__in'      => esc_html__( 'Post In', 'biolife' ),
                    'most-viewed'   => esc_html__( 'Most Viewed', 'biolife' ),
                ],
            ]
        );

        $repeater->add_control(
            'order',
            [
                'label'   => esc_html__( 'Sort order', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''     => esc_html__( 'None', 'biolife' ),
                    'DESC' => esc_html__( 'Descending', 'biolife' ),
                    'ASC'  => esc_html__( 'Ascending', 'biolife' ),
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'tabs',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'product_section',
            [
                'tab'   => Controls_Manager::TAB_SETTINGS,
                'label' => esc_html__( 'Product Settings', 'biolife' ),
            ]
        );

        $this->add_control(
            'product_style',
            array(
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Product style', 'biolife' ),
                'options' => biolife_product_options( 'Shortcode', true ),
                'default' => 'style-01',
            )
        );

        $this->product_size_field();

        $this->add_control(
            'disable_labels',
            [
                'label'        => esc_html__( 'Disable Labels', 'biolife' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'labels-not-',
            ]
        );

        $this->add_control(
            'disable_rating',
            [
                'label'        => esc_html__( 'Disable Rating', 'biolife' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'rating-not-',
            ]
        );

        $this->add_control(
            'disable_cate',
            [
                'label'        => esc_html__( 'Disable Category', 'biolife' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'cate-not-',
            ]
        );

        $this->add_control(
            'ensable_add_to_cart',
            [
                'label'        => esc_html__( 'Add to cart', 'biolife' ),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'add-to-cart-',
                'condition'    => [
                    'product_style' => 'style-02',
                ],
            ]
        );

        $this->add_control(
            'short_text',
            [
                'label'        => esc_html__( 'Short Title', 'biolife' ),
                'prefix_class' => 'short-text-',
                'type'         => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'overflow_visible',
            [
                'label' => esc_html__( 'Content Overflow', 'biolife' ),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_section',
            [
                'tab'   => Controls_Manager::TAB_SETTINGS,
                'label' => esc_html__( 'Carousel settings', 'biolife' ),
            ]
        );

        $this->add_control(
            'slide_nav',
            [
                'label'   => esc_html__( 'Nav style', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => biolife_nav_style(),
                'default' => '',
            ]
        );

        $this->add_responsive_control(
            'rows_space_new',
            [
                'label'     => esc_html__( 'Rows Space (px)', 'biolife' ),
                'type'      => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}}' => '--rows-space: {{VALUE}}px;',
                ],
            ]
        );

        $this->carousel_settings( false );

        $this->end_controls_section();

        $this->start_controls_section(
            'tabs_list_section',
            [
                'tab'   => Controls_Manager::TAB_SETTINGS,
                'label' => esc_html__( 'Tabs List settings', 'biolife' ),
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__( 'Typography', 'biolife' ),
                'name'     => 'tabs_list_typography',
                'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tabs-list',
            ]
        );

        $this->add_control(
            'tabs_list_color',
            [
                'label'     => esc_html__( 'Color', 'biolife' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ovic-tab .tabs-list' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tabs_list_color_active',
            [
                'label'     => esc_html__( 'Color Active', 'biolife' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ovic-tab .tab-item.active > a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ovic-tab .tab-item > a:hover'  => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tabs_list_bg',
            [
                'label'     => esc_html__( 'Background', 'biolife' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tab-item:not(.active) a:not(:hover)' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => [
                        'style-14'
                    ],
                ],
            ]
        );

        $this->add_control(
            'tabs_list_bg_active',
            [
                'label'     => esc_html__( 'Background Active', 'biolife' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ovic-tab .tab-item.active a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ovic-tab .tab-item a:hover'  => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => [
                        'style-14'
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'tabs_list_item_margin',
            [
                'label'     => esc_html__( 'Item Margin', 'biolife' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'selectors' => [
                    '{{WRAPPER}} .tab-item:not(:last-child)' => 'margin-inline-end: {{VALUE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'tabs_list_margin',
            [
                'label'     => esc_html__( 'Margin', 'biolife' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 0,
                'selectors' => [
                    '{{WRAPPER}} .tabs-head' => 'margin-bottom: {{VALUE}}px;',
                ],
            ]
        );

        $this->end_controls_section();
    }
}