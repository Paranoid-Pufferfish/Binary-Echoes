<?php
// Start session
session_start();

// Check if session is active
if (isset($_SESSION['user_id'])) {
    // Redirect to game.php
    header('Location: game.php');
    exit; // Ensure that script stops executing after redirect
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Echos</title>
  <link rel="stylesheet" href="style.css">
  <!-- Include Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
  <div class="container">
    <form action="/test.php" class="login" method="post">
      <h1><img src="image/logo.svg" alt="logo"></h1>
      
<div class="main">
  <hr>
  <div class="input">
    <input type="text" placeholder="Team ID" name="id" required>
  </div>

  <div class="input">
    <input type="password" placeholder="Password" name="password" required>
  </div>

  <div class="button">
    <button type="submit">LOG IN</button>
  </div>

  <hr>
</div>


        <div class="icone">
          <a href="https://www.instagram.com/bwb.club"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/company/binary-world-bejaia/about/"><i class="fab fa-linkedin"></i></a>
          <a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a>
        </div>

        <p>© 2024 Binary World Bejaia</p>
    </form>





  </div>
</body>
</html>
