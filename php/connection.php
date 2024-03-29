<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$host = "srv1160.hstgr.io";
$username = "u209047910_echoes";
$password = "Echoes123#";
$database = "u209047910_echoes";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Team WHERE id = ? AND password = ?");
    $stmt->bind_param("ss", $id, $password);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['id'] = $id;
        $_SESSION['authenticated'] = true;

        $updateStmt = $conn->prepare("UPDATE Team SET lastLogin = NOW() WHERE id = ?");
        $updateStmt->bind_param("s", $id);
        $updateStmt->execute();

        header("Location: /login/game.php");
        exit();
    } else {
        echo "Invalid credentials. Please try again.";
    }

    $stmt->close();
}
#$conn->close();
