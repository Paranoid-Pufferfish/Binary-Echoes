<?php
require('../database/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Team WHERE id = ? AND password = ?");
    $stmt->bind_param("ss", $id, $password);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION['authenticated'] = true;
        
        $updateStmt = $conn->prepare("UPDATE Team SET lastLogin = NOW() WHERE id = ?");
        $updateStmt->bind_param("s", $id);
        $updateStmt->execute();

        echo json_encode(["success"=> "true"]);
    } else {
        session_start();
        echo json_encode(["success"=> "false"]);
    }

    $stmt->close();
}
