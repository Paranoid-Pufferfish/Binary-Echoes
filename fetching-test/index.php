<?php
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

// Prepare SQL statement to retrieve chapter data by ID
$stmt = $conn->prepare("SELECT description, journalUrl, id FROM Chapter WHERE id = ?");
$stmt->bind_param("s", $chapter_id); // Assuming Chapter ID is a varchar
$chapter_id = "Chapter1"; // Chapter ID to retrieve

// Execute the prepared statement
$stmt->execute();

// Store the result
$result = $stmt->get_result();

// Check if a matching chapter is found
if ($result->num_rows == 1) {
    // Fetch data
    $chapter_data = $result->fetch_assoc();

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();

    // Output chapter data
    echo "<h1>Chapter Details</h1>";
    echo "<p><strong>ID:</strong> " . $chapter_data['id'] . "</p>";
    echo "<p><strong>Description:</strong> " . $chapter_data['description'] . "</p>";
    echo "<p><strong>Journal URL:</strong> <a href='" . $chapter_data['journalUrl'] . "' target='_blank'>" . $chapter_data['journalUrl'] . "</a></p>";
} else {
    // Chapter not found
    echo "Chapter not found";
}

?>
