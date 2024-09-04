<?php if ( !defined( 'ABSPATH' ) ) {
    die;
} // Cannot access pages directly.
/*==========================================================================
METABOX BOX OPTIONS
===========================================================================*/
if ( !function_exists( 'biolife_metabox_options' ) && class_exists( 'OVIC_Metabox' ) ) {
    function biolife_metabox_options()
    {
        $vertical_menu = 'style-02,style-03,style-06,style-07,style-10,style-12,style-13,style-20';
        $sections      = array();
        // -----------------------------------------
        // Page Side Meta box Options              -
        // -----------------------------------------
        $sections[] = array(
            'id'             => '_custom_page_side_options',
            'title'          => esc_html__( 'Custom Page Side Options', 'biolife' ),
            'post_type'      => 'page',
            'context'        => 'side',
            'priority'       => 'high',
            'page_templates' => 'default',
            'sections'       => array(
                array(
                    'name'   => 'page_option',
                    'fields' => array(
                        array(
                            'id'    => 'page_head_bg',
                            'type'  => 'image',
                            'title' => esc_html__( 'Page Head Background', 'biolife' ),
                        ),
                        array(
                            'id'         => 'sidebar_page_layout',
                            'type'       => 'image_select',
                            'title'      => esc_html__( 'Single Page Sidebar Position', 'biolife' ),
                            'desc'       => esc_html__( 'Select sidebar position on Page.', 'biolife' ),
                            'options'    => array(
                                'left'  => get_theme_file_uri( 'assets/images/left-sidebar.png' ),
                                'right' => get_theme_file_uri( 'assets/images/right-sidebar.png' ),
                                'full'  => get_theme_file_uri( 'assets/images/no-sidebar.png' ),
                            ),
                            'default'    => 'left',
                            'attributes' => array(
                                'data-depend-id' => 'sidebar_page_layout',
                            ),
                        ),
                        array(
                            'id'         => 'page_sidebar',
                            'type'       => 'select',
                            'title'      => esc_html__( 'Page Sidebar', 'biolife' ),
                            'options'    => 'sidebars',
                            'dependency' => array( 'sidebar_page_layout', '!=', 'full' ),
                        ),
                        array(
                            'id'    => 'page_extra_class',
                            'type'  => 'text',
                            'title' => esc_html__( 'Extra Class', 'biolife' ),
                        ),
                    ),
                ),
            ),
        );
        // -----------------------------------------
        // Page Meta box Options                   -
        // -----------------------------------------
        $sections[] = array(
            'id'        => '_custom_metabox_theme_options',
            'title'     => esc_html__( 'Custom Theme Options', 'biolife' ),
            'post_type' => 'page',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => array(
                'options' => array(
                    'name'   => 'options',
                    'title'  => esc_html__( 'General', 'biolife' ),
                    'icon'   => 'fa fa-wordpress',
                    'fields' => array(
                        array(
                            'id'    => 'enable_metabox_options',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Enable Metabox Options', 'biolife' ),
                            'desc'  => esc_html__( 'If this option enable then this page will get setting in here, else this page will get setting in Theme Options', 'biolife' ),
                        ),
                        array(
                            'id'    => 'metabox_logo',
                            'type'  => 'image',
                            'title' => esc_html__( 'Logo', 'biolife' ),
                            'desc'  => esc_html__( 'Setting Logo For Site', 'biolife' ),
                        ),
                        array(
                            'id'      => 'metabox_default_color',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#222',
                            'title'   => esc_html__( 'Default Color', 'biolife' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#90bf2a',
                            'title'   => esc_html__( 'Main Color', 'biolife' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_t',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#fff',
                            'title'   => esc_html__( 'Main Color - Text Inside', 'biolife' ),
                            'desc'    => esc_html__( 'Text inside "Boxes has background main color" will has this color', 'biolife' ),
                        ),
                        array(
                            'id'      => 'metabox_main_color_2',
                            'type'    => 'color',
                            'rgba'    => true,
                            'default' => '#ffb71a',
                            'title'   => esc_html__( 'Main Color 2', 'biolife' ),
                        ),
                        array(
                            'id'      => 'metabox_main_container',
                            'type'    => 'slider',
                            'title'   => esc_html__( 'Main Container', 'biolife' ),
                            'min'     => 1140,
                            'max'     => 1920,
                            'step'    => 10,
                            'unit'    => esc_html__( 'px', 'biolife' ),
                            'default' => 1170,
                        ),
                        array(
                            'id'      => 'metabox_main_fw',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Main Font Weight', 'biolife' ),
                            'options' => array(
                                400 => esc_html__( 'Regular', 'biolife' ),
                                500 => esc_html__( 'Medium', 'biolife' ),
                                600 => esc_html__( 'Semi-bold', 'biolife' ),
                                700 => esc_html__( 'Bold', 'biolife' ),
                            ),
                            'default' => 600,
                        ),
                        array(
                            'id'      => 'metabox_main_tt',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Main Text Transform', 'biolife' ),
                            'options' => array(
                                'none'       => esc_html__( 'None', 'biolife' ),
                                'capitalize' => esc_html__( 'Capitalize', 'biolife' ),
                                'uppercase'  => esc_html__( 'Uppercase', 'biolife' ),
                            ),
                            'default' => 'uppercase',
                        ),
                        array(
                            'id'      => 'metabox_main_bora',
                            'type'    => 'number',
                            'title'   => esc_html__( 'Main Border Radius', 'biolife' ),
                            'min'     => 0,
                            'unit'    => esc_html__( 'px', 'biolife' ),
                            'default' => 90,
                        ),
                        array(
                            'id'             => 'body_typography',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Typography of Body', 'biolife' ),
                            'font_family'    => true,
                            'font_weight'    => true,
                            'font_style'     => true,
                            'subset'         => true,
                            'text_align'     => true,
                            'text_transform' => true,
                            'font_size'      => true,
                            'line_height'    => true,
                            'letter_spacing' => true,
                            'extra_styles'   => true,
                            'color'          => true,
                            'output'         => 'body',
                        ),
                        array(
                            'id'             => 'metabox_special_typography',
                            'type'           => 'typography',
                            'title'          => esc_html__( 'Typography of Special texts', 'biolife' ),
                            'font_family'    => true,
                            'font_weight'    => true,
                            'font_style'     => true,
                            'subset'         => false,
                            'text_align'     => false,
                            'text_transform' => false,
                            'font_size'      => false,
                            'line_height'    => false,
                            'letter_spacing' => false,
                            'extra_styles'   => true,
                            'color'          => false,
                            'output'         => '.main-special-font',
                        ),
                    ),
                ),
                'header'  => array(
                    'name'   => 'header',
                    'title'  => esc_html__( 'Header', 'biolife' ),
                    'icon'   => 'fa fa-folder-open-o',
                    'fields' => array(
                        array(
                            'id'         => 'metabox_header_template',
                            'type'       => 'select_preview',
                            'options'    => biolife_file_options( '/templates/header/', 'header' ),
                            'default'    => 'style-01',
                            'attributes' => array(
                                'data-depend-id' => 'metabox_header_template',
                            ),
                        ),
                        array(
                            'id'          => 'metabox_header_banner',
                            'type'        => 'select',
                            'options'     => 'page',
                            'chosen'      => true,
                            'ajax'        => true,
                            'placeholder' => esc_html__( 'None', 'biolife' ),
                            'title'       => esc_html__( 'Header Banner', 'biolife' ),
                            'desc'        => esc_html__( 'Get banner on header from page builder', 'biolife' ),
                        ),
                        array(
                            'id'         => 'metabox_header_background',
                            'type'       => 'image',
                            'title'      => esc_html__( 'Header Background', 'biolife' ),
                            'dependency' => array( 'metabox_header_template', 'any', 'style-07,style-13' ),
                        ),
                        array(
                            'id'          => 'metabox_primary_menu',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Primary Menu', 'biolife' ),
                            'desc'        => esc_html__( 'default is Display location on Menu panel: "Primary Menu"', 'biolife' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'biolife' ),
                        ),
                        array(
                            'id'          => 'metabox_header_submenu',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Header Submenu', 'biolife' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'biolife' ),
                        ),
                        array(
                            'id'          => 'metabox_header_submenu_2',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Header Submenu 2', 'biolife' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'biolife' ),
                        ),
                        array(
                            'id'          => 'metabox_header_submenu_3',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Header Submenu 3', 'biolife' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'biolife' ),
                            'dependency'  => array( 'metabox_header_template', 'any', 'style-10' ),
                        ),
                        array(
                            'id'      => 'metabox_social_menu',
                            'type'    => 'switcher',
                            'title'   => esc_html__( 'Header Social', 'biolife' ),
                            'default' => 1,
                        ),
                        array(
                            'id'         => 'metabox_header_message',
                            'type'       => 'text',
                            'title'      => esc_html__( 'Header Message', 'biolife' ),
                            'dependency' => array( 'metabox_header_template', 'any', 'style-12,style-18,style-19,style-99' ),
                        ),
                        array(
                            'id'              => 'metabox_header_info',
                            'type'            => 'group',
                            'max'             => 2,
                            'title'           => esc_html__( 'Header Info', 'biolife' ),
                            'button_title'    => esc_html__( 'Add item', 'biolife' ),
                            'accordion_title' => esc_html__( 'Add New item', 'biolife' ),
                            'fields'          => array(
                                array(
                                    'id'    => 'info_title',
                                    'type'  => 'text',
                                    'title' => esc_html__( 'Title', 'biolife' ),
                                ),
                                array(
                                    'id'    => 'info_subtitle',
                                    'type'  => 'text',
                                    'title' => esc_html__( 'Subtitle', 'biolife' ),
                                ),
                                array(
                                    'id'    => 'info_link',
                                    'type'  => 'text',
                                    'title' => esc_html__( 'Link', 'biolife' ),
                                ),
                                array(
                                    'id'    => 'info_icon',
                                    'type'  => 'icon',
                                    'title' => esc_html__( 'Icon', 'biolife' ),
                                ),
                            ),
                            'dependency'      => array( 'metabox_header_template', 'any', 'style-02,style-07,style-11,style-17,style-20' ),
                        ),
                        array(
                            'id'          => 'metabox_vertical_menu',
                            'type'        => 'select',
                            'title'       => esc_html__( 'Vertical Menu', 'biolife' ),
                            'options'     => 'menus',
                            'chosen'      => true,
                            'ajax'        => true,
                            'query_args'  => array(
                                'data-slug' => true,
                            ),
                            'placeholder' => esc_html__( 'None', 'biolife' ),
                            'dependency'  => array( 'metabox_header_template', 'any', $vertical_menu, true ),
                        ),
                        array(
                            'id'         => 'metabox_vertical_title',
                            'type'       => 'text',
                            'title'      => esc_html__( 'Vertical Title', 'biolife' ),
                            'default'    => esc_html__( 'All Departments', 'biolife' ),
                            'dependency' => array( 'metabox_header_template', 'any', $vertical_menu, true ),
                        ),
                        array(
                            'id'         => 'metabox_vertical_items',
                            'type'       => 'number',
                            'unit'       => 'items',
                            'default'    => 11,
                            'title'      => esc_html__( 'Vertical Items', 'biolife' ),
                            'dependency' => array( 'metabox_header_template', 'any', $vertical_menu, true ),
                        ),
                        array(
                            'id'         => 'metabox_vertical_show_more',
                            'type'       => 'text',
                            'title'      => esc_html__( 'Vertical Button Show More', 'biolife' ),
                            'default'    => esc_html__( 'Show More', 'biolife' ),
                            'dependency' => array( 'metabox_header_template', 'any', $vertical_menu, true ),
                        ),
                        array(
                            'id'         => 'metabox_vertical_show_less',
                            'type'       => 'text',
                            'title'      => esc_html__( 'Vertical Button Show Less', 'biolife' ),
                            'default'    => esc_html__( 'Show Less', 'biolife' ),
                            'dependency' => array( 'metabox_header_template', 'any', $vertical_menu, true ),
                        ),
                    ),
                ),
                'footer'  => array(
                    'name'   => 'footer',
                    'title'  => esc_html__( 'Footer', 'biolife' ),
                    'icon'   => 'fa fa-folder-open-o',
                    'fields' => array(
                        array(
                            'id'      => 'metabox_footer_template',
                            'type'    => 'select_preview',
                            'default' => 'footer-01',
                            'options' => biolife_footer_preview(),
                        ),
                    ),
                ),
            ),
        );
        // -----------------------------------------
        // Post Meta box Options                   -
        // -----------------------------------------
        $sections[] = array(
            'id'        => '_custom_metabox_post_options',
            'title'     => esc_html__( 'Post Meta', 'biolife' ),
            'post_type' => 'post',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => array(
                array(
                    'name'   => 'post_options',
                    'icon'   => 'fa fa-picture-o',
                    'fields' => array(
                        array(
                            'id'    => 'post_formats',
                            'type'  => 'tabbed',
                            'title' => esc_html__( 'Post formats', 'biolife' ),
                            'desc'  => esc_html__( 'The data post formats', 'biolife' ),
                            'tabs'  => array(
                                array(
                                    'title'  => esc_html__( 'Quote', 'biolife' ),
                                    'fields' => array(
                                        array(
                                            'id'         => 'quote',
                                            'type'       => 'text',
                                            'title'      => esc_html__( 'Quote Text', 'biolife' ),
                                            'attributes' => array(
                                                'style' => 'width:100%',
                                            ),
                                        ),
                                    ),
                                ),
                                array(
                                    'title'  => esc_html__( 'Gallery', 'biolife' ),
                                    'fields' => array(
                                        array(
                                            'id'    => 'gallery',
                                            'type'  => 'gallery',
                                            'title' => esc_html__( 'Gallery source', 'biolife' ),
                                        ),
                                    ),
                                ),
                                array(
                                    'title'  => esc_html__( 'Video', 'biolife' ),
                                    'fields' => array(
                                        array(
                                            'id'      => 'video',
                                            'type'    => 'upload',
                                            'library' => 'video',
                                            'title'   => esc_html__( 'Video source', 'biolife' ),
                                        ),
                                    ),
                                ),
                                array(
                                    'title'  => esc_html__( 'Audio', 'biolife' ),
                                    'fields' => array(
                                        array(
                                            'id'      => 'audio',
                                            'type'    => 'upload',
                                            'title'   => esc_html__( 'Audio source', 'biolife' ),
                                            'library' => 'audio',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),

            ),
        );
        // -----------------------------------------
        // Product Meta box Options                -
        // -----------------------------------------
        if ( class_exists( 'WooCommerce' ) ) {
            $sections[] = array(
                'id'        => '_custom_metabox_product_options',
                'title'     => esc_html__( 'Custom contents', 'biolife' ),
                'post_type' => 'product',
                'context'   => 'normal',
                'priority'  => 'low',
                'sections'  => array(
                    'custom_contents' => array(
                        'name'   => 'custom_contents',
                        'icon'   => 'fa fa-picture-o',
                        'fields' => array(
                            array(
                                'id'    => 'poster',
                                'type'  => 'image',
                                'title' => esc_html__( 'Poster Video', 'biolife' ),
                            ),
                            array(
                                'id'    => 'video',
                                'type'  => 'text',
                                'title' => esc_html__( 'Video Url', 'biolife' ),
                            ),
                            array(
                                'id'    => 'gallery',
                                'type'  => 'gallery',
                                'title' => esc_html__( '360 Degree', 'biolife' ),
                            ),
                            'short_info'     => array(
                                'id'    => 'short_info',
                                'type'  => 'wp_editor',
                                'title' => esc_html__( 'Product short info', 'biolife' ),
                            ),
                            array(
                                'id'           => 'delivery_info',
                                'type'         => 'group',
                                'title'        => esc_html__( 'Delivery Information', 'biolife' ),
                                'button_title' => esc_html__( 'Add New', 'biolife' ),
                                'fields'       => array(
                                    array(
                                        'id'    => 'text',
                                        'type'  => 'textarea',
                                        'title' => esc_html__( 'Text', 'biolife' ),
                                    ),
                                    array(
                                        'id'    => 'icon',
                                        'type'  => 'icon',
                                        'title' => esc_html__( 'Icon', 'biolife' ),
                                    ),
                                ),
                                'dependency'   => array( 'enable_product_info', '==', 1 ),
                            ),
                            'custom_content' => array(
                                'id'           => 'custom_content',
                                'type'         => 'group',
                                'title'        => esc_html__( 'Custom Contents', 'biolife' ),
                                'button_title' => esc_html__( 'Add New', 'biolife' ),
                                'fields'       => array(
                                    array(
                                        'id'    => 'label',
                                        'type'  => 'text',
                                        'title' => esc_html__( 'Label', 'biolife' ),
                                    ),
                                    array(
                                        'id'    => 'content',
                                        'type'  => 'textarea',
                                        'title' => esc_html__( 'Content', 'biolife' ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            );
        }

        OVIC_Metabox::instance( apply_filters( 'biolife_framework_metabox_options', $sections ) );
    }

    add_action( 'init', 'biolife_metabox_options' );
}