<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Display the connected TeamID
$teamID = $_SESSION['id']; // Assuming the TeamID is stored in the session variable 'id'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echos</title>
    <link rel="stylesheet" href="game.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-DmJbaM4f6IStX6uNi0+zefv/5WkhLiu3SmV+4CkUKhXND0M0M0UafP8vbPWbI1l+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poor+Story&display=swap">

</head>

<body>

    <div class="menu">
        <h1><img src="image/logo.svg" alt="logo"></h1>

        <div class="chapitre">
            <hr>
            <div class="button1">
                <button type="button">Chapitre 1 </button>
                <img src="image/flecheb.png">
            </div>
            <div class="button2">
                <button type="button">Chapitre 2</button>
                <img src="image/lock.png">
            </div>
            <div class="button2">
                <button type="button">Chapitre 3 </button>
                <img src="image/lock.png">
            </div>

        </div>
        <div class="footer">
            <p><span style="font-family: 'Poppins';">© 2024 Binary World Bejaia</span></p>
<p>Connected TeamID: <?php echo $teamID; ?></p>
        </div>

    </div>
    <div class="main">
        <header>
            <img src="image/livre.png">
            <h1>Chapitre 1</h1>
        </header>

        <div class="intro">
            <h2>Introduction</h2>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem nemo nihil, ad quasi magni ducimus
                laboriosam nisi impedit expedita quas eaque. Error atque consectetur aut quam amet nemo nesciunt
                incidunt?</p>
        </div>
        <div class="submit">
            <h2>Submition</h2>
            <hr>
            <div class="submit-code">
                <input type="text" placeholder="Code">
                <button type="submit">SUBMIT <span style="float: right;margin-right: 8px;"><img
                            src="image/flechen.png"></span></button>
            </div>

        </div>
        <div class="ressources">
            <h2>Ressources</h2>
            <hr>
            <a href="" download>
                <button><span style="font-size: large;">Journal1.pdf</span><span
                        style="float: right;margin-right: 10px;"><img src="image/download.png"></span></button>
            </a>
        </div>

    </div>



</body>

</html>
