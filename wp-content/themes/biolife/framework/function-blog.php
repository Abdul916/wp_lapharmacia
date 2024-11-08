<?php
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
/**
 *
 * POST LINK
 **/
if ( !function_exists( 'biolife_post_link' ) ) {
    function biolife_post_link( $type = 'post', $id = 0 )
    {
        global $post;

        switch ( $type ) {
            case 'date':
                $archive_year  = get_the_time( 'Y' );
                $archive_month = get_the_time( 'm' );
                $archive_day   = get_the_time( 'd' );
                $permalink     = get_day_link( $archive_year, $archive_month, $archive_day );
                break;
            case 'auth':

                if ( $id == 0 ) {
                    $id = get_the_author_meta( 'ID' );
                }
                $permalink = get_author_posts_url( $id );
                break;
            default:

                if ( $id == 0 ) {
                    $id = get_the_ID();
                }
                $permalink = get_the_permalink( $id );
                break;
        }

        return apply_filters( 'ovic_loop_post_link', esc_url( $permalink ), $post );
    }
}
/**
 *
 * TEMPLATES FUNCTION
 **/
if ( !function_exists( 'biolife_post_thumbnail_simple' ) ) {
    function biolife_post_thumbnail_simple( $category = false, $effect = 'effect background-zoom' )
    {
        if ( has_post_thumbnail() ) : ?>
            <div class="post-thumb">
                <?php if ( $category ) {
                    biolife_get_term_list();
                } ?>
                <a href="<?php echo biolife_post_link(); ?>" class="thumb-link <?php echo esc_attr( $effect ); ?>">
                    <?php the_post_thumbnail( 'full' ); ?>
                </a>
                <?php do_action( 'biolife_post_thumbnail_inner' ); ?>
            </div>
        <?php endif;
    }
}
if ( !function_exists( 'biolife_post_thumbnail' ) ) {
    function biolife_post_thumbnail( $width, $height, $date = false, $placeholder = true, $effect = 'effect background-zoom' )
    {
        $width  = apply_filters( 'biolife_post_thumbnail_width', $width );
        $height = apply_filters( 'biolife_post_thumbnail_height', $height );
        ?>
        <div class="post-thumb">
            <?php if ( $date ): ?>
                <div class="post-date">
                    <a href="<?php echo biolife_post_link( 'date' ); ?>">
                        <span class="day"><?php echo get_the_date( 'd' ); ?></span>
                        <span class="month"><?php echo get_the_date( 'M' ); ?></span>
                    </a>
                </div>
            <?php endif; ?>
            <a href="<?php echo biolife_post_link(); ?>" class="thumb-link <?php echo esc_attr( $effect ); ?>">
                <figure>
                    <?php
                    $thumb = biolife_resize_image( get_post_thumbnail_id(), $width, $height, true, true, $placeholder );
                    echo wp_specialchars_decode( $thumb['img'] );
                    ?>
                </figure>
            </a>
            <?php do_action( 'biolife_post_thumbnail_inner' ); ?>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_post_author' ) ) {
    function biolife_post_author( $icon = false, $sub = '', $avatar = false, $avatar_size = 28 )
    {
        if ( empty( $sub ) )
            $sub = esc_html__( 'Posted By:', 'biolife' );
        ?>
        <div class="post-meta post-author">
            <a class="author" href="<?php echo biolife_post_link( 'auth' ); ?>">
                <?php if ( $icon ): ?><span class="icon"></span><?php endif; ?>
                <?php if ( $avatar ) : ?>
                    <figure class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), $avatar_size ); ?></figure>
                <?php endif; ?>
                <span class="sub"><?php echo esc_html( $sub ); ?></span>
                <span class="name"><?php the_author(); ?></span>
            </a>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_post_date' ) ) {
    function biolife_post_date( $icon = false, $format = '' )
    {
        ?>
        <div class="post-meta post-date">
            <a href="<?php echo biolife_post_link( 'date' ); ?>">
                <?php if ( $icon ): ?>
                    <span class="icon"></span>
                    <span class="sub"><?php echo esc_html__( 'Post Date:', 'biolife' ); ?></span>
                <?php endif; ?>
                <?php
                if ( !empty( $format ) ) {
                    echo get_the_date( $format );
                } else {
                    echo get_the_date();
                }
                ?>
            </a>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_post_comment' ) ) {
    function biolife_post_comment( $icon = true )
    {
        ?>
        <div class="post-meta post-comment">
            <a href="<?php echo biolife_post_link(); ?>#comments" class="comment">
                <?php if ( $icon ): ?><span class="icon"></span><?php endif; ?>
                <span class="count">
                    <?php comments_number(
                        esc_html__( '0', 'biolife' ),
                        esc_html__( '1', 'biolife' ),
                        esc_html__( '%', 'biolife' )
                    ); ?>
                </span>
                <span class="sub"><?php echo esc_html__( ' Comment', 'biolife' ); ?></span>
            </a>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_about_author' ) ) {
    function biolife_about_author()
    {
        $enable    = biolife_get_option( 'enable_author_info' );
        $author_id = get_the_author_meta( 'ID' );
        if ( $enable == 1 ):
            ?>
            <div class="post-author-info">
                <?php echo get_avatar( $author_id, 30 ); ?>
                <a class="name" href="<?php echo biolife_post_link( 'auth' ); ?>"><?php the_author(); ?></a>
            </div>
        <?php
        endif;
    }
}
if ( !function_exists( 'biolife_post_time_diff' ) ) {
    function biolife_post_time_diff( $icon = false )
    {
        $posted = get_the_time( 'U' );
        ?>
        <a class="posted" href="<?php echo biolife_post_link(); ?>">
            <?php if ( $icon ): ?><span class="icon"></span><?php endif; ?>
            <?php echo human_time_diff( $posted, current_time( 'U' ) ); ?>
        </a>
        <?php
    }
}
if ( !function_exists( 'biolife_get_term_list' ) ) {
    function biolife_get_term_list( $taxonomy = 'category', $title = '' )
    {
        $class = 'cat-list ' . $taxonomy;
        if ( $taxonomy == 'category' ) {
            $class .= ' post_cat';
        }
        if ( !empty( $title ) ) {
            $title = '<span class="sub">' . $title . '</span>';
        }
        echo get_the_term_list( get_the_ID(), $taxonomy,
            '<div class="' . $class . '">' . $title . '<div class="inner">',
            ', ',
            '</div></div>'
        );
    }
}
if ( !function_exists( 'biolife_post_formats' ) ) {
    function biolife_post_formats()
    {
        $data      = '';
        $default   = 'standard';
        $format    = get_post_format();
        $post_meta = get_post_meta( get_the_ID(), '_custom_metabox_post_options', true );
        if ( !empty( $post_meta['post_formats'][ $format ] ) ) {
            $default = $format;
            $data    = $post_meta['post_formats'][ $format ];
        }
        biolife_get_template(
            "templates/blog/blog-formats/format-{$default}.php",
            array(
                'data' => $data,
            )
        );
    }
}
if ( !function_exists( 'biolife_post_pagination' ) ) {
    function biolife_post_pagination()
    {
        $args = array(
            'screen_reader_text' => '&nbsp;',
            'before_page_number' => '',
            'prev_text'          => esc_html__( 'Prev', 'biolife' ),
            'next_text'          => esc_html__( 'Next', 'biolife' ),
            'type'               => 'list',
        );

        $pagination = biolife_get_option( 'blog_pagination', 'pagination' );
        $blog_style = biolife_get_option( 'blog_list_style', 'standard' );
        $animate    = 'fadeInUp';
        if ( $blog_style == 'masonry' ) {
            $animate = '';
        }

        if ( function_exists( 'ovic_custom_pagination' ) ) : ?>
            <div class="pagination-wrap">
                <?php
                ovic_custom_pagination(
                    array(
                        'pagination'    => $pagination,
                        'class'         => 'button',
                        'animate'       => $animate,
                        'text_loadmore' => esc_html__( 'Load more', 'biolife' ),
                        'text_infinite' => esc_html__( 'Loading', 'biolife' ),
                    ), $args
                );
                ?>
            </div>
        <?php else: ?>
            <div class="pagination-wrap">
                <nav class="woocommerce-pagination">
                    <?php echo paginate_links( $args ); ?>
                </nav>
            </div>
        <?php endif;
    }
}
if ( !function_exists( 'biolife_post_title' ) ) {
    function biolife_post_title( $link = true )
    {
        if ( get_the_title() ) {
            $tag = is_single() ? 'h1' : 'h2';
            if ( $link == true ) {
                echo '<' . $tag . ' class="post-title"><a href="' . biolife_post_link() . '">' . get_the_title() . '</a></' . $tag . '>';
            } else {
                echo '<' . $tag . ' class="post-title"><span>' . get_the_title() . '</span></' . $tag . '>';
            }
        }
    }
}
if ( !function_exists( 'biolife_post_readmore' ) ) {
    function biolife_post_readmore( $icon = false, $title = '', $class = '' )
    {
        $text = !empty( $title ) ? $title : esc_html__( 'Continue Reading', 'biolife' );
        ?>
        <div class="post-readmore">
            <a href="<?php echo biolife_post_link(); ?>" class="<?php echo esc_attr( $class ); ?>">
                <?php if ( $icon ): ?><span class="icon"></span><?php endif; ?>
                <?php echo esc_html( $text ); ?>
            </a>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_post_excerpt' ) ) {
    function biolife_post_excerpt( $count = null )
    {
        ?>
        <div class="post-excerpt">
            <?php
            if ( $count == null ) {
                echo apply_filters( 'the_excerpt', get_the_excerpt() );
            } else {
                echo wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ), $count,
                    esc_html__( '...', 'biolife' ) );
            }
            ?>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_post_content' ) ) {
    function biolife_post_content()
    {
        if ( !is_search() ):
            ?>
            <div class="post-content">
                <?php
                /* translators: %s: Name of current post */
                the_content( sprintf(
                        esc_html__( 'Continue reading %s', 'biolife' ),
                        the_title( '<span class="screen-reader-text">', '</span>', false )
                    )
                );
                wp_link_pages( array(
                        'before'      => '<div class="post-pagination"><span class="title">' . esc_html__( 'Pages:',
                                'biolife' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    )
                );
                ?>
            </div>
        <?php
        endif;
    }
}
if ( !function_exists( 'biolife_post_share' ) ) {
    function biolife_post_share( $icon = true )
    {
        ?>
        <div class="post-meta post-share biolife-dropdown">
            <a href="#" class="share-button" data-biolife="biolife-dropdown">
                <?php if ( $icon ) : ?><span class="icon"></span><?php endif; ?>
                <span class="sub"><?php echo esc_html__( 'Share', 'biolife' ); ?></span>
            </a>
            <div class="sub-menu"><?php ovic_share_button( get_the_ID() ); ?></div>
        </div>
        <?php
    }
}
if ( !function_exists( 'biolife_pagination_post' ) ) {
    function biolife_pagination_post()
    {
        $enable    = biolife_get_option( 'enable_pagination_post' );
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        if ( $enable == 1 ):
            ?>
            <nav class="pagination-post">
                <div class="inner">
                    <?php if ( !empty( $prev_post ) ): ?>
                        <div class="item prev">
                            <a class="link" href="<?php echo biolife_post_link( 'post', $prev_post->ID ); ?>">
                                <span class="text"><?php echo esc_html__( 'Previous Post', 'biolife' ); ?></span>
                                <span class="title"><?php echo esc_html( $prev_post->post_title ) ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $next_post ) ): ?>
                        <div class="item next">
                            <a class="link" href="<?php echo biolife_post_link( 'post', $next_post->ID ); ?>">
                                <span class="text"><?php echo esc_html__( 'Next Post', 'biolife' ); ?></span>
                                <span class="title"><?php echo esc_html( $next_post->post_title ) ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>
        <?php
        endif;
    }
}
if ( !function_exists( 'biolife_comment_form_args' ) ) {
    function biolife_comment_form_args()
    {
        return array(
            'wraper_start' => '<div class="row">',
            'author'       => '<p class="comment-form-author col-sm-6"><input placeholder="' . esc_attr__( 'Name', 'biolife' ) . '" type="text" name="author" id="author" required="required" /></p>',
            'email'        => '<p class="comment-form-email col-sm-6"><input placeholder="' . esc_attr__( 'Email', 'biolife' ) . '" type="text" name="email" id="email" aria-describedby="email-notes" required="required" /></p>',
            'wraper_end'   => '</div>',
        );
    }
}
if ( !function_exists( 'biolife_comment_form_field' ) ) {
    function biolife_comment_form_field( $text = '' )
    {
        if ( empty( $text ) ) {
            $text = esc_attr__( 'Comment ...', 'biolife' );
        }

        return '<p class="comment-form-comment"><textarea placeholder="' . $text . '" class="input-form" id="comment" name="comment" cols="45" rows="8" aria-required="true">' . '</textarea></p>';
    }
}
if ( !function_exists( 'biolife_callback_comment' ) ) {
    /**
     * Ocolus comment template
     *
     * @param  array $comment the comment array.
     * @param  array $args the comment args.
     * @param  int $depth the comment depth.
     *
     * @since 1.0.0
     */
    function biolife_callback_comment( $comment, $args, $depth )
    {
        $tag       = ( 'div' === $args['style'] ) ? 'div' : 'li';
        $commenter = wp_get_current_commenter();
        if ( $commenter['comment_author_email'] ) {
            $moderation_note = esc_html__( 'Your comment is awaiting moderation.', 'biolife' );
        } else {
            $moderation_note = esc_html__( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.',
                'biolife' );
        }
        ?>
        <<?php echo wp_specialchars_decode( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'parent' : '', $comment ); ?>>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <?php if ( 0 != $args['avatar_size'] ): ?>
                <div class="comment-avatar">
                    <figure><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></figure>
                </div>
            <?php endif; ?>
            <div class="comment-info">
                <div class="comment-author vcard">
                    <?php
                    /* translators: %s: comment author link */
                    printf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) );
                    ?>
                </div>
                <div class="comment-date">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php
                            /* translators: 1: comment date */
                            printf( esc_html__( '%1$s', 'biolife' ), get_comment_date( '', $comment ) );
                            ?>
                        </time>
                    </a>
                </div>
                <?php
                edit_comment_link(
                    esc_html__( 'Edit', 'biolife' ),
                    '<span class="edit-link">',
                    '</span>'
                );
                ?>
                <?php
                comment_reply_link(
                    array_merge( $args,
                        array(
                            'reply_text' => esc_html__( 'Leave Reply', 'biolife' ),
                            'add_below'  => 'div-comment',
                            'depth'      => $depth,
                            'max_depth'  => $args['max_depth'],
                            'before'     => '<div class="reply">',
                            'after'      => '</div>',
                        )
                    )
                );
                ?>
                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>
                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
                <?php endif; ?>
            </div>
        </div><!-- .comment-body -->
        <?php
    }
}
/**
 *
 * POST VIEWS
 */
if ( !function_exists( 'biolife_post_views' ) ) {
    function biolife_post_views( $icon = true )
    {
        if ( !class_exists( 'Ovic_Addon_Toolkit' ) )
            return;
        $views = biolife_get_post_views();
        ?>
        <div class="item post-meta post-views">
            <?php if ( $icon ): ?><span class="icon main-icon-eye-2"></span><?php endif; ?>
            <span class="text">
                <?php echo sprintf( esc_html__( '%s %s %s %s this product.', 'biolife' ), '<b>', $views, _n( 'view', 'views', $views, 'biolife' ), '</b>' ); ?>
            </span>
        </div>
        <?php
    }
}