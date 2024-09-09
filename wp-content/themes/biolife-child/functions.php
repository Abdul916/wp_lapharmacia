<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
// END ENQUEUE PARENT ACTION


function lapharmacia_custom_text_change_label() {
    wp_enqueue_script('custom_text_change', get_stylesheet_directory_uri() . '/assets/custom_text_change_label.js', array(), null, true );
}
add_action('wp_enqueue_scripts', 'lapharmacia_custom_text_change_label', 20);

add_filter('woocommerce_checkout_fields', 'customize_checkout_fields');
function customize_checkout_fields($fields) {
    $fields['billing']['billing_first_name']['label'] = 'שם מלא  ';
    $fields['billing']['billing_first_name']['placeholder'] = 'הזן את שמך המלא  ';

    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_state']);
    if( isset($fields['billing']['createaccount']) ) {
        unset($fields['billing']['createaccount']);
    }

    $fields['billing']['billing_address_1']['required'] = false;
    $fields['billing']['billing_address_2']['required'] = false;
    $fields['billing']['billing_country']['required'] = false;
    $fields['billing']['billing_postcode']['required'] = false;
    $fields['billing']['billing_state']['required'] = false;
    return $fields;
}


function translate_authentication_errors( $translated_text, $text, $domain ) {
    if ( $domain === 'default' ) {
        switch ( $text ) {
            case 'Your email address will not be published.':
            $translated_text = 'כתובת האימייל שלך לא תפורסם. ';
            break;
            case 'Required fields are marked %s':
            $translated_text = 'שדות חובה מסומנים ב- %s  ';
            break;

        }
    }
    return $translated_text;
}
add_filter( 'gettext', 'translate_authentication_errors', 20, 3 );

add_filter( 'gettext', 'lapharmacia_change_text', 20, 3 );
function lapharmacia_change_text( $translated_text, $text, $domain ) {
    if ( $domain === 'biolife' ) {
        switch ( $text ) {
            case 'Wishlist':
            $translated_text = 'מעודפים  ';
            break;
            case 'in stock':
            $translated_text = 'במלאי ';
            break;
            case 'In stock':
            $translated_text = 'במלאי ';
            break;
            case 'Review':
            $translated_text = 'סקירה ';
            break;
            case 'Reviews':
            $translated_text = 'סקירות ';
            break;
            case 'All products':
            $translated_text = 'כל המוצרים ';
            break;
            case 'Show %s products':
            $translated_text = 'הצג %s מוצרים ';
            break;
            case 'Show All':
            $translated_text = 'הצג הכל ';
            break;
            case 'item':
            $translated_text = 'פריט ';
            break;
            case 'Go':
            $translated_text = 'לך ';
            break;
            case 'My Bag':
            $translated_text = 'התיק שלי ';
            break;
            case 'My Cart':
            $translated_text = 'העגלה שלי ';
            break;
            case 'Product Code':
            $translated_text = 'קוד מוצר ';
            break;
            case 'N/A':
            $translated_text = 'לא זמין ';
            break;
            case 'Category':
            $translated_text = 'קטגוריה ';
            break;
            case 'Category:':
            $translated_text = 'קטגוריה :';
            break;
            case 'Categories':
            $translated_text = 'קטגוריות ';
            break;
            case 'Tag':
            $translated_text = 'תג ';
            break;
            case 'Tags':
            $translated_text = 'תגים ';
            break;
            case 'In Stock':
            $translated_text = 'במלאי ';
            break;
            case 'Availability':
            $translated_text = 'זמינות  ';
            break;
            case 'Availability: ':
            $translated_text = 'זמינות : ';
            break;
            case 'Unlimit':
            $translated_text = 'ללא הגבלה ';
            break;
            case 'Sold:':
            $translated_text = 'נמכר:';
            break;
            case 'Delivery & Return':
            $translated_text = 'משלוח והחזרה ';
            break;
            case 'Prev':
            $translated_text = 'הקודם ';
            break;
            case 'Next':
            $translated_text = 'הבא';
            break;
            case 'Available':
            $translated_text = 'זמין ';
            break;
            case 'Already Sold':
            $translated_text = 'כבר נמכר ';
            break;
            case 'Main Menu':
            $translated_text = 'תפריט ראשי  ';
            break;
            case 'MAIN MENU':
            $translated_text = 'תפריט ראשי  ';
            break;
            case 'Show':
            $translated_text = 'לְהַצִיג  ';
            break;
            case 'Sort':
            $translated_text = 'סוּג  ';
            break;
            case 'Latest':
            $translated_text = 'אחרון  ';
            break;
            case 'Popularity':
            $translated_text = 'פופולריות  ';
            break;
            case 'Average Rating':
            $translated_text = 'דירוג ממוצע  ';
            break;
            case 'Price: Low To High':
            $translated_text = 'מחיר: נמוך עד גבוה  ';
            break;
            case 'Price: High To Low':
            $translated_text = 'מחיר: גבוה עד נמוך  ';
            break;
            case 'Sale':
            $translated_text = 'מכירה  ';
            break;
            case 'On-Sale':
            $translated_text = 'במבצע  ';
            break;
            case 'Feature':
            $translated_text = 'תכונה  ';
            break;
            case 'Top':
            $translated_text = '';
            break;
            case 'Sidebar':
            $translated_text = 'תכונה  ';
            break;
            case 'Menu':
            $translated_text = 'תכונה  ';
            break;
            case 'Home':
            $translated_text = 'בית  ';
            break;
            case 'Account':
            $translated_text = ' חשבון ';
            break;
            case 'New':
            $translated_text = 'חדש  ';
            break;
            case 'Sale Off':
            $translated_text = 'מְכִירָה כבוי  ';
            break;
            case 'Off':
            $translated_text = 'כבוי  ';
            break;
            case 'Hot':
            $translated_text = 'חַם  ';
            break;
            case 'Sold out':
            $translated_text = 'הַכַּרטִיסִים אָזלוּ  ';
            break;
            case 'Email':
            $translated_text = 'אֶלֶקטרוֹנִי  ';
            break;
            case 'Name':
            $translated_text = 'שֵׁם  ';
            break;
            case '%1$s Review':
            $translated_text = '%1$sסקירה ';
            break;
            case '%1$s Reviews':
            $translated_text = '%1$sשֵׁביקורות ';
            break;
            case 'Star':
            $translated_text = 'כּוֹכָב ';
            break;
            case 'out of 5':
            $translated_text = 'מתוך  5  ';
            break;
            case 'We are sorry.':
            $translated_text = 'אנו מצטערים.  ';
            break;
            case 'The page you\'ve requested is not available.':
            $translated_text = 'הדף שביקשת אינו זמין.  ';
            break;
            case 'Return to Home':
            $translated_text = 'חזור לבית  ';
            break;
            case 'Shop Product':
            $translated_text = 'חנות מוצר ';
            break;
            case 'Search':
            $translated_text = 'חפש  ';
            break;

        }
    }

    if ( $text === 'Main Menu' && $domain === 'ovic-addon-toolkit' ) {
        $translated_text = 'תפריט ראשי ';
    }
    if ( $text === 'Notice!'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'הודעה  ';
    }
    if ( $text === 'Product Removed'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'המוצר הוסר  ';
    }
    if ( $text === 'View cart'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'צפה בעגלה  ';
    }
    if ( $text === 'Product has been added to cart!'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'המוצר התווסף לסל!  ';
    }
    if ( $text === 'Product has been added to wishlist!'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'המוצר התווסף לרשימת המשאלות!  ';
    }
    if ( $text === 'Product has been removed from wishlist!'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'המוצר הוסר מרשימת המשאלות!  ';
    }
    if ( $text === 'Browse Wishlist'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'עיין ברשימת המשאלות  ';
    }
    if ( $text === 'Product added!'  && $domain === 'ovic-addon-toolkit'){
        $translated_text = 'מוצר נוסף! ';
    }
    if ( $text === 'No products added to the wishlist'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'לא נוספו מוצרים לרשימת המשאלות  ';
    }
    if ( $text === 'Product name'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'שם המוצר  ';
    }
    if ( $text === 'Unit price'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'מחיר ליחידה  ';
    }
    if ( $text === 'Quantity'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'כַּמוּת  ';
    }
    if ( $text === 'Stock status'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'מצב מלאי  ';
    }
    if ( $text === 'Arrange'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'לְאַרגֵן  ';
    }
    if ( $text === 'In Stock'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'במלאי';
    }
    if ( $text === 'In stock'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'במלאי';
    }
    if ( $text === 'Remove this product'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'הסר את המוצר הזה  ';
    }
    if ( $text === 'Out of stock'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'אזל המלאי  ';
    }
    if ( $text === 'Move'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'מַהֲלָך  ';
    }
    if ( $text === 'Remove this product'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'הסר את המוצר הזה  ';
    }
    if ( $text === 'Remove'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'לְהַסִיר  ';
    }
    if ( $text === 'Added on: %s'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'הוסף בתאריך : %s  ';
    }
    if ( $text === 'Remove'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'עבר לרשימה אחרת  &rsaquo; ';
    }
    if ( $text === 'Product successfully removed.'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'עבר לרשימה אחרת  &rsaquo; ';
    }

    if ( $text === 'Your review is awaiting approval'  && $domain === 'woocommerce'){
        $translated_text = 'המוצר הוסר בהצלחה.  ';
    }

    if ( $text === 'Product added!'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'מוצר נוסף! ';
    }
    if ( $text === 'No results'  && $domain === 'ajax-search-for-woocommerce'){
        $translated_text = 'אין תוצאות  ';
    }
    if ( $text === 'Product added to cart successfully'  && $domain === 'yith-woocommerce-wishlist'){
        $translated_text = 'המוצר נוסף לעגלת הקניות בהצלחה  ';
    }

    if ( $text === 'Compare products' && $domain === 'yith-woocommerce-compare' ) {
        $translated_text = 'השווה מוצרים';
    }
    if ( $text === 'In stock'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'במלאי';
    }
    if ( $text === 'Added'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'נוסף  ';
    }
    if ( $text === 'Product Comparison'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'השוואת מוצרים  ';
    }
    if ( $text === 'Compare'  && $domain === 'yith-woocommerce-compare'){
        // $translated_text = 'לְהַשְׁווֹת  ';
        $translated_text = 'להשוות  ';
    }
    if ( $text === 'Close'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'לִסְגוֹר  ';
    }
    if ( $text === 'No products to compare'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'אין מוצרים להשוואה  ';
    }
    if ( $text === 'Remove'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'לְהַסִיר  ';
    }
    if ( $text === 'No products added in the compare table.'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'לא נוספו מוצרים בטבלת ההשוואה. ';
    }
    if ( $text === 'Image'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'תְמוּנָה  ';
    }
    if ( $text === 'Title'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'כּוֹתֶרֶת  ';
    }
    if ( $text === 'Price'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'מְחִיר  ';
    }
    if ( $text === 'Add to cart'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'הוסף לעגלה  ';
    }
    if ( $text === 'Description'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'תֵאוּר  ';
    }
    if ( $text === 'Sku'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'סקו  ';
    }
    if ( $text === 'Availability'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'זמינות  ';
    }
    if ( $text === 'Weight'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'מִשׁקָל  ';
    }
    if ( $text === 'Dimensions'  && $domain === 'yith-woocommerce-compare'){
        $translated_text = 'מידות  ';
    }
    return $translated_text;
}

// function update_wishlist_added_text() {
//     update_option('yith_wcwl_product_added_text', 'מוצר נוסף! '); // Product added!
//     update_option('yith_wcwl_browse_wishlist_text', 'עיין ברשימת המשאלות  '); // Browse Wishlist
//     update_option('yith-wcqv-button-label', 'תצוגה מהירה  '); // Quick View
//     update_option('yith_woocompare_table_text', ' השוו מוצרים  '); // Compare products
// }
// add_action('init', 'update_wishlist_added_text');