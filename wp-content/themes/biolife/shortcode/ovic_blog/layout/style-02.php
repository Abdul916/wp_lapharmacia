<div class="post-inner">
    <?php biolife_post_thumbnail( $atts['image_width'], $atts['image_height'], true ); ?>
    <div class="post-info">
        <?php biolife_post_title(); ?>
        <div class="post-metas">
            <?php
            biolife_post_author( false, '', true );
            do_action( 'ovic_simple_likes_button', get_the_ID() );
            biolife_post_comment();
            biolife_post_share();
            ?>
        </div>
        <?php
        biolife_post_excerpt( 22 );
        biolife_post_readmore();
        ?>
    </div>
</div>