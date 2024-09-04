<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Category extends Ovic_Widget_Elementor
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
        return 'ovic_category';
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
        return esc_html__( 'Category', 'biolife' );
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
        return 'eicon-product-categories';
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
            'category',
            [
                'label'       => esc_html__( 'Products Category', 'biolife' ),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $this->get_taxonomy( [
                    'hide_empty' => false,
                    'taxonomy'   => 'product_cat',
                ] ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Title', 'biolife' ),
                'description' => esc_html__( 'Default is Category Name', 'biolife' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'type'        => Controls_Manager::MEDIA,
                'label'       => esc_html__( 'Image', 'biolife' ),
                'description' => esc_html__( 'Default is Category Thumbnail', 'biolife' ),
            ]
        );

        $this->add_control(
            'background',
            [
                'label'     => esc_html__( 'Background', 'biolife' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .link' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => [
                        'style-04',
                        'style-07'
                    ]
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Height', 'biolife' ),
                'selectors' => [
                    '{{WRAPPER}} .thumb img' => 'height: {{VALUE}}px;',
                ],
                'condition' => [
                    'style' => [
                        'style-05',
                        'style-06',
                        'style-07'
                    ]
                ],
            ]
        );

        $this->add_control(
            'count',
            [
                'type'    => Controls_Manager::SWITCHER,
                'label'   => esc_html__( 'Count', 'biolife' ),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'image_hover',
            [
                'type'      => Controls_Manager::MEDIA,
                'label'     => esc_html__( 'Image Hover', 'biolife' ),
                'condition' => [
                    'style' => 'style-04'
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--cate-image-hover: url({{URL}});',
                ],
            ]
        );

        $this->add_control(
            'image_effect',
            [
                'type'      => Controls_Manager::SELECT,
                'label'     => esc_html__( 'Hover', 'biolife' ),
                'options'   => biolife_effect_style(),
                'default'   => '',
                'condition' => [
                    'style!' => 'style-04'
                ],
            ]
        );

        $this->end_controls_section();
    }
}