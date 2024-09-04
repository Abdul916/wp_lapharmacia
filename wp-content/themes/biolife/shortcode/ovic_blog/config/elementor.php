<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Blog extends Ovic_Widget_Elementor
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
        return 'ovic_blog';
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
        return esc_html__( 'Blog', 'biolife' );
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
        return 'eicon-post-list';
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

        $this->add_control(
            'style',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => esc_html__( 'Select style', 'biolife' ),
                'options' => biolife_preview_options( $this->get_name() ),
                'default' => 'style-01',
            ]
        );

        $this->add_control(
            'deco',
            [
                'type'      => Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Image Decoration', 'biolife' ),
                'condition' => [
                    'style' => [
                        'style-09',
                        'style-10',
                        'style-11'
                    ]
                ],
            ]
        );

        $this->add_control(
            'image_width',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Image width', 'biolife' ),
                'default' => 370,
            ]
        );

        $this->add_control(
            'image_height',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Image height', 'biolife' ),
                'default' => 270,
            ]
        );

        $this->add_control(
            'image_full_size',
            [
                'type'  => Controls_Manager::SWITCHER,
                'label' => esc_html__( 'Image Full size', 'biolife' ),
            ]
        );

        $this->add_control(
            'target',
            [
                'label'   => esc_html__( 'Target', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'recent_post' => esc_html__( 'Latest', 'biolife' ),
                    'popularity'  => esc_html__( 'Popularity', 'biolife' ),
                    'date'        => esc_html__( 'Date', 'biolife' ),
                    'title'       => esc_html__( 'Title', 'biolife' ),
                    'post'        => esc_html__( 'Post', 'biolife' ),
                    'random'      => esc_html__( 'Random', 'biolife' ),
                ],
                'default' => 'recent_post',
            ]
        );

        if ( class_exists( 'ElementorPro\Modules\QueryControl\Module' ) ) {
            $this->add_control(
                'ids',
                [
                    'label'        => esc_html__( 'Search Post', 'biolife' ),
                    'type'         => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'options'      => [],
                    'label_block'  => true,
                    'multiple'     => true,
                    'autocomplete' => [
                        'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'post'
                        ],
                    ],
                    'condition'    => [
                        'target' => 'post'
                    ],
                    'export'       => false,
                ]
            );
        } else {
            $this->add_control(
                'ids',
                [
                    'label'       => esc_html__( 'Post', 'biolife' ),
                    'type'        => Controls_Manager::TEXT,
                    'description' => esc_html__( 'Post ids', 'biolife' ),
                    'placeholder' => '1,2,3',
                    'label_block' => true,
                    'condition'   => [
                        'target' => 'post'
                    ],
                ]
            );
        }

        $this->add_control(
            'category',
            [
                'label'       => esc_html__( 'Category', 'biolife' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_taxonomy( [
                    'meta_key'   => '',
                    'hide_empty' => true,
                ] ),
                'label_block' => true,
                'condition'   => [
                    'target!' => 'post'
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
                    'post__in'      => esc_html__( 'Post In', 'biolife' ),
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

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo ovic_do_shortcode( $this->get_name(), $settings );
    }
}