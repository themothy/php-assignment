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
    let removeButtons = document.querySelectorAll('button[name="remove"]');
    for (let i = 0; i < removeButtons.length; i++) {
        removeButtons[i].addEventListener("click", onRemoveClick);
    }

    //
    // Quantity inputs
    //
    let quantityInputs = document.querySelectorAll('input[name="quantity-ordered"]');
    for (let i = 0; i < quantityInputs.length; i++) {
        quantityInputs[i].addEventListener("focusout", onQuantityFocusout);
    }
}

function onRemoveClick(event) {
    removeItem(event.target);
}

function onQuantityFocusout(event) {
    validateQuantity(event.target);
    updateQuantity(event.target);
}

function removeItem(target) {
    let productCode = target.getAttribute('product-code');
    let orderId = target.getAttribute('order-id');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {
            let itemElement = document.getElementById(orderId + productCode);
            itemElement.parentNode.removeChild(itemElement);
        }
        else if (response['status'] == 'error') {
            alert("failed to remove from cart");
        }
    };
    let uri = baseUrl() + '/amend-order/' + orderId;
    let data = {
        'ajax': true,
        'remove-item': true,
        'order-id': orderId,
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
    let orderId = target.getAttribute('order-id');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {

        }
        else if (response['status'] == 'error') {
            alert("failed to update quantity of product " + productCode);
        }
    };
    let uri = baseUrl() + '/amend-order/' + orderId;
    let data = {
        'ajax': true,
        'update-quantity': true,
        'new-quantity': target.value,
        'order-id': orderId,
        'product-code': productCode,
    };

    JSONHttpRequest(uri, data, handleResponse);
}
