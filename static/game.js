const API_BASE_URL = "./api";

const loader = document.getElementById("loader-container");

document.addEventListener("DOMContentLoaded", async function () {
  function hideLoader() {
    loader.style.display = "none";
  }

  function showLoader() {
    loader.style.display = "flex";
  }

  const chapterUI = {
    container: document.getElementById("chapter-container"),
    header: document.querySelector(".chapter-header h1"),
    description: document.querySelector("#chapter-description"),
    input: document.querySelector("form input"),
    submitBtn: document.querySelector("form button"),
    pdf: document.querySelector("#chapter-pdf"),
    form: document.querySelector("form"),
    formError: document.querySelector("form + p"),
  };

  // ------------------------ Récupération des chapitres du BackEnd -------------------------
  var chapters = [];
  await fetch(API_BASE_URL + "/chapters.php")
    .then((response) => response.json())
    .then((data) => {
      data.forEach((item) => {
        item.id = parseInt(item.id);
        item.locked = item.locked == "1";
        item.checked = item.checked == "1";
      });
      chapters = data;
      console.log({ chapters });
      hideLoader();
    });

  // ------------------------------- Initialisation du menu ----------------------------------
  chapters.forEach((chapter) => {
    const button = document.createElement("button");

    button.setAttribute("type", "button");
    button.setAttribute("class", "chapter-button");
    if (chapter.locked) button.classList.add("locked");
    if (chapter.checked) button.classList.add("checked");
    button.textContent = `Chapter ${chapter.id}`;

    button.addEventListener("click", () => {
      showChapter(chapter.id);
    });

    chapter.button = button;

    document.querySelector("header nav").appendChild(button);
  });

  // ---------------------------------- Affichage des chapitres ----------------------------------
  function showChapter(n) {
    let chapter = chapters[n - 1];
    if (!chapter.id || chapter.locked) return;

    document.getElementsByTagName("main")[0].classList.remove("empty");

    // Marquer le bouton du chapitre comme selectionnée et desactiver les autres s'ils le sont
    chapters.forEach((c) => {
      if (c == chapter) chapter.button.classList.add("selected");
      else c.button.classList.remove("selected");
    });
    chapterUI.input.value = "";
    chapterUI.container.style.display = "flex";
    chapterUI.header.innerText = "Chapter " + chapter.id;
    chapterUI.description.innerText = chapter.description;
    chapterUI.pdf.setAttribute("href", chapter.journalUrl);

    if (chapter.checked) {
      chapterUI.input.setAttribute("disabled", "true");
      chapterUI.input.classList.add("checked");
      chapterUI.input.setAttribute(
        "placeholder",
        "✅ • Chapter completed (" + chapter.unlockDate + ")"
      );
      chapterUI.submitBtn.style.display = "none";
    } else {
      chapterUI.input.removeAttribute("disabled");
      chapterUI.input.classList.remove("checked");
      chapterUI.input.setAttribute("placeholder", "Code...");
      chapterUI.submitBtn.style.display = "block";
    }
  }

  function markChapterAsChecked(n) {
    let chapter = chapters[n - 1];
    if (!chapter.id || chapter.locked) return;

    chapter.unlockDate = new Date().toISOString();
    chapter.unlockDate  = chapter.unlockDate.split('T')[0];
    chapter.checked = true;
    
    chapter.button.classList.add("checked");
    chapterUI.input.setAttribute("disabled", "true");
    chapterUI.input.classList.add("checked");
    chapterUI.input.setAttribute("placeholder", "✅ • Chapter completed (" + chapter.unlockDate + ")");
    chapterUI.input.value = "";
    chapterUI.submitBtn.style.display = "none";
  }

  // ----------------------------- Soumission du code pour le chapitre ---------------------------
  chapterUI.form.addEventListener("submit", async (e) => {
    e.preventDefault();
    chapterUI.input.classList.remove("error");
    chapterUI.formError.style.display = "none";
    chapterUI.formError.innerText = "";

    const code = chapterUI.input.value.trim();
    if (code.length == 0) return;

    showLoader();
    console.log("loading...");

    const chapter = chapters.find(
      (c) => c.id == parseInt(chapterUI.header.innerText.split(" ")[1])
    );

    await fetch(API_BASE_URL + "/submit.php", {
      method: "POST",
      headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `chapterId=${chapter.id}&code=${code}`,
    })
      .then((response) => response.text())
      .then((result) => {
      const success = JSON.parse(result).success;
      const message = JSON.parse(result).message;
      if (success == "true") {
        markChapterAsChecked(chapter.id);
      } else {
        if (message === "Team has already submitted for this chapter") {
        chapterUI.input.classList.add("error");
        chapterUI.formError.style.display = "block";
        chapterUI.formError.innerText = "Team has already submitted for this chapter ⚠️ Please Refresh the page";
        } else {
        chapterUI.input.classList.add("error");
        chapterUI.formError.style.display = "block";
        chapterUI.formError.innerText = "Invalid code ! ⚠️";
        }
      }
      })
      .catch((error) => {
        chapterUI.formError.style.display = "block";
        chapterUI.formError.innerText =
          "An error occurred while sending the request! ⚠️ You will be redirected to the login page in no time";
        setTimeout(() => {
          location.reload();
        }, 2000); // Refresh the page after 2 seconds
      });
    hideLoader();
  });
});
