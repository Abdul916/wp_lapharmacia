<div class="post-inner" style="--blog-img-h: <?php echo esc_attr( $atts['image_height'] ); ?>px;">
    <?php biolife_post_thumbnail( $atts['image_width'], $atts['image_height'] ); ?>
    <div class="post-info">
        <?php
        biolife_post_title();
        biolife_post_date( true );
        biolife_post_excerpt( 32 );
        biolife_post_readmore( false, esc_html__( 'Read More', 'biolife' ) );
        ?>
    </div>
</div>