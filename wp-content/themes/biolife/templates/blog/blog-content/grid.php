<?php
/**
 * Name: Blog Grid
 **/
?>
<?php
$page_layout   = biolife_page_layout();
$container     = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'main_container',
    'metabox_main_container'
);
$sidebar_width = 0;
$sidebar_space = 0;
$columns       = 3;
$blog_space    = 15;
$crop          = 0.6277;
if ( $page_layout['layout'] == 'left' || $page_layout['layout'] == 'right' ) {
    $sidebar_width = biolife_get_option( 'sidebar_width', 270 );
    $sidebar_space = biolife_get_option( 'sidebar_space', 30 );
    $columns       = 2;
}
$width  = ( $container - $sidebar_width - $sidebar_space - ( ( $columns - 1 ) * ( $blog_space * 2 ) ) ) / $columns;
$height = $width * $crop;
?>
<div class="blog-content blog-grid response-content"
     style="--blog-columns: <?php echo esc_attr( $columns ); ?>; --blog-space: <?php echo esc_attr( $blog_space ); ?>px;">
    <?php while ( have_posts() ): the_post(); ?>
        <article <?php post_class( 'post-item style-01' ); ?>>
            <div class="post-inner">
                <?php biolife_post_thumbnail( $width, $height ); ?>
                <div class="post-info">
                    <?php
                    biolife_post_title();
                    ?>
                    <div class="post-metas">
                        <?php
                        biolife_get_term_list();
                        biolife_post_date();
                        biolife_post_author();
                        ?>
                    </div>
                    <?php
                    biolife_post_excerpt( 23 );
                    ?>
                    <div class="post-foot">
                        <?php
                        biolife_post_readmore( false, esc_html__( 'Read more', 'biolife' ) );
                        biolife_post_comment();
                        ?>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</div>
<?php biolife_post_pagination(); ?>
