document.addEventListener('DOMContentLoaded', function() {
    var browseWishlistLink = document.querySelector('.yith-wcwl-wishlistexistsbrowse a[data-title="Browse wishlist"]');
    if (browseWishlistLink) {
        browseWishlistLink.innerHTML = 'הצג רשימת משאלות';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var addToWishlistSpan = document.querySelector('.yith-wcwl-add-button .add_to_wishlist span');
    if (addToWishlistSpan) {
        addToWishlistSpan.textContent = 'הוסף לרשימת המשאלות';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var compareLink = document.querySelector('.woocommerce.product.compare-button .compare.button');
    if (compareLink) {
        // compareLink.textContent = 'לְהַשְׁווֹת   ';
        compareLink.textContent = 'להשוות  ';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var categoryTitle = document.querySelector('.product_meta .posted_in .title');
    if (categoryTitle) {
        // categoryTitle.textContent = 'קָטֵגוֹרִיָה :';
        categoryTitle.textContent = 'קטגוריה :';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var codLabel = document.querySelector('label[for="payment_method_cod"]');
        if (codLabel) {
            codLabel.textContent = 'מזומן במשלוח  ';
        }

        var codDescription = document.querySelector('.payment_method_cod .payment_box p');
        if (codDescription) {
            codDescription.textContent = 'שלם במזומן בעת המסירה .  ';
        }

        var codDescription = document.querySelector('.payment_method_paypal .payment_box p');
        if (codDescription) {
            codDescription.textContent = 'שלם באמצעות PayPal;אתה יכול לשלם עם כרטיס האשראי שלך אם אין לך חשבון PayPal.  ';
        }

        var privacyPolicyText = document.querySelector('.woocommerce-privacy-policy-text p');
        if (privacyPolicyText) {
            privacyPolicyText.textContent = 'הנתונים האישיים שלך ישמשו כדי לעבד את ההזמנה שלך, לתמוך בחוויה שלך בכל אתר זה, ולמטרות אחרות המתוארות באתר שלנו  ';
        }
    }, 1000);
});


document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var searchInput = document.querySelector('#dgwt-wcas-search-input-10df');
        if (searchInput) {
            searchInput.setAttribute('placeholder', 'חפש מוצרים');
        }
    }, 3000);
});

document.addEventListener('DOMContentLoaded', function() {
    var label = document.querySelector('#shipping_method label');
    if (label) {
        label.innerHTML = label.innerHTML.replace('Flat rate:', 'תעריף קבוע:  ');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var label = document.querySelector('#shipping_method label');
        if (label) {
            label.innerHTML = label.innerHTML.replace('Flat rate:', 'תעריף קבוע:  ');
        }
    }, 1000);
});

document.addEventListener('DOMContentLoaded', function() {
    var addToCartButtons = document.querySelectorAll('.wishlist-items-wrapper .add_to_cart_button');
    addToCartButtons.forEach(function(button) {
        if (button.textContent.trim() === 'Add to cart') {
            button.innerText = ' הוספה לסל   ';
        }
    });
});


jQuery(document).ready(function($) {
    $('.yith-wcwl-add-button a.add_to_wishlist').on('click', function(event) {
        event.preventDefault();
        setTimeout(function() {
            var browseWishlistLink = document.querySelector('.yith-wcwl-wishlistaddedbrowse a[data-title="Browse wishlist"]');
            if (browseWishlistLink) {
                browseWishlistLink.innerHTML = 'הצג רשימת משאלות';
            }
        }, 2000);
    });
});
