import {
    baseUrl
} from "./common.js";

import {
    JSONHttpRequest
} from "./modules/http-request.js";

setCartEventListeners();

function setCartEventListeners() {
    //
    // Remove buttons
    //
    let removeButtons = document.querySelectorAll('button[name="remove-from-wishlist"]');
    for (let i = 0; i < removeButtons.length; i++) {
        removeButtons[i].addEventListener("click", onRemoveClick);
    }
}

function onRemoveClick(event) {
    removeFromWishlist(event.target);
}

function removeFromWishlist(target) {
    let productCode = target.getAttribute('product-code');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {
            let wishlistElement = document.getElementById(productCode);
            wishlistElement.parentNode.removeChild(wishlistElement);
        }
        else if (response['status'] == 'error') {
            alert(response['message']);
        }
    };
    let uri = baseUrl() + '/wish-list';
    let data = {
        'ajax': true,
        'remove-from-wishlist': true,
        'product-code': productCode,
    };

    JSONHttpRequest(uri, data, handleResponse);
}

