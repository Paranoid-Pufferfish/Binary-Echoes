Cufon.now();

function telechargerPDF() {
  var produitSelectionne = document.getElementById("produits").value;
  if (produitSelectionne === "THETA X300") {
    var urlPDF = "THETA_X300.pdf"
    var nomPDF = "THETA_X300.pdf";
    var btn = document.createElement("a");
    btn.href = urlPDF;
    btn.download = nomPDF;
    document.body.appendChild(btn);
    btn.click();
    document.body.removeChild(btn);
  }
}

document
  .getElementById("telecharger")
  .addEventListener("click", telechargerPDF);

var text = "$$$R$$T$1$P$$$$M$1$X$$$X$X$X$$X$$$$$X";
var output = document.getElementById("output");

function updateText() {
  var newText = "";
  for (var i = 0; i < text.length; i++) {
    if (text[i] === "$") {
      var randomChar = getRandomChar();
      newText += randomChar;
    } else {
      newText += "<span class='fixed'>" + text[i] + "</span>";
    }
  }
  output.innerHTML = newText;
}

function getRandomChar() {
  var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  var randomIndex = Math.floor(Math.random() * chars.length);
  return chars[randomIndex];
}

setInterval(updateText, 160);