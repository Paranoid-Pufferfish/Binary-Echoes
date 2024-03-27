<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$host = "srv1160.hstgr.io";
$username = "u209047910_echoes";
$password = "Echoes123#";
$database = "u209047910_echoes";

// Establish database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input from login form
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve user with provided id and password
    $stmt = $conn->prepare("SELECT * FROM Team WHERE id = ? AND password = ?");
    $stmt->bind_param("ss", $id, $password);

    // Execute the prepared statement
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if a matching user is found
    if ($result->num_rows == 1) {
        // User authenticated successfully
        // Start a session and set session variables
        $_SESSION['id'] = $id;
        $_SESSION['authenticated'] = true;

        // Update lastLogin entry
        $updateStmt = $conn->prepare("UPDATE Team SET lastLogin = NOW() WHERE id = ?");
        $updateStmt->bind_param("s", $id);
        $updateStmt->execute();

        // Redirect to a secure page or perform any other action
        header("Location: /login/game.html");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid credentials. Please try again.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
