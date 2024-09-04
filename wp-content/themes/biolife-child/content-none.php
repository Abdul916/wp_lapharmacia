<h2 class="page-title"><?php esc_html_e( 'שום דבר לא נמצא  ', 'biolife' ); ?></h2>
<div class="no-results not-found">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
        <p><?php printf( '%2$s <a href="%1$s">%3$s</a>.', esc_url( admin_url( 'post-new.php' ) ), esc_html__( 'מוכן לפרסם את הפוסט הראשון שלך?  ', 'biolife' ), esc_html__( 'התחל כאן ', 'biolife' ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
        <p><?php esc_html_e( 'מצטערים, אבל שום דבר לא תאם את מונחי החיפוש שלך. אנא נסה שוב עם כמה מילות מפתח שונות.  ', 'biolife' ); ?></p>
		<?php get_search_form(); ?>
	<?php else : ?>
        <p><?php esc_html_e( 'נראה שאיננו יכולים למצוא את מה שאתה מחפש. אולי חיפוש יכול לעזור. ', 'biolife' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div><!-- .no-results -->