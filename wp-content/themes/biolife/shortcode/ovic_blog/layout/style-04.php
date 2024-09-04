<div class="post-inner">
    <?php biolife_post_thumbnail( $atts['image_width'], $atts['image_height'], true ); ?>
    <div class="post-info">
        <div class="metas-wrap">
            <div class="post-metas">
                <?php
                do_action( 'ovic_simple_likes_button', get_the_ID() );
                biolife_post_comment();
                biolife_post_share();
                ?>
            </div>
        </div>
        <?php
        biolife_post_title();
        biolife_post_excerpt( 24 );
        biolife_post_readmore();
        ?>
    </div>
</div>