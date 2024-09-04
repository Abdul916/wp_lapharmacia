document.addEventListener('DOMContentLoaded', function() {
    var browseWishlistLink = document.querySelector('.yith-wcwl-wishlistexistsbrowse a[data-title="Browse wishlist"]');
    if (browseWishlistLink) {
        browseWishlistLink.innerHTML = 'עיין ברשימת המשאלות   ';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var addToWishlistSpan = document.querySelector('.yith-wcwl-add-button .add_to_wishlist span');
    if (addToWishlistSpan) {
        addToWishlistSpan.textContent = 'הוסף לרשימת המשאלות   ';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var compareLink = document.querySelector('.woocommerce.product.compare-button .compare.button');
    if (compareLink) {
        compareLink.textContent = 'לְהַשְׁווֹת   ';
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var categoryTitle = document.querySelector('.product_meta .posted_in .title');
    if (categoryTitle) {
        categoryTitle.textContent = 'קָטֵגוֹרִיָה :   ';
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
    console.log(' okokokokok 111');
    var addToCartButtons = document.querySelectorAll('.wishlist-items-wrapper .add_to_cart_button');
    console.log("addToCartButtons");
    console.log(addToCartButtons);
    addToCartButtons.forEach(function(button) {
        if (button.textContent.trim() === 'Add to cart') {
            button.innerText = ' הוספה לסל   ';
        }
    });
});
