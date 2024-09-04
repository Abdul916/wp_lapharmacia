<?php
/**
 * Name: Blog Standard
 **/
?>
<div class="blog-content blog-standard response-content">
    <?php while ( have_posts() ): the_post(); ?>
        <article <?php post_class( 'post-item style-01' ); ?>>
            <div class="post-inner">
                <?php biolife_post_thumbnail_simple(); ?>
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
                    biolife_post_excerpt( 43 );
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
