<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Products extends Ovic_Widget_Elementor
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
        return 'ovic_products';
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
        return esc_html__( 'Products', 'biolife' );
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

    protected function register_controls()
    {
        $this->start_controls_section(
            'general_section',
            array(
                'tab'   => Controls_Manager::TAB_CONTENT,
                'label' => esc_html__( 'General', 'biolife' ),
            )
        );

        $this->start_controls_tabs( 'tabs_general' );

        $this->start_controls_tab(
            'tab_general',
            [
                'label' => esc_html__( 'Settings', 'biolife' ),
            ]
        );

        $this->add_control(
            'list_style',
            array(
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'List style', 'biolife' ),
                'options' => [
                    'none' => esc_html__( 'None', 'biolife' ),
                    'grid' => esc_html__( 'Bootstrap', 'biolife' ),
                    'owl'  => esc_html__( 'Carousel', 'biolife' ),
                ],
                'default' => 'owl',
            )
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

        $this->add_control(
            'special_label',
            [
                'label'     => esc_html__( 'Special Label', 'biolife' ),
                'type'      => Controls_Manager::MEDIA,
                'condition' => [
                    'product_style' => 'style-14',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_products',
            [
                'label' => esc_html__( 'Products', 'biolife' ),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label'   => esc_html__( 'Pagination', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'none'      => esc_html__( 'None', 'biolife' ),
                    'view_all'  => esc_html__( 'View all', 'biolife' ),
                    'load_more' => esc_html__( 'Load More', 'biolife' ),
                    'infinite'  => esc_html__( 'Infinite Scrolling', 'biolife' ),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'link',
            [
                'type'        => Controls_Manager::URL,
                'label'       => esc_html__( 'Link', 'biolife' ),
                'placeholder' => esc_html__( 'https://your-link.com', 'biolife' ),
                'default'     => [
                    'url' => '#',
                ],
                'condition'   => [
                    'pagination' => 'view_all',
                ],
            ]
        );

        $this->add_control(
            'text_button',
            [
                'type'      => Controls_Manager::TEXT,
                'label'     => esc_html__( 'Text button', 'biolife' ),
                'default'   => 'VIEW ALL',
                'condition' => [
                    'pagination' => 'view_all',
                ],
            ]
        );

        $this->add_control(
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
            $this->add_control(
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
            $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
            'limit',
            [
                'label'       => esc_html__( 'Limit', 'biolife' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 6,
                'placeholder' => 6,
            ]
        );

        $this->add_control(
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

        $this->add_control(
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

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'head_section',
            array(
                'tab'       => Controls_Manager::TAB_CONTENT,
                'label'     => esc_html__( 'Head', 'biolife' ),
                'condition' => [
                    'product_style' => 'style-12',
                ],
            )
        );

        $this->add_control(
            'head_icon',
            [
                'label'            => esc_html__( 'Icon', 'biolife' ),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
            ]
        );

        $this->add_control(
            'head_title',
            [
                'label'       => esc_html__( 'Title', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'head_subtitle',
            [
                'label'       => esc_html__( 'Subtitle', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'head_button',
            [
                'label'       => esc_html__( 'Button', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'head_link',
            [
                'label' => esc_html__( 'Button Link', 'biolife' ),
                'type'  => Controls_Manager::URL,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_section',
            [
                'tab'       => Controls_Manager::TAB_SETTINGS,
                'label'     => esc_html__( 'Carousel settings', 'biolife' ),
                'condition' => [
                    'list_style' => 'owl',
                ],
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

        $this->bootstrap_settings( [
            'tab'       => Controls_Manager::TAB_SETTINGS,
            'label'     => esc_html__( 'Bootstrap settings', 'biolife' ),
            'condition' => [
                'list_style' => 'grid',
            ],
        ] );
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $settings['_id'] = substr( $this->get_id_int(), 0, 3 );

        echo ovic_do_shortcode( $this->get_name(), $settings );
    }
}