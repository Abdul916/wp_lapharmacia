<div class="post-inner">
    <?php biolife_post_thumbnail( $atts['image_width'], $atts['image_height'] ); ?>
    <div class="post-info">
        <?php
        biolife_get_term_list();
        biolife_post_title();
        if ( !empty( $atts['deco']['id'] ) ) {
            echo '<div class="post-deco">' . wp_get_attachment_image( $atts['deco']['id'], 'full' ) . '</div>';
        }
        ?>
        <div class="post-metas">
            <?php
            biolife_post_author( true, esc_html__( 'by', 'biolife' ) );
            biolife_post_date( true );
            biolife_post_comment();
            ?>
        </div>
        <?php
        biolife_post_excerpt( 15 );
        biolife_post_readmore( false, esc_html__( 'Read More', 'biolife' ), 'button' );
        ovic_share_button( get_the_ID() );
        ?>
    </div>
</div>