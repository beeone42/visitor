var video = document.querySelector('video');
var canvas = document.querySelector('#image');
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

$("#btn-infos").click(function () {
    $("#infos-form").hide();
    $("#photo-form").show();
});

$("#btn-photo").click(function () {
    shoot();
    $("#photo-form").hide();
    $("#sign-form").show();
});

function shoot() {
    if (localMediaStream)
    {
	var src_w, src_h;
	
	src_h = video.videoHeight;
	src_w = (src_h * 320) / 240;
	ctx.drawImage(video, 0, 0, src_w, src_h, 0, 0, 320, 240);
	$("#photo").attr('src', canvas.toDataURL('image/jpeg'));
    }
    return (false);
}

