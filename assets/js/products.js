import {
	baseUrl
} from "./common.js";

import {
	JSONHttpRequest
} from "./modules/http-request.js";

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

	//
	// Remove buttons
	//
	let deleteButtons = document.querySelectorAll('button[name="delete"]');
	for (let i = 0; i < deleteButtons.length; i++) {
		deleteButtons[i].addEventListener("click", onDeleteClick);
	}
}

setProductEventListeners();

function onCartClick(event) {
	addToCart(event.target);
}

function onWishlistClick(event) {
	addToWishlist(event.target);
}

function onDeleteClick(event) {
	if (confirm('Are you sure you want to delete this product?')) {
		deleteProduct(event.target);
	}
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
			alert(response['message']);
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

function deleteProduct(target) {
	let productCode = target.getAttribute('product-code');

	let handleResponse = function (response) {
		if (response['status'] == 'success') {
			let productElement = document.getElementById(productCode);
			productElement.parentNode.removeChild(productElement);
		}
		else if (response['status'] == 'error') {
			alert(response['message']);
		}
	};
	let uri = baseUrl() + '/product-list';
	let data = {
		'ajax': true,
		'delete': true,
		'product-code': productCode,
	};

	JSONHttpRequest(uri, data, handleResponse);
}
