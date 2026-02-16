function addText() {
    var text = document.getElementById("textInput").value;
    var canvas = document.createElement("canvas");
    var ctx = canvas.getContext("2d");

    var img = document.getElementById("image");
    canvas.width = img.width;
    canvas.height = img.height;

    ctx.drawImage(img, 0, 0);
    ctx.font = "30px Arial";
    ctx.fillStyle = "white";
    ctx.fillText(text, 50, 50);

    var downloadLink = document.getElementById("downloadLink");
    downloadLink.href = canvas.toDataURL("image/jpeg");
    downloadLink.download = "modified-image.jpg";
    downloadLink.style.display = "inline-block";
}