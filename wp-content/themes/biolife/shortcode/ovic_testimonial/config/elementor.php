<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;

class Elementor_Ovic_Testimonial extends Ovic_Widget_Elementor
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
        return 'ovic_testimonial';
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
        return esc_html__( 'Testimonial', 'biolife' );
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
        return 'eicon-testimonial';
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
            'color',
            [
                'label'     => esc_html__( 'Color', 'biolife' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'lighter',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Lighter', 'biolife' ),
                'prefix_class' => 'lighter-',
                'condition'    => [
                    'style' => [
                        'style-02'
                    ],
                ],
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->add_control(
            'avatar',
            [
                'label'   => esc_html__( 'Avatar', 'biolife' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label'   => esc_html__( 'Rating', 'biolife' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'No Star', 'biolife' ),
                    1  => esc_html__( '1 Star', 'biolife' ),
                    2  => esc_html__( '2 Star', 'biolife' ),
                    3  => esc_html__( '3 Star', 'biolife' ),
                    4  => esc_html__( '4 Star', 'biolife' ),
                    5  => esc_html__( '5 Star', 'biolife' ),
                ],
                'default' => 5,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label'       => esc_html__( 'Name', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'posi',
            [
                'label'       => esc_html__( 'Position', 'biolife' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label'       => esc_html__( 'Description', 'biolife' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__( 'Link', 'biolife' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }
}