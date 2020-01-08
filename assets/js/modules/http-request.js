/**
 * Sends JSON data to the specified URI and the parsed JSON response gets passed through the func param.
 * @param {string} uri
 * @param {JSON Object} data
 * @param {function(response)} func
 * @param {string} method
 * @param {boolean} async
 */
export function JSONHttpRequest(uri, data, func, method = 'POST', async = true) {
    let request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let response = JSON.parse(this.responseText);
            func(response);
        }
    };

    request.open(method, uri, async);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(JsonToUrlEncoded(data));
}

/**
 * Converts a JSON object into a x-www-form-urlencoded string.
 * @param {JSON Object} json - Should only be used when all elements are string.
 * @returns {null|string}
 */
function JsonToUrlEncoded(json) {
    if (typeof json !== 'object') {
        console.log('Invalid JSON object');
        return null;
    }

    let keys = Object.keys(json);
    let url = "";

    for (let i = 0; i < keys.length; i++) {
        url += encodeURIComponent(keys[i]) + '=' + encodeURIComponent(json[keys[i]]);
        if (i < (keys.length - 1)) {
            url += '&';
        }
    }

    return url;
}