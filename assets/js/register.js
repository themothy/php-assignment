import {
    baseUrl
} from "./common.js";

import {
    isEmail,
    isPassword,
    isName
} from './modules/validation.js';

import {
    removeValidationClasses,
    toggleIsValid,
    toggleIsInvalid
} from './modules/form-util.js';

import {
    JSONHttpRequest
} from "./modules/http-request.js";

document.getElementById('register-button').addEventListener("click", onRegisterButtonClick)
document.getElementById('email').addEventListener("input", onEmailInput);
document.getElementById('email').addEventListener("focusout", onEmailFocusout);
document.getElementById('password').addEventListener("input", onPasswordInput);
document.getElementById('password').addEventListener("focusout", onPasswordFocusout);
document.getElementById('confirm-password').addEventListener("focusout", onConfirmPasswordFocusout);

function onRegisterButtonClick() {
    return validateData();
}

function onEmailInput() {
    validateEmail();
}

function onEmailFocusout() {
    verifyEmailIsFree();
}

function onPasswordInput() {
    validatePassword();
}

function onPasswordFocusout() {
    validatePassword();
}

function onConfirmPasswordFocusout() {
    validateConfirmPassword();
}

function validateData() {
    let flags = [];

    flags[0] = validateEmail();
    flags[1] = verifyEmailIsFree();
    flags[2] = validatePassword();
    flags[3] = validateConfirmPassword();

    console.log(flags);

    for (let i = 0; i < flags.length; i++) {
        if (flags[i] == false) {
            document.getElementById('register-button-alert').classList.remove('d-none');
            return false;
        }
    }

    document.getElementById('register-button-alert').classList.add('d-none');
    return true;
}

function validateEmail() {
    let email = document.getElementById('email');
    let invalidFeedback = document.getElementById('email-invalid-feedback');

    if (isEmail(email.value)) {
        toggleIsValid(email);
    }
    else if (email.value == "" || email.value == null) {
        removeValidationClasses(email);
    }
    else {
        toggleIsInvalid(email);
        invalidFeedback.innerHTML = "Invalid email";
        return false;
    }

    return true;
}

function verifyEmailIsFree() {
    let email = document.getElementById('email');
    let invalidFeedback = document.getElementById('email-invalid-feedback');
    let flag = true;

    if (email.value != "" && email.value != null) {
        let handleResponse = function (response) {
            invalidFeedback.innerHTML = response['message'];

            if (response['status'] == 'success') {
                toggleIsValid(email);
            }
            else if (response['status'] == 'error') {
                toggleIsInvalid(email);
                flag = false;
            }
        };
        let uri = baseUrl() + '/register';
        let data = {
            'ajax': true,
            'verify-email-free': true,
            'email': email.value
        };

        JSONHttpRequest(uri, data, handleResponse);
    }
    else {
        removeValidationClasses(email);
    }

    return flag;
}

function validatePassword() {
    let password = document.getElementById('password');
    let invalidFeedback = document.getElementById('password-invalid-feedback');

    if (isPassword(password.value)) {
        toggleIsValid(password);
    }
    else if (password.value == "" || password.value == null) {
        removeValidationClasses(password);
    }
    else {
        toggleIsInvalid(password);
        invalidFeedback.innerHTML = "The password must be 8+ characters long, and contain at least one numeric digit, one uppercase and one lowercase letter";
        return false;
    }

    return true;
}

function validateConfirmPassword() {
    let password = document.getElementById('password');
    let confirmPassword = document.getElementById('confirm-password');
    let invalidFeedback = document.getElementById('confirm-password-invalid-feedback');

    if (password.value == confirmPassword.value && !(confirmPassword.value == "" || confirmPassword.value == null)) {
        toggleIsValid(confirmPassword);
    }
    else if (confirmPassword.value == "" || confirmPassword.value == null) {
        removeValidationClasses(confirmPassword);
    }
    else {
        toggleIsInvalid(confirmPassword);
        invalidFeedback.innerHTML = "Confirm password doesn't match the given password.";
        return false;
    }

    return true;
}
