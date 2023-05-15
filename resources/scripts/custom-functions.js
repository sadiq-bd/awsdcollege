
function html(element) {
    var elements = document.querySelectorAll(element);
    if (elements.length == 1) {
        return elements[0];
    } else {
        return elements;
    }
}


function xhr(info) {
    var url = typeof info === 'string' ? info : info['url'];
    var method = typeof info['method'] !== 'undefined' ? info['method'] : 'GET';
    var async = typeof info['async'] !== 'undefined' ? info['async'] : false;
    var onloadCallback = typeof info['onload'] !== 'undefined' ? info['onload'] : false;
    var headers = typeof info['headers'] !== 'undefined' ? info['headers'] : {};
    var postBody = typeof info['postBody'] !== 'undefined' ? info['postBody'] : null;

    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        onloadCallback(this);
    };
    xhr.open(method, url, async);

    for (let i in headers) {
        xhr.setRequestHeader(i, headers[i]);
    } 

    postBody === null ? xhr.send() : xhr.send(postBody);
    return xhr;
}


