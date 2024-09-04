<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
// Theme version.
if (!defined('BIOLIFE')) {
    define('BIOLIFE', wp_get_theme()->get('Version'));
}
if (!function_exists('biolife_theme_setup')) {
    function biolife_theme_setup()
    {
        // Set the default content width.
        $GLOBALS['content_width'] = 1400;
        /*
         * Make theme available for translation.
         * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/blank
         * If you're building a theme based on Twenty Seventeen, use a find and replace
         * to change 'biolife' to the name of your theme in all the template files.
         */
        load_theme_textdomain('biolife', get_template_directory().'/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_theme_support('custom-background');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'widgets',
                'script',
                'style',
            )
        );
        remove_theme_support('widgets-block-editor');

        /*
		 * Enable support for Post Formats.
		 *
		 * See: https://wordpress.org/support/article/post-formats/
		 */
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'status',
                'audio',
                'chat',
            )
        );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
                'primary' => esc_html__('Primary Menu', 'biolife'),
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Support WooCommerce
        add_theme_support('woocommerce', apply_filters('biolife_woocommerce_args', array(
                'product_grid' => array(
                    'default_columns' => 3,
                    'default_rows'    => 4,
                    'min_columns'     => 2,
                    'max_columns'     => 6,
                    'min_rows'        => 1,
                ),
            )
        ));
        if (biolife_get_option('disable_zoom') != 1) {
            add_theme_support('wc-product-gallery-zoom');
        }
        if (biolife_get_option('disable_lightbox') != 1) {
            add_theme_support('wc-product-gallery-lightbox');
        }
        add_theme_support('wc-product-gallery-slider');

        // Add support for Block Styles.
        add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for editor styles.
        add_theme_support('editor-styles');

        // Add support for responsive embedded content.
        add_theme_support('responsive-embeds');

        // Add support for custom line height controls.
        add_theme_support('custom-line-height');

        // Add support for experimental link color control.
        add_theme_support('experimental-link-color');

        // Add support for experimental cover block spacing.
        add_theme_support('custom-spacing');
    }

    add_action('after_setup_theme', 'biolife_theme_setup');
}
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if (!function_exists('biolife_widgets_init')) {
    function biolife_widgets_init()
    {
        // Arguments used in all register_sidebar() calls.
        $shared_args = array(
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '<span class="arrow"></span></h2>',
        );

        $sidebars = array(
            'widget-area'         => array(
                'name'        => esc_html__('Widget Area', 'biolife'),
                'id'          => 'widget-area',
                'description' => esc_html__('Add widgets here to appear in your blog sidebar.', 'biolife'),
            ),
            'post-widget-area'    => array(
                'name'        => esc_html__('Post Widget Area', 'biolife'),
                'id'          => 'post-widget-area',
                'description' => esc_html__('Add widgets here to appear in your post sidebar.', 'biolife'),
            ),
            'shop-widget-area'    => array(
                'name'        => esc_html__('Shop Widget Area', 'biolife'),
                'id'          => 'shop-widget-area',
                'description' => esc_html__('Add widgets here to appear in your shop sidebar.', 'biolife'),
            ),
            'product-widget-area' => array(
                'name'        => esc_html__('Product Widget Area', 'biolife'),
                'id'          => 'product-widget-area',
                'description' => esc_html__('Add widgets here to appear in your Product sidebar.', 'biolife'),
            ),
        );

        $multi_sidebar = biolife_get_option('multi_sidebar');

        if (is_array($multi_sidebar) && !empty($multi_sidebar)) {
            foreach ($multi_sidebar as $sidebar) {
                if (!empty($sidebar)) {
                    $sidebar_id            = sanitize_key('custom-sidebar-'.$sidebar['add_sidebar']);
                    $sidebars[$sidebar_id] = array(
                        'name' => $sidebar['add_sidebar'],
                        'id'   => $sidebar_id,
                    );
                }
            }
        }

        foreach ($sidebars as $sidebar) {
            register_sidebar(
                array_merge($shared_args, $sidebar)
            );
        }
    }

    add_action('widgets_init', 'biolife_widgets_init');
}
/**
 * Custom Comment field.
 */
if (!function_exists('biolife_comment_field_to_bottom')) {
    function biolife_comment_field_to_bottom($fields)
    {
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        unset($fields['cookies']);
        $fields['comment'] = $comment_field;

        return $fields;
    }

    add_filter('comment_form_fields', 'biolife_comment_field_to_bottom');
}
/**
 * Custom Body Class.
 */
if (!function_exists('biolife_body_class')) {
    function biolife_body_class($classes)
    {
        $theme_version       = wp_get_theme()->get('Version');
        $page_main_container = biolife_theme_option_meta('_custom_page_side_options', null, 'page_main_container', '');
        $header              = biolife_get_header();
        $rtl_bg              = biolife_get_option('enable_ovic_rtl', 1);
        $sticky_menu         = biolife_get_option('sticky_menu', 'none');
        $sticky_sidebar      = biolife_get_option('sticky_sidebar');
        $product_thumbnail   = biolife_get_option('single_product_thumbnail', 'standard');
        $classes[]           = $page_main_container;
        $classes[]           = "biolife-{$theme_version}";
        $classes[]           = "header-{$header}";
        if (biolife_is_mobile()) {
            $layout    = biolife_get_option('mobile_layout', 'style-01');
            $classes[] = "biolife-mobile-{$layout}";
        } else {
            if ($sticky_menu != 'none') {
                $classes[] = 'has-header-sticky';
            }
            if ($sticky_sidebar == 1) {
                $classes[] = 'sticky-sidebar';
            }
        }
        if (is_rtl() && $rtl_bg == 1) {
            $classes[] = 'ovic-rtl';
        }
        if ($product_thumbnail == 'sticky') {
            $classes[] = "product-page-sticky";
        }

        return $classes;
    }

    add_filter('body_class', 'biolife_body_class');
}
/**
 * Hide title.
 */
if (!function_exists('biolife_check_hide_title')) {
    /**
     * Check hide title.
     *
     * @param  bool  $val  default value.
     *
     * @return bool
     */
    function biolife_check_hide_title($val)
    {
        if (defined('ELEMENTOR_VERSION')) {
            $current_doc = Elementor\Plugin::instance()->documents->get(get_the_ID());
            if ($current_doc && 'yes' === $current_doc->get_settings('hide_title')) {
                $val = false;
            }
        }

        return $val;
    }

    add_filter('biolife_page_title', 'biolife_check_hide_title');
}
/**
 * Wrapper function to deal with backwards compatibility.
 */
if (!function_exists('biolife_body_open')) {
    function biolife_body_open()
    {
        if (function_exists('wp_body_open')) {
            wp_body_open();
        } else {
            do_action('wp_body_open');
        }
    }
}
/**
 * Functions Mobile Detect.
 */
if (!class_exists('Mobile_Detect')) {
    require_once get_theme_file_path('/framework/classes/mobile-detect.php');
}
/**
 * Functions theme Colors convert.
 */
require_once get_theme_file_path('/framework/classes/colors.php');
/**
 * Functions theme helper.
 */
require_once get_theme_file_path('/framework/settings/helpers.php');
/**
 * Functions theme options.
 */
require_once get_theme_file_path('/framework/settings/options.php');
/**
 * Enqueue scripts and styles.
 */
require_once get_theme_file_path('/framework/settings/enqueue.php');
/**
 * Functions add inline style inline.
 */
require_once get_theme_file_path('framework/settings/color-patterns.php');
/**
 * Functions plugin load.
 */
require_once get_theme_file_path('/framework/settings/plugins-load.php');
/**
 * Functions theme AJAX.
 */
require_once get_theme_file_path('/framework/classes/core-ajax.php');
/**
 * Functions metabox options.
 */
require_once get_theme_file_path('/framework/settings/metabox.php');
/**
 * Functions theme.
 */
require_once get_theme_file_path('/framework/function-theme.php');
/**
 * Functions blog.
 */
require_once get_theme_file_path('/framework/function-blog.php');
/**
 * Functions WooCommerce.
 */
if (class_exists('WooCommerce')) {
    require_once get_theme_file_path('/framework/woocommerce/template-hook.php');
}