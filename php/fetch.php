<?php
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Prepare SQL statement to retrieve chapter data
$stmt = $conn->prepare("SELECT id, description, journalUrl, locked FROM Chapter");

// Execute the prepared statement
$stmt->execute();

// Store the result
$result = $stmt->get_result();

// Check if any chapters are found
if ($result->num_rows > 0) {
    // Create an array to store all chapters
    $chapters = array();

    // Fetch data for each chapter
    while ($row = $result->fetch_assoc()) {
        // Check if the chapter is locked
        if ($row['locked'] == true) {
            // Remove unnecessary data
            unset($row['description']);
            unset($row['journalUrl']);
        }

        // Add the chapter to the array
        $chapters[] = $row;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();

    // Output chapters data as JSON
    header('Content-Type: application/json');
    echo json_encode($chapters);
} else {
    // No chapters found
    echo json_encode(array("error" => "No chapters found"));
}
