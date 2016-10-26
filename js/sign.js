cv = document.querySelector('#sign-canvas');
signaturePad = new SignaturePad(cv);

signaturePad.onEnd = function() {
    $("#btn-sign").removeAttr("disabled");
}

$("#btn-sign").click(function () {
    sign(cv);
});

function sign(cv) {
    if (signaturePad.isEmpty())
    {
        alert("Please provide signature first.");
    }
    else
    {
	s = signaturePad.toDataURL();
	$("#sig").attr('src', s);
	$("#sign-form").hide();
	$("#final-form").show();
	saveViaAJAX('save.php');
	setTimeout(function() {
	    location.reload();
	}, 5000);
    }
}
