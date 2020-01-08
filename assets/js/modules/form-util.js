export function removeValidationClasses(element) {
    element.classList.remove('is-valid');
    element.classList.remove('is-invalid');
    return element;
}

export function toggleIsValid(element) {
    element.classList.add('is-valid');
    element.classList.remove('is-invalid');
    return element;
}

export function toggleIsInvalid(element) {
    element.classList.add('is-invalid');
    element.classList.remove('is-valid');
    return element;
}