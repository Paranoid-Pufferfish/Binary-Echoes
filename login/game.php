<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: /login/index.php"); // Redirect to login page if not logged in
    exit();
}

// Display the connected TeamID
$teamID = $_SESSION['id']; // Assuming the TeamID is stored in the session variable 'id'
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Echos</title>
    <link rel="stylesheet" href="game.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      integrity="sha384-DmJbaM4f6IStX6uNi0+zefv/5WkhLiu3SmV+4CkUKhXND0M0M0UafP8vbPWbI1l+"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poor+Story&display=swap"
    />
  </head>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Sélectionnez les boutons
      var chapters = [
        {
          id: 1,
          descripton: "test",
          journalUrl: "jdbkabd",
          locked: false,
        },
        {
          id: 2,
          descripton: null,
          journalUrl: null,
          locked: false,
        },
        {
          id: 3,
          descripton: null,
          journalUrl: null,
          locked: true,
        },
      ];

      var pdfLink = document.querySelector(" #journal");

      function showChapter(n) {
        let chapter = chapters[n - 1];

        if (!chapter.id || chapter.locked) return;

        document.querySelector("header h1").innerText =
          "Chapitre " + chapter.id;
        document.querySelector(".intro p").innerText = chapter.descripton;
        pdfLink.textContent = "Journa" + chapter.id + ".pdf";
      }

      chapters.forEach((chapter) => {
        const button = document.createElement("button");
        button.setAttribute("type", "button");
        button.setAttribute("class", "button");

        // Vérifie si le chapitre est verrouillé
        if (chapter.locked) {
          button.classList.add("locked");
        }

        // Définit le texte du bouton en fonction de l'id du chapitre
        button.textContent = `Chapitre ${chapter.id}`;

        // Ajoute un event listener pour appeler la fonction showChapter avec l'id du chapitre
        button.addEventListener("click", () => {
          showChapter(chapter.id);
        });

        // Récupère l'élément avec l'identifiant #actions
        const actionsElement = document.querySelector("#actions");

        // Ajoute le bouton à l'élément #actions
        actionsElement.appendChild(button);
      });
    });
  </script>

  <body>
    <div class="menu">
      <h1><img src="image/logo.svg" alt="logo" /></h1>

      <hr />
      <div class="chapitre" id="actions"></div>

      <div class="footer">
        <p>
          <span style="font-family: 'Poppins'">© 2024 Binary World Bejaia</span>
        </p>
      </div>
    </div>
    <div class="main">
      <header>
        <img src="image/livre.png" />
        <h1>Chapitre 1</h1>
      </header>

      <div class="intro">
        <h2>Introduction</h2>
        <hr />
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem nemo
          nihil, ad quasi magni ducimus laboriosam nisi impedit expedita quas
          eaque. Error atque consectetur aut quam amet nemo nesciunt incidunt?
        </p>
      </div>
      <div class="submit">
        <h2>Submition</h2>
        <hr />
        <div class="submit-code">
          <input type="text" placeholder="Code" />
          <button type="submit">
            SUBMIT
            <span style="float: right; margin-right: 8px"
              ><img src="image/flechen.png"
            /></span>
          </button>
        </div>
      </div>
      <div class="ressources">
        <h2>Ressources</h2>
        <hr />
        <a href="" download>
          <button id="journal">
            <span style="font-size: large">Journal1.pdf</span
            ><span style="float: right; margin-right: 10px"
              ><img src="image/download.png"
            /></span>
          </button>
        </a>
      </div>
    </div>
  </body>
</html>
