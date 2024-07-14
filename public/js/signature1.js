window.onload = function () {
    var canvas = document.getElementById("canvas1");
    var signaturePad = new SignaturePad(canvas);

    document.getElementById("clear").addEventListener("click", function () {
        signaturePad.clear();
    });
    // Menangkap tanda tangan saat formulir dikirim
    document.querySelector("form").addEventListener("submit", function (event) {
        // Mengambil tanda tangan dalam format base64
        var signatureData = signaturePad.toDataURL();
        // Menetapkan nilai tanda tangan ke input tersembunyi
        document.getElementById("signature1").value = signatureData;
    });
};
