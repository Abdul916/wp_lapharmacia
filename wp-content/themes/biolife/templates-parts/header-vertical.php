<?php
/**
 * Template Vertical menu
 *
 * @return string
 * @var $layout
 *
 */
?>
<?php
global $post;

$id = 0;

if ( !empty( $post->ID ) ) {
    $id = $post->ID;
}
if ( $layout == 'popup' ) {
    $classes = 'popup-vertical';
} else {
    $classes = 'box-nav-vertical biolife-dropdown';
}
$vertical_menu  = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_menu',
    'metabox_vertical_menu'
);
$vertical_title = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_title',
    'metabox_vertical_title'
);
$vertical_items = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_items',
    'metabox_vertical_items'
);
$show_more      = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_show_more',
    'metabox_vertical_show_more'
);
$show_less      = biolife_theme_option_meta(
    '_custom_metabox_theme_options',
    'vertical_show_less',
    'metabox_vertical_show_less'
);
$always_open    = biolife_get_option( 'vertical_always_open' );
if ( !empty( $always_open ) && is_page() && is_array( $always_open ) && in_array( $id, $always_open ) && $layout != 'popup' ) {
    $classes .= ' always-open';
}
if ( !empty( $vertical_menu ) ) : ?>
    <div class="header-vertical">
        <div class="<?php echo esc_attr( $classes ); ?>">
            <?php if ( $layout == 'popup' ) : ?>
                <div class="block-title">
                    <span class="text"><?php echo esc_html( $vertical_title ); ?></span>
                    <a href="#" class="vertical-close">
                        <span class="icon main-icon-close-2"></span>
                    </a>
                </div>
            <?php else: ?>
                <?php if ( !empty( $vertical_title ) ) : ?>
                    <a href="#" data-biolife="biolife-dropdown" class="block-title">
                        <span class="icon <?php echo esc_attr( $icon ); ?>"><span class="inner"><span></span><span></span><span></span></span></span>
                        <span class="text"><?php echo esc_html( $vertical_title ); ?></span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <div class="block-content sub-menu">
                <?php
                wp_nav_menu(
                    array(
                        'menu'            => $vertical_menu,
                        'theme_location'  => $vertical_menu,
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'megamenu'        => true,
                        'mobile_enable'   => true,
                        'menu_class'      => 'biolife-nav vertical-menu',
                        'megamenu_layout' => 'vertical',
                    )
                );
                $count      = 0;
                $menu_items = wp_get_nav_menu_items( $vertical_menu );
                foreach ( $menu_items as $menu_item ) {
                    if ( $menu_item->menu_item_parent == 0 ) {
                        $count++;
                    }
                }
                if ( !empty( $vertical_items ) && $count > $vertical_items ) : ?>
                    <div class="view-all-menu">
                        <a href="javascript:void(0);"
                           data-items="<?php echo esc_attr( $vertical_items ); ?>"
                           data-less="<?php echo esc_attr( $show_less ); ?>"
                           data-more="<?php echo esc_attr( $show_more ) ?>"
                           class="btn-view-all open-menu"><?php echo esc_html( $show_more ) ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif;