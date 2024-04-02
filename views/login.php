<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echos</title>
    <link rel="stylesheet" href="./static/login.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <div id="loader-container">
        <div></div>
    </div>

    <main>
        <h1 id="logo">Echoes</h1>
        <form>
            <input type="text" placeholder="Team ID" id="id" required>
            <input type="password" placeholder="Password" id="password" required>
            <p></p>
            <button type="submit">LOG IN</button>
        </form>

        <footer>
            <ul>
                <a href="https://www.instagram.com/bwb.club"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/company/binary-world-bejaia/about/"><i class="fab fa-linkedin"></i></a>
                <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
            </ul>
            © 2024 Binary World Bejaia
        </footer>
    </main>
</body>
<script>
    document.addEventListener("DOMContentLoaded", async function() {

        const form = document.getElementsByTagName('form')[0];
        const idInput = document.getElementById('id');
        const passwordInput = document.getElementById('password');
        const error = document.querySelector("form p");
        const loader = document.getElementById("loader-container");

        function hideLoader() {
            loader.style.display = "none";
        }

        function showLoader() {
            loader.style.display = "flex";
        }

        function setError(message) {
            if (message == null) {
                error.innerText = "";
                idInput.classList.remove('error');
                passwordInput.classList.remove('error');
            } else {
                error.innerText = message;
                idInput.classList.add('error');
                passwordInput.classList.add('error');
            }
        }

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            showLoader();
            setError(null);
            const id = document.getElementById('id').value;
            const password = document.getElementById('password').value;
            await fetch('./api/auth.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${id}&password=${password}`,
                })
                .then((response) => response.text())
                .then((result) => {
                    const success = JSON.parse(result).success;
                    if (success == "true") window.location.reload();
                    else {
                        setError("Invalid credentials")
                        hideLoader();
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    setError("An error occured");
                    hideLoader();
                });
        });
    });
</script>

</html>