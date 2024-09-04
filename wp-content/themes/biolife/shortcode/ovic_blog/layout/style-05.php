<div class="post-inner">
    <?php biolife_post_thumbnail( $atts['image_width'], $atts['image_height'] ); ?>
    <div class="post-info">
        <?php biolife_post_title(); ?>
        <div class="post-metas">
            <?php
            biolife_post_date();
            biolife_post_comment( false );
            ?>
        </div>
    </div>
</div>