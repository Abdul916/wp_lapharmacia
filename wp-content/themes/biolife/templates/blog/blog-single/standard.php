<?php
$share = biolife_get_option( 'enable_share_post' );
while ( have_posts() ): the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item post-single' ); ?>>
        <div class="post-inner">
            <?php
            biolife_post_thumbnail_simple();
            biolife_post_title( false );
            ?>
            <div class="post-metas">
                <?php
                biolife_get_term_list();
                biolife_post_date();
                biolife_post_author();
                ?>
            </div>
            <?php biolife_post_content(); ?>
            <div class="clear"></div>
            <?php biolife_get_term_list( 'post_tag', esc_html__( 'Tags:', 'biolife' ) ); ?>
            <div class="clear"></div>
            <div class="post-foot">
                <?php biolife_about_author(); ?>
                <?php if ( $share == 1 ): ?>
                    <div class="post-share-list">
                        <span class="title"><?php echo esc_html__( 'Share:', 'biolife' ) ?></span>
                        <?php ovic_share_button(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        /*If comments are open or we have at least one comment, load up the comment template.*/
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
        ?>
    </article>
<?php endwhile;