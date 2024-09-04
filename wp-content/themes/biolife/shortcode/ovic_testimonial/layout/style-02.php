<?php
/**
 * Template shortcode
 *
 * @return string
 * @var $testmonial
 * @var $atts
 *
 */
?>
<?php
$owl_settings = array(
    'slidesToShow'  => 1,
    'autoplay'      => true,
    'autoplaySpeed' => 3000,
    'infinite'      => true,
    'arrows'        => true,
    'slidesMargin'  => 30,
    'speed'         => 1000,
    'fade'          => true,
);
?>
<div class="owl-slick" data-slick="<?php echo esc_attr( json_encode( $owl_settings ) ); ?>">
    <?php foreach ( $atts['items'] as $item ) :
        $item['link']['url'] = apply_filters( 'ovic_shortcode_vc_link', $item['link']['url'] );
        $link = $testmonial->add_link_attributes( $item['link'], true ); ?>
        <div class="item">
            <div class="inner effect background-zoom">
                <?php if ( !empty( $item['avatar']['id'] ) ): ?>
                    <div class="avatar">
                        <a <?php echo esc_attr( $link ); ?>><?php echo wp_get_attachment_image( $item['avatar']['id'], 'full' ); ?></a>
                    </div>
                <?php endif; ?>
                <div class="content">
                    <?php if ( !empty( $item['rating'] ) ): ?>
                        <span class="star-rating">
                        <span style="width:<?php echo( ( (int)$item['rating'] / 5 ) * 100 ); ?>%"></span>
                    </span>
                    <?php endif; ?>
                    <?php if ( !empty( $item['desc'] ) ): ?>
                        <p class="desc"><?php echo wp_specialchars_decode( $item['desc'] ); ?></p>
                    <?php endif; ?>
                    <div class="info">
                        <?php if ( !empty( $item['name'] ) ): ?>
                            <p class="name"><a <?php echo esc_attr( $link ); ?>><?php echo esc_html( $item['name'] ); ?></a></p>
                        <?php endif; ?>
                        <?php if ( !empty( $item['posi'] ) ): ?>
                            <p class="posi"><?php echo esc_html( $item['posi'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>