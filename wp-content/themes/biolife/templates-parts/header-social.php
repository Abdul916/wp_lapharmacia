<?php
$social_menu = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'social_menu',
    'metabox_social_menu'
);
$all_socials = biolife_get_option( 'user_all_social' );
if ( $social_menu == 1 && !empty( $all_socials ) ) : ?>
    <div class="header-social">
        <div class="inner">
            <?php foreach ( $all_socials as $social ) : ?>
                <a href="<?php echo esc_url( $social['link_social'] ) ?>">
                    <span class="icon <?php echo esc_attr( $social['icon_social'] ); ?>"></span>
                    <span class="text"><?php echo esc_html( $social['title_social'] ); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;