<!DOCTYPE html>
<html>
<head>
<script>
  // Function to generate a random glitchy string
  function generateGlitchyString(length) {
    const characters = "▒░abiJPOSPOWDJ)ODJWJ#_()+#()($*▓█╢┼ЁжЊ╘Д╙╡ЅЖЖЖЖЖД█▓▒░╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼╔╗╚╝■▀▄▌▐§▬↨↑↓→←∟↔▲▼►◄┼";
    let result = "";
    for (let i = 0; i < length; i++) {
      result += characters.charAt(Math.floor(Math.random() * characters.length));
    }
    return result;
  }

  const glitchyStrings = [
    generateGlitchyString(20),
    generateGlitchyString(20),
    generateGlitchyString(20),
    generateGlitchyString(20),
    generateGlitchyString(20)
  ];

  function changeTitle() {
    let index = 0;
    setInterval(() => {
      document.title = glitchyStrings[index % glitchyStrings.length];
      index++;
    }, 1);
  }

  window.onload = changeTitle;
</script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="glitch-container">
        <h1 class="glitch"><span>It's moving... It's a╔▐l╗#▓▬i┼▬↨▌v▐▄▐e▼◄↓↨■</span></h1>
        <br><br><br>
        <h2 class="glitch"><span>Coming</span> <span>Soon</span>...</h2>
    </div>
</body>
</html>
