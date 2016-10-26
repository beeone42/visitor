var onFailSoHard = function(e) {
    console.log('Reeeejected!', e);
};
var onError = function(e) {
    console.log('Errrrror!', e);
};

window.URL = window.URL || window.webkitURL;
navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia || navigator.msGetUserMedia;

var video = document.querySelector('video');
var canvas = document.querySelector('canvas');
var ctx = canvas.getContext('2d');
var localMediaStream = null;

if (navigator.getUserMedia) {
    navigator.getUserMedia({audio: false, video: true}, function(stream) {
	video.src = window.URL.createObjectURL(stream);
	localMediaStream = stream;
    }, onFailSoHard);
} else {
    video.src = 'oeil.png'; // fallback.
}
