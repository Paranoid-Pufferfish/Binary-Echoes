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
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Special Elite', cursive;
            font-size: 50px;
            text-align: center;
            margin-top: 20%;
        }
        h1 {
            position: absolute;
            text-shadow: 0 0 10px #69181a;
            color: #69181a;
        }
        #layer-first {
            z-index: 1;
            animation: one 0.3s infinite;

        }
        #layer-second {
            z-index: 2;
            animation: two 0.3s infinite;

        }
        #layer-third {
            z-index: 3;
            animation: three 0.3s infinite;

        }


        @keyframes one {

            0% {
                transform: translateX(-20px);
            }
            20% {
                transform: translateX(20px);
                text-shadow: 0 0 30px #69181a;

                clip-path: polygon(0 0, 100% 0, 100% 31%, 0 31%);

            }
            
        }
        @keyframes two {
            
            20% {
                clip-path: polygon(0 61%, 100% 61%, 100% 100%, 0 100%);
                transform: translateX(-10px);
            }
            60% {
                clip-path: polygon(0 61%, 100% 61%, 100% 100%, 0 100%);
                transform: translateX(30px);
            }
        }
        @keyframes three {
            20% {
                clip-path: polygon(0 35%, 100% 33%, 100% 48%, 0 49%);
                transform: translateX(-5px);

            }
            60% {
                clip-path: polygon(0 35%, 100% 33%, 100% 48%, 0 49%);
                transform: translateX(25px);
            }
            70% {
                clip-path: polygon(0 35%, 100% 33%, 100% 48%, 0 49%);
                transform: translateX(5px);
            }
            
        }
    </style>
</head>
<body>
  <audio id="myAudio" autoplay loop>
        <source src="src/audio/1.wav" type="audio/wav">
        Your browser does not support the audio element.
    </audio>

    <div class="glitch-container">
    <span class="glitch">
        <h1 id="layer-first">It's moving...It's</h1>
        <h1 id="layer-second">It's moving...It's</h1>
        <h1 id="layer-third">It's moving...It's</h1>
        <h1 class="glitchy-h1"><span>alive</span></h1>
        <br><br><br>
        <h2 class="glitch"><span>Coming</span> <span>Soon</span>...</h2>
	</span>
    </div>
</body>
</html>
