import {
    baseUrl
} from "./common.js";

import {
    JSONHttpRequest
} from "./modules/http-request.js";

setProductEventListeners();

function setProductEventListeners() {
	//
	// Cart buttons
	//
    let cartButtons = document.querySelectorAll('button[name="add-to-cart"]');
    for (let i = 0; i < cartButtons.length; i++) {
        cartButtons[i].addEventListener("click", onCartClick);
    }

    //
    // Wishlist buttons
	//
    let wishlistButtons = document.querySelectorAll('button[name="add-to-wishlist"]');
    for (let i = 0; i < wishlistButtons.length; i++) {
        wishlistButtons[i].addEventListener("click", onWishlistClick);
    }
}

function onCartClick(event) {
    addToCart(event.target);
}

function onWishlistClick(event) {
    addToWishlist(event.target);
}

function addToCart(target) {
    let productCode = target.getAttribute('product-code');

    let handleResponse = function (response) {
        if (response['status'] == 'success') {
            alert("added to cart");
        }
        else if (response['status'] == 'error') {
            alert("failed to add to cart");
        }
    };
    let uri = baseUrl() + '/product-list';
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
			alert("failed to add to wishlist");
		}
	};
	let uri = baseUrl() + '/product-list';
	let data = {
		'ajax': true,
		'add-to-wishlist': true,
		'product-code': productCode,
	};

	JSONHttpRequest(uri, data, handleResponse);
}
