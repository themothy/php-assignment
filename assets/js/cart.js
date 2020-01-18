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
    let removeButtons = document.querySelectorAll('button[name="remove-from-cart"]');
    for (let i = 0; i < removeButtons.length; i++) {
        removeButtons[i].addEventListener("click", onRemoveClick);
    }

    //
    // Quantity inputs
    //
    let quantityInputs = document.querySelectorAll('input[name="item-quantity"]');
    for (let i = 0; i < quantityInputs.length; i++) {
        quantityInputs[i].addEventListener("focusout", onQuantityFocusout);
    }
}

function onRemoveClick(event) {
    removeFromCart(event.target);
}

function onQuantityFocusout(event) {
    validateQuantity(event.target);
    updateQuantity(event.target);
}

function removeFromCart(target) {
    let productCode = target.getAttribute('product-code');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {
            let cartElement = document.getElementById(productCode);
            cartElement.parentNode.removeChild(cartElement);
        }
        else if (response['status'] == 'error') {
            alert("failed to remove from cart");
        }
    };
    let uri = baseUrl() + '/cart';
    let data = {
        'ajax': true,
        'remove-from-cart': true,
        'product-code': productCode,
    };

    JSONHttpRequest(uri, data, handleResponse);
}

function validateQuantity(target) {
    if (parseInt(target.value) < 1) {
        target.value = 1;
    }
}

function updateQuantity(target) {
    let productCode = target.getAttribute('product-code');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {

        }
        else if (response['status'] == 'error') {
            alert("failed to update quantity of product " + productCode);
        }
    };
    let uri = baseUrl() + '/cart';
    let data = {
        'ajax': true,
        'update-quantity': true,
        'new-quantity': target.value,
        'product-code': productCode,
    };

    JSONHttpRequest(uri, data, handleResponse);
}
