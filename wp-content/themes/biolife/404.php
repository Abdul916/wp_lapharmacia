<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Biolife
 * @since 1.0
 * @version 1.0
 */

get_header();
?>
<?php
$image = biolife_get_option( '404_image' );
?>
    <div id="content" class="container site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <section class="error-404 not-found">
                    <h1 class="page-title"><?php echo esc_html__( 'We are sorry.', 'biolife' ); ?></h1>
                    <p class="subtitle"><?php echo esc_html__( 'The page you\'ve requested is not available.', 'biolife' ); ?></p>
                    <?php if ( !empty( $image ) ) {
                        echo '<figure class="image">' . wp_get_attachment_image( $image, 'full' ) . '</figure>';
                    } ?>
                    <a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Return to Home', 'biolife' ); ?></a>
                </section><!-- .error-404 -->
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
<?php
get_footer();
