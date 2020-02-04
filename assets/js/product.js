import {
    baseUrl
} from "./common.js";

import {
    JSONHttpRequest
} from "./modules/http-request.js";

setEventListeners();

function setEventListeners() {
    //
    // Remove review buttons
    //
    let removeReviewButtons = document.querySelectorAll('button[name="remove-review"]');
    for (let i = 0; i < removeReviewButtons.length; i++) {
        removeReviewButtons[i].addEventListener("click", onRemoveReviewClick);
    }
}

document.getElementById('add-to-cart').addEventListener("click", onCartClick);
document.getElementById('add-to-wishlist').addEventListener("click", onWishlistClick);
document.getElementById('delete').addEventListener("click", onDeleteClick);
document.getElementById('review-rating').addEventListener("focusout", onReviewRatingFocusOut);

function onRemoveReviewClick(event)
{
    removeReview(event.target);
}

function onCartClick(event) {
    addToCart(event.target);
}

function onWishlistClick(event) {
    addToWishlist(event.target);
}

function onDeleteClick(event) {
    deleteProduct(event.target);
}

function onReviewRatingFocusOut()
{
    validateReviewRating();
}

function removeReview(target) {
    let productCode = target.getAttribute('product-code');
    let customerId = target.getAttribute('customer-id');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {
            let reviewElement = document.getElementById('review' + productCode + customerId);
            reviewElement.parentNode.removeChild(reviewElement);
        }
        else if (response['status'] == 'error') {
            alert(response['message']);
        }
    };
    let uri = baseUrl() + '/product/' + productCode;
    let data = {
        'ajax': true,
        'remove-review': true,
        'product-code': productCode,
        'customer-id': customerId,
    };

    JSONHttpRequest(uri, data, handleResponse);
}

function addToCart(target) {
    let productCode = target.getAttribute('product-code');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {
            alert("added to cart");
        }
        else if (response['status'] == 'error') {
            alert(response['message']);
        }
    };
    let uri = baseUrl() + '/product/' + productCode;
    let data = {
        'ajax': true,
        'add-to-cart': true,
        'product-code': productCode,
    };

    JSONHttpRequest(uri, data, handleResponse);
}

function addToWishlist(target) {
	let productCode = target.getAttribute('product-code');

	let handleResponse = function (response) {
		if (response['status'] == 'success') {
			alert("added to wishlist");
		}
		else if (response['status'] == 'error') {
            alert(response['message']);
		}
	};
	let uri = baseUrl() + '/product/' + productCode;
	let data = {
		'ajax': true,
		'add-to-wishlist': true,
		'product-code': productCode,
	};

	JSONHttpRequest(uri, data, handleResponse);
}

function deleteProduct(target) {
    let productCode = target.getAttribute('product-code');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {
            window.location.replace(baseUrl() + "/delete-product-confirm");
        }
        else if (response['status'] == 'error') {
            alert(response['message']);
        }
    };
    let uri = baseUrl() + '/product/' + productCode;
    let data = {
        'ajax': true,
        'delete': true,
        'product-code': productCode,
    };

    JSONHttpRequest(uri, data, handleResponse);
}

function validateReviewRating()
{
    let ratingElement = document.getElementById('review-rating');

    if (parseInt(ratingElement.value) < 1) {
        ratingElement.value = 1;
    }
    else if (parseInt(ratingElement.value) > 5) {
        ratingElement.value = 5;
    }
}