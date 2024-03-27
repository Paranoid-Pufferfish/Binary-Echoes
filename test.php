<?php

session_start();


$servername = "srv1160.hstgr.io";
$username = "u209047910_echoes";
$password = "Echoes123#";
$dbname = "u209047910_echoes";


$id = $_POST['id'];
$password = $_POST['password'];


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
    echo "Connexion reussite a la base de données MySQL" ;

$sql = "SELECT * FROM Team WHERE id = '$id' AND password = '$password'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $_SESSION['team_id'] = $row["id"]; // Stocker l'ID de l'équipe dans la session

    // Mettre à jour la dernière connexion de l'équipe
    $teamId = $row["id"];
    $date = date("Y-m-d");
    $updateSql = "UPDATE Team SET lastLogin = '$date' WHERE id = '$teamId'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Connexion réussie ! Dernière connexion mise à jour.";
    } else {
        echo "Erreur lors de la mise à jour de la dernière connexion : " . $conn->error;
    }
} else {

    echo "ID ou mot de passe incorrect.";
}

$conn->close();
?>
