window.onload = function () {
    var canvas3 = document.getElementById("canvas3");
    var signaturePad3 = new SignaturePad(canvas3);

    document.getElementById("clear3").addEventListener("click", function () {
        signaturePad3.clear();
    });

    document
        .getElementById("form3")
        .addEventListener("submit", function (event) {
            var signatureData3 = signaturePad3.toDataURL();
            document.getElementById("signature3").value = signatureData3;
        });
};
