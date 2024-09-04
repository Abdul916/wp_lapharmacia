<div class="post-inner" style="--blog-height: <?php echo esc_attr( $atts['image_height'] ); ?>px;">
    <?php biolife_post_thumbnail( $atts['image_width'], $atts['image_height'] ); ?>
    <div class="post-info">
        <?php biolife_post_title(); ?>
        <div class="post-metas">
            <?php
            biolife_post_date();
            biolife_post_author( false, esc_html__( 'by', 'biolife' ) );
            ?>
        </div>
        <?php
        biolife_post_excerpt( 20 );
        biolife_post_readmore( false, esc_html__( 'Readmore', 'biolife' ) );
        ?>
    </div>
</div>