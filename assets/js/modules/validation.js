export function isPassword(password) {
    let pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,64}$/
    if (password.match(pattern)) {
        return true;
    }
    return false;
}

export function isEmail(email) {
    let pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (String(email).toLowerCase().match(pattern)) {
        return true;
    }
    return false;
}

export function isName(name) {
    if (name.length > 128) {
        return false;
    }
    return true;
}
