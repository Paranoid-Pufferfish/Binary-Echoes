<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">

<script>
  // Function to generate a random glitchy string
  function generateGlitchyString(length) {
    const characters = "▒░▓█╢┼ЁжЊ╘Д╙╡ЅЖЖЖЖЖД█▓▒░╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟▲▼►◄┼";
    let result = "";
    for (let i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
  }

  // Function to generate a glitchy title
  function generateGlitchyTitle() {
    let title = "";
    const staticText = "a l i v e";
    const staticTextLength = staticText.length;
    const staticTextIndexes = [Math.floor(Math.random() * 20), Math.floor(Math.random() * 20), Math.floor(Math.random() * 20), Math.floor(Math.random() * 20), Math.floor(Math.random() * 20)]; // Generate random indexes for dispersing "a l i v e"
    let staticTextIndex = 0;
    let index = 0;
    for (let i = 0; i < 20; i++) {
      if (staticTextIndexes.includes(i)) {
        title += staticText.charAt(staticTextIndex);
        staticTextIndex++;
        index++;
      } else {
        title += generateGlitchyString(1);
        index++;
      }
    }
    return title;
  }

  // Function to change the title and h1 content rapidly
  function changeTitleAndH1() {
    let index = 0;
    setInterval(() => {
      const h1Element = document.querySelector('.glitchy-h1'); // Specify the class of the h1 element
      if (h1Element) {
        h1Element.innerText = generateGlitchyTitle();
      }
      document.title = generateGlitchyTitle();
    }, 100); // Change title and h1 content every 100 milliseconds
  }

  // Call the function when the page loads
  window.onload = changeTitleAndH1;
  document.addEventListener('click', function() {
  var audio = document.getElementById('myAudio');
  if (audio.paused) {
    audio.play();
  }
});
</script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <audio id="myAudio" autoplay loop>
        <source src="src/audio/1.wav" type="audio/wav">
        Your browser does not support the audio element.
    </audio>

    <div class="glitch-container">
        <h1 class="glitch"><span>It's moving...It's</span></h1>
        <h1 class="glitchy-h1"><span>alive</span></h1>
        <br><br><br>
        <h2 class="glitch"><span>Coming</span> <span>Soon</span>...</h2>
    </div>
</body>
</html>
