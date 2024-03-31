<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ECHOES : Alternate Reality Game</title>
    <link rel="stylesheet" href="./static/game.css" />
    <link rel="icon" type="images/x-icon" href="./static/images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-DmJbaM4f6IStX6uNi0+zefv/5WkhLiu3SmV+4CkUKhXND0M0M0UafP8vbPWbI1l+" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poor+Story&display=swap" />
    <meta name="theme-color" content="#19333E">
</head>

<body>

    <div id="loader-container">
        <div></div>
    </div>

    <header>
        <h1 id="logo">Echoes</h1>
        <nav></nav>
        <p class="footer">© 2024 Binary World Bejaia</p>
    </header>

    <main class="empty">
        <div id="chapter-container">

            <div class="chapter-header">
                <img src="./static/images/livre.png" />
                <h1>Chapter 1</h1>
            </div>

            <div class="chapter-content">
                <div class="chapter-section">
                    <h2>Description</h2>
                    <p id="chapter-description"></p>
                </div>

                <div class="chapter-section chapter-start">
                    <a href="" id="chapter-pdf" download target="_blank">
                        Start now
                    </a>
                </div>
            </div>

            <div class="chapter-footer">
                <div class="chapter-section">
                    <h2>Submission</h2>
                    <form>
                        <input type="text" placeholder="Code..." />
                        <button type="submit">
                            SUBMIT
                        </button>
                    </form>
                    <p></p>
                </div>
            </div>
        </div>

    </main>
</body>
<script src="./static/game.js"></script>

</html>