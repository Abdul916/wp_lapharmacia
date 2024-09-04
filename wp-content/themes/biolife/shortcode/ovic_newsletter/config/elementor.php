<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

use Elementor\Core\Schemes;
use Elementor\Controls_Manager as Controls_Manager;
use Elementor\Group_Control_Border;

class Elementor_Ovic_Newsletter extends Ovic_Widget_Elementor
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
        return 'ovic_newsletter';
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
        return esc_html__( 'Newsletter', 'biolife' );
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
        return 'eicon-yoast';
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
            'selected_media',
            [
                'label'     => esc_html__( 'Media', 'biolife' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'image' => esc_html__( 'Image', 'biolife' ),
                    'icon'  => esc_html__( 'Icon', 'biolife' ),
                ],
                'default'   => 'image',
                'condition' => [
                    'style' => [
                        'style-03',
                        'style-04',
                        'style-08',
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
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
                    'selected_media' => 'icon',
                    'style' => [
                        'style-03',
                        'style-04',
                        'style-08',
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'selected_image',
            [
                'label'     => esc_html__( 'Image', 'biolife' ),
                'type'      => Controls_Manager::MEDIA,
                'condition' => [
                    'selected_media' => 'image',
                    'style' => [
                        'style-03',
                        'style-04',
                        'style-08',
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Title', 'biolife' ),
                'label_block' => true,
                'condition'   => [
                    'style' => [
                        'style-03',
                        'style-04',
                        'style-08',
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Subtitle', 'biolife' ),
                'label_block' => true,
                'condition'   => [
                    'style' => [
                        'style-03',
                        'style-04',
                        'style-08',
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'form_id',
            [
                'type'        => Controls_Manager::SELECT,
                'label'       => esc_html__( 'Newsletter Form', 'biolife' ),
                'options'     => biolife_get_form_newsletter(),
                'default'     => '0',
                'description' => sprintf( '%s <a href="%s" target="_blank">%s</a>',
                    esc_html__( 'Add new form', 'biolife' ),
                    admin_url( 'admin.php?page=mailchimp-for-wp-forms&view=add-form' ),
                    esc_html__( 'Here!', 'biolife' )
                ),
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Input Placeholder', 'biolife' ),
                'default'     => esc_html__( 'Enter your email address...', 'biolife' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button',
            [
                'type'        => Controls_Manager::TEXT,
                'label'       => esc_html__( 'Button', 'biolife' ),
                'default'     => esc_html__( 'Sign Up', 'biolife' ),
                'label_block' => true,
                'condition'   => [
                    'style' => [
                        'style-01',
                        'style-02',
                        'style-06',
                        'style-08',
                        'style-09',
                        'style-10'
                    ],
                ],
            ]
        );

        $this->add_control(
            'has_border',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Has Border', 'biolife' ),
                'prefix_class' => 'border-',
                'condition'    => [
                    'style' => [
                        'style-01',
                        'style-02'
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo ovic_do_shortcode( $this->get_name(), $settings );
    }
}