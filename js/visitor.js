function getParameterByName(name, url) {
    if (!url) {
	url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var onFailSoHard = function(e) {
    console.log('Reeeejected!', e);
};
var onError = function(e) {
    console.log('Errrrror!', e);
};

window.URL = window.URL || window.webkitURL;
navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia || navigator.msGetUserMedia;


// This portion of the code save canvass to server
function saveViaAJAX(url) {

    var canvas = document.querySelector('#image');
    var posting = $.post(url,
			 {
			     'visitor_name' : $("#visitor_name").val(),
			     'visitor_email': $("#visitor_email").val(),
			     'visited_email': $("#visited_email").val(),
			     'photo'        : canvas.toDataURL('image/jpeg'),
			     'sig'          : $("#sig").attr('src')
			 }
			);
}

