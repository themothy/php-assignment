import {
    baseUrl
} from "./common.js";

import {
    JSONHttpRequest
} from "./modules/http-request.js";

import {
    removeValidationClasses,
    toggleIsInvalid,
    toggleIsValid
} from "./modules/form-util.js";

document.getElementById('add-button').addEventListener("click", onAddButtonClick)
document.getElementById('product-code').addEventListener("focusout", onProductCodeFocusOut);

function onAddButtonClick() {
    return validateData();
}

function onProductCodeFocusOut() {
    return verifyProductCodeIsFree();
}

function validateData() {
    let flags = [];

    flags[0] = verifyProductCodeIsFree();

    console.log(flags);

    for (let i = 0; i < flags.length; i++) {
        if (flags[i] == false) {
            document.getElementById('add-button-alert').classList.remove('d-none');
            return false;
        }
    }

    document.getElementById('add-button-alert').classList.add('d-none');
    return true;
}

function verifyProductCodeIsFree() {
    let productCode = document.getElementById('product-code');
    let invalidFeedback = document.getElementById('product-code-invalid-feedback');
    let flag = true;

    if (productCode.value != "" && productCode.value != null) {
        let handleResponse = function (response) {
            invalidFeedback.innerHTML = response['message'];

            if (response['status'] == 'success') {
                toggleIsValid(productCode);
            }
            else if (response['status'] == 'error') {
                toggleIsInvalid(productCode);
                flag = false;
            }
        };
        let uri = baseUrl() + '/add-product';
        let data = {
            'ajax': true,
            'verify-product-code-free': true,
            'product-code': productCode.value,
        };

        JSONHttpRequest(uri, data, handleResponse);
    }
    else {
        removeValidationClasses(productCode);
    }

    return flag;
}