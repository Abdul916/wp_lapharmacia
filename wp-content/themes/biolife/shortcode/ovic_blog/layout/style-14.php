<div class="post-inner">
    <?php biolife_post_thumbnail( $atts['image_width'], $atts['image_height'] ); ?>
    <div class="post-info">
        <div class="post-meta post-date">
            <a href="<?php echo biolife_post_link( 'date' ); ?>">
                <?php
                echo '<span class="day">' . get_the_date( 'd' ) . '</span>';
                echo '<span class="mount">' . get_the_date( 'M' ) . '</span>';
                ?>
            </a>
        </div>
        <?php biolife_get_term_list(); ?>
        <?php biolife_post_title(); ?>
        <?php biolife_post_author( false, esc_html__( 'Post by', 'biolife' ) ); ?>
    </div>
</div>