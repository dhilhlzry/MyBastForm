window.onload = function () {
    var canvas2 = document.getElementById("canvas2");
    var signaturePad2 = new SignaturePad(canvas2);

    document.getElementById("clear2").addEventListener("click", function () {
        signaturePad2.clear();
    });

    document
        .getElementById("form2")
        .addEventListener("submit", function (event) {
            var signatureData2 = signaturePad2.toDataURL();
            document.getElementById("signature2").value = signatureData2;
        });
};
