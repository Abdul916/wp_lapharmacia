<?php
/**
 * Handle frontend scripts
 *
 * @package Biolife/Classes
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Frontend scripts class.
 */
if (!class_exists('Biolife_Assets')) {
    class Biolife_Assets
    {
        /**
         * Contains an array of script handles registered by Biolife.
         *
         * @var array
         */
        private static $scripts = array();
        /**
         * Contains an array of script handles registered by Biolife.
         *
         * @var array
         */
        private static $styles = array();
        /**
         * Contains an array of script handles localized by Biolife.
         *
         * @var array
         */
        private static $suffix              = '';
        private static $wp_localize_scripts = array();

        /**
         * Hook in methods.
         */
        public static function init()
        {
            /* check for developer mode */
            self::$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

            add_action('wp_enqueue_scripts', array(__CLASS__, 'load_scripts'), 30);
            add_action('admin_enqueue_scripts', array(__CLASS__, 'admin_scripts'));
            add_action('wp_print_scripts', array(__CLASS__, 'localize_printed_scripts'), 5);
            add_action('wp_print_footer_scripts', array(__CLASS__, 'localize_printed_scripts'), 5);
            add_action('wp_head', array(__CLASS__, 'google_fonts'), 30);

            // Elementor scripts
            add_action('elementor/editor/after_enqueue_scripts', array(__CLASS__, 'enqueue_scripts'));
        }

        /**
         * Get google fonts.
         */
        public static function google_fonts()
        {
            $locale        = get_locale();
            $fonts_url     = 'https://fonts.googleapis.com/css2';
            $subsets       = [
                'ru_RU' => 'cyrillic',
                'bg_BG' => 'cyrillic',
                'he_IL' => 'hebrew',
                'el'    => 'greek',
                'vi'    => 'vietnamese',
                'uk'    => 'cyrillic',
                'cs_CZ' => 'latin-ext',
                'ro_RO' => 'latin-ext',
                'pl_PL' => 'latin-ext',
                'hr_HR' => 'latin-ext',
                'hu_HU' => 'latin-ext',
                'sk_SK' => 'latin-ext',
                'tr_TR' => 'latin-ext',
                'lt_LT' => 'latin-ext',
            ];
            $font_families = array(
                'Cairo:wght@300;400;600;700',
            );

            foreach ($font_families as $key => $font_family) {
                $semi      = ($key == 0) ? '?' : '&';
                $fonts_url .= $semi.'family='.$font_family;
            }

            $fonts_url .= '&display=swap';

            if (isset($subsets[$locale])) {
                $fonts_url .= '&subset='.$subsets[$locale];
            }

            echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
            echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
            echo '<link href="'.esc_url_raw(apply_filters('biolife_google_font_url', $fonts_url)).'" rel="stylesheet">';
        }

        /**
         * Get styles for the frontend.
         *
         * @return array
         */
        public static function get_styles()
        {
            $styles                    = array(
                'animate-css' => array(
                    'src'     => get_theme_file_uri('/assets/css/animate.min.css'),
                    'deps'    => array(),
                    'version' => '3.7.0',
                    'media'   => 'all',
                    'has_rtl' => false,
                ),
                'chosen'      => array(
                    'src'     => get_theme_file_uri('/assets/vendor/chosen/chosen.min.css'),
                    'deps'    => array(),
                    'version' => '1.8.7',
                    'media'   => 'all',
                    'has_rtl' => false,
                ),
                'slick'       => array(
                    'src'     => get_theme_file_uri('/assets/vendor/slick/slick.min.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'media'   => 'all',
                    'has_rtl' => false,
                ),
            );
            $styles['biolife_default'] = array(
                'src'     => get_theme_file_uri('/assets/css/default.css'),
                'deps'    => array(),
                'version' => BIOLIFE,
                'media'   => 'all',
                'has_rtl' => false,
            );
            if (class_exists('WeDevs_Dokan')) {
                $styles['biolife-dokan'] = array(
                    'src'     => get_theme_file_uri('/assets/css/vendor/dokan'.self::$suffix.'.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'media'   => 'all',
                    'has_rtl' => false,
                );
            }
            if (class_exists('WCFM')) {
                $styles['biolife-wcfm'] = array(
                    'src'     => get_theme_file_uri('/assets/css/vendor/wcfm'.self::$suffix.'.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'media'   => 'all',
                    'has_rtl' => false,
                );
            }
            if (class_exists('WCMp')) {
                $styles['biolife-marketplace'] = array(
                    'src'     => get_theme_file_uri('/assets/css/vendor/marketplace'.self::$suffix.'.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'media'   => 'all',
                    'has_rtl' => false,
                );
            }
            /* FBTFW */
            if (class_exists('FBTFW')) {
                $styles['biolife-fbtfw'] = array(
                    'src'     => get_theme_file_uri('/assets/vendor/fbtfw/fbtfw'.self::$suffix.'.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'media'   => 'all',
                    'has_rtl' => false,
                );
            }
            /* STYLE MAIN */
            $styles['biolife'] = array(
                'src'     => get_theme_file_uri('/assets/css/style.css'),
                'deps'    => array('font-awesome', 'main-icon'),
                'version' => time(),
                'media'   => 'all',
                'has_rtl' => true,
            );
            if (biolife_is_mobile()) {
                $styles['biolife_mobile_version'] = array(
                    'src'     => get_theme_file_uri('/assets/css/style-mobile'.self::$suffix.'.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'media'   => 'all',
                    'has_rtl' => false,
                );
            }
            $styles['biolife-main'] = array(
                'src'     => get_stylesheet_uri(),
                'deps'    => array(),
                'version' => time(),
                'media'   => 'all',
                'has_rtl' => false,
            );

            return apply_filters('biolife_enqueue_styles', $styles);
        }

        /**
         * Register a script for use.
         *
         * @param  string  $handle  Name of the script. Should be unique.
         * @param  string  $path  Full URL of the script, or path of the script relative to the WordPress root directory.
         * @param  string[]  $deps  An array of registered script handles this script depends on.
         * @param  array|false|string  $version  String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
         * @param  boolean  $in_footer  Whether to enqueue the script before </body> instead of in the <head>. Default 'false'.
         *
         * @uses   wp_register_script()
         */
        private static function register_script($handle, $path, $deps = array('jquery'), $version = BIOLIFE, $in_footer = true)
        {
            self::$scripts[] = $handle;
            wp_register_script($handle, $path, $deps, $version, $in_footer);
        }

        /**
         * Register and enqueue a script for use.
         *
         * @param  string  $handle  Name of the script. Should be unique.
         * @param  string  $path  Full URL of the script, or path of the script relative to the WordPress root directory.
         * @param  string[]  $deps  An array of registered script handles this script depends on.
         * @param  array|false|string  $version  String specifying script version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
         * @param  boolean  $in_footer  Whether to enqueue the script before </body> instead of in the <head>. Default 'false'.
         *
         * @uses   wp_enqueue_script()
         */
        private static function enqueue_script($handle, $path = '', $deps = array('jquery'), $version = BIOLIFE, $in_footer = true)
        {
            if (!in_array($handle, self::$scripts, true) && $path) {
                self::register_script($handle, $path, $deps, $version, $in_footer);
            }
            wp_enqueue_script($handle);
        }

        /**
         * Register a style for use.
         *
         * @param  string  $handle  Name of the stylesheet. Should be unique.
         * @param  string  $path  Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
         * @param  string[]  $deps  An array of registered stylesheet handles this stylesheet depends on.
         * @param  array|false|string  $version  String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
         * @param  string  $media  The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
         * @param  boolean  $has_rtl  If has RTL version to load too.
         *
         * @uses   wp_register_style()
         */
        private static function register_style($handle, $path, $deps = array(), $version = BIOLIFE, $media = 'all', $has_rtl = false)
        {
            self::$styles[] = $handle;
            wp_register_style($handle, $path, $deps, $version, $media);
            if ($has_rtl) {
                wp_style_add_data($handle, 'rtl', 'replace');
                if (self::$suffix != '') {
                    wp_style_add_data($handle, 'suffix', self::$suffix);
                }
            }
        }

        /**
         * Register and enqueue a styles for use.
         *
         * @param  string  $handle  Name of the stylesheet. Should be unique.
         * @param  string  $path  Full URL of the stylesheet, or path of the stylesheet relative to the WordPress root directory.
         * @param  string[]  $deps  An array of registered stylesheet handles this stylesheet depends on.
         * @param  array|false|string  $version  String specifying stylesheet version number, if it has one, which is added to the URL as a query string for cache busting purposes. If version is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.
         * @param  string  $media  The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
         * @param  boolean  $has_rtl  If has RTL version to load too.
         *
         * @uses   wp_enqueue_style()
         */
        private static function enqueue_style($handle, $path = '', $deps = array(), $version = BIOLIFE, $media = 'all', $has_rtl = false)
        {
            if (!in_array($handle, self::$styles, true) && $path) {
                self::register_style($handle, $path, $deps, $version, $media, $has_rtl);
            }
            wp_enqueue_style($handle);
        }

        /**
         * Register all Biolife scripts.
         */
        private static function register_scripts()
        {
            $deps = array(
                'jquery',
                'chosen',
                'slick',
                'biolife-tooltip',
            );
            if (class_exists('Elementor\Plugin') && Elementor\Plugin::$instance->preview->is_preview_mode()) {
                $deps[] = 'biolife-countdown';
            }
            $register_scripts = array(
                'biolife'           => array(
                    'src'     => get_theme_file_uri('/assets/js/frontend'.self::$suffix.'.js'),
                    'deps'    => $deps,
                    'version' => BIOLIFE,
                ),
                'biolife-sticky'    => array(
                    'src'     => get_theme_file_uri('/assets/js/sticky'.self::$suffix.'.js'),
                    'deps'    => array('jquery'),
                    'version' => BIOLIFE,
                ),
                'mobile-menu'       => array(
                    'src'     => get_theme_file_uri('/assets/vendor/mobile-menu/mobile-menu.min.js'),
                    'deps'    => array('jquery'),
                    'version' => BIOLIFE,
                ),
                'biolife-admin'     => array(
                    'src'     => get_theme_file_uri('/assets/js/admin.min.js'),
                    'deps'    => array('jquery'),
                    'version' => BIOLIFE,
                ),
                'biolife-tooltip'   => array(
                    'src'     => get_theme_file_uri('/assets/vendor/tooltip/tooltip.min.js'),
                    'deps'    => array('jquery'),
                    'version' => BIOLIFE,
                ),
                /* https://harvesthq.github.io/chosen/ */
                'chosen'            => array(
                    'src'     => get_theme_file_uri('/assets/vendor/chosen/chosen.min.js'),
                    'deps'    => array('jquery'),
                    'version' => '1.8.7',
                ),
                /* http://hilios.github.io/jQuery.countdown/documentation.html */
                'countdown'         => array(
                    'src'     => get_theme_file_uri('/assets/vendor/countdown/countdown.min.js'),
                    'deps'    => array('jquery'),
                    'version' => '2.2.0',
                ),
                'biolife-countdown' => array(
                    'src'     => get_theme_file_uri('/assets/js/countdown'.self::$suffix.'.js'),
                    'deps'    => array('countdown'),
                    'version' => BIOLIFE,
                ),
                /* http://kenwheeler.github.io/slick/ */
                'slick'             => array(
                    'src'     => get_theme_file_uri('/assets/vendor/slick/slick.min.js'),
                    'deps'    => array('jquery'),
                    'version' => BIOLIFE,
                ),
                /* https://github.com/gromo/jquery.scrollbar/ */
                'scrollbar'         => array(
                    'src'     => get_theme_file_uri('/assets/vendor/scrollbar/scrollbar.min.js'),
                    'deps'    => array('jquery'),
                    'version' => '0.2.10',
                ),
                /* http://dimsemenov.com/plugins/magnific-popup/ */
                'magnific-popup'    => array(
                    'src'     => get_theme_file_uri('/assets/vendor/magnific-popup/magnific-popup.min.js'),
                    'deps'    => array('jquery'),
                    'version' => '1.1.0',
                ),
            );
            foreach ($register_scripts as $name => $props) {
                self::register_script($name, $props['src'], $props['deps'], $props['version']);
            }
        }

        /**
         * Register all Biolife styles.
         */
        private static function register_styles()
        {
            $register_styles = array(
                'biolife-admin'     => array(
                    'src'     => get_theme_file_uri('/assets/css/admin.min.css'),
                    'deps'    => array('font-awesome', 'main-icon'),
                    'version' => BIOLIFE,
                    'has_rtl' => false,
                ),
                'biolife-edit-post' => array(
                    'src'     => get_theme_file_uri('/assets/css/edit-post.min.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'has_rtl' => false,
                ),
                'font-awesome'      => array(
                    'src'     => get_theme_file_uri('/assets/css/fontawesome.min.css'),
                    'deps'    => array(),
                    'version' => '4.7.0',
                    'has_rtl' => false,
                ),
                'main-icon'         => array(
                    'src'     => get_theme_file_uri('/assets/vendor/main-icon/style'.self::$suffix.'.css'),
                    'deps'    => array(),
                    'version' => '1.0.0',
                    'has_rtl' => false,
                ),
                'scrollbar'         => array(
                    'src'     => get_theme_file_uri('/assets/vendor/scrollbar/scrollbar.min.css'),
                    'deps'    => array(),
                    'version' => '0.2.10',
                    'has_rtl' => false,
                ),
                'magnific-effect'   => array(
                    'src'     => get_theme_file_uri('/assets/vendor/magnific-popup/magnific-effect.css'),
                    'deps'    => array(),
                    'version' => '1.1.0',
                    'has_rtl' => false,
                ),
                'magnific-popup'    => array(
                    'src'     => get_theme_file_uri('/assets/vendor/magnific-popup/magnific-popup.min.css'),
                    'deps'    => array('magnific-effect'),
                    'version' => '1.1.0',
                    'has_rtl' => false,
                ),
                'mobile-menu'       => array(
                    'src'     => get_theme_file_uri('/assets/vendor/mobile-menu/mobile-menu.min.css'),
                    'deps'    => array(),
                    'version' => BIOLIFE,
                    'has_rtl' => false,
                ),
            );
            foreach ($register_styles as $name => $props) {
                self::register_style($name, $props['src'], $props['deps'], $props['version'], 'all', $props['has_rtl']);
            }
        }

        /**
         * Register/queue backend scripts.
         */
        public static function admin_scripts($hook_suffix)
        {
            self::register_scripts();
            self::register_styles();
            // Styles.
            if (($hook_suffix === 'post-new.php' || $hook_suffix === 'post.php')) {
                self::enqueue_style('biolife-edit-post');
            }
            self::enqueue_style('biolife-admin');
            // Script.
            self::enqueue_script('biolife-admin');
        }

        public static function enqueue_scripts()
        {
            self::register_styles();
            self::enqueue_style('main-icon');
        }

        /**
         * Register/queue frontend scripts.
         */
        public static function load_scripts()
        {
            $comment = false;

            self::register_scripts();
            self::register_styles();
            // Global frontend scripts.
            if (!class_exists('Ovic_Addon_Toolkit')) {
                self::enqueue_style('mobile-menu');
                self::enqueue_script('mobile-menu');
            }
            if (!biolife_is_mobile()) {
                self::enqueue_style('scrollbar');
                self::enqueue_script('scrollbar');
            }
            if (is_singular() && comments_open() && get_option('thread_comments')) {
                $comment = true;
            }
            if (function_exists('is_product') && is_product()) {
                $comment = false;
            }
            if ($comment) {
                wp_enqueue_script('comment-reply');
            }
            self::enqueue_script('biolife');

            // Add inline script
            $ace_script = biolife_get_option('ace_script');
            if (!empty($ace_script)) {
                wp_add_inline_script('biolife', $ace_script);
            }

            // CSS Styles.
            $enqueue_styles = self::get_styles();

            if (!empty($enqueue_styles)) {
                foreach ($enqueue_styles as $handle => $args) {
                    if (!isset($args['has_rtl'])) {
                        $args['has_rtl'] = false;
                    }
                    self::enqueue_style($handle, $args['src'], $args['deps'], $args['version'], $args['media'], $args['has_rtl']);
                }
            }

            if (biolife_edited_by_gutenberg()) {
                wp_dequeue_style('wp-block-library');
                wp_dequeue_style('wp-block-library-theme');
                wp_dequeue_style('wc-block-style');
                wp_dequeue_style('wc-block-vendors-style');
            }
        }

        /**
         * Localize a Biolife script once.
         *
         * @since 2.3.0 this needs less wp_script_is() calls due to https://core.trac.wordpress.org/ticket/28404 being added in WP 4.0.
         *
         * @param  string  $handle  Script handle the data will be attached to.
         */
        private static function localize_script($handle)
        {
            if (!in_array($handle, self::$wp_localize_scripts, true) && wp_script_is($handle)) {
                $data = self::get_script_data($handle);
                if (!$data) {
                    return;
                }
                $name                        = str_replace('-', '_', $handle).'_params';
                self::$wp_localize_scripts[] = $handle;
                wp_localize_script($handle, $name, apply_filters($name, $data));
            }
        }

        /**
         * Return data for script handles.
         *
         * @param  string  $handle  Script handle the data will be attached to.
         *
         * @return array|bool
         */
        private static function get_script_data($handle)
        {
            switch ($handle) {
                case 'biolife':
                    $params = array(
                        'ajaxurl'          => admin_url('admin-ajax.php'),
                        'security'         => wp_create_nonce('biolife_ajax_frontend'),
                        'biolife_ajax_url' => Biolife_Ajax::get_endpoint('%%endpoint%%'),
                        'ajax_comment'     => biolife_get_option('enable_ajax_comment'),
                        'tab_warning'      => sprintf('<strong>%s</strong> %s',
                            esc_html__('Warning!', 'biolife'),
                            esc_html__('Can not Load Data.', 'biolife')
                        ),
                        'is_mobile'        => (bool) biolife_is_mobile(),
                        'is_preview'       => class_exists('OVIC_CORE') ? OVIC_CORE()->is_elementor_editor() : false,
                        'sticky_menu'      => biolife_get_option('sticky_menu', 'none'),
                        'disable_equal'    => (bool) biolife_get_option('disable_equal'),
                    );
                    break;
                case 'biolife-admin':
                    $params = array(
                        'security' => wp_create_nonce('biolife_ajax_admin'),
                    );
                    break;
                default:
                    $params = false;
            }

            return apply_filters('biolife_get_script_data', $params, $handle);
        }

        /**
         * Localize scripts only when enqueued.
         */
        public static function localize_printed_scripts()
        {
            foreach (self::$scripts as $handle) {
                self::localize_script($handle);
            }
        }
    }

    Biolife_Assets::init();
}