
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

// Check if the Chapter ID is provided in the GET request
if (isset($_GET['id'])) {
    $chapter_id = $_GET['id'];

    // Prepare SQL statement to retrieve chapter data by ID
    $stmt = $conn->prepare("SELECT description, journalUrl FROM Chapter WHERE id = ?");
    $stmt->bind_param("s", $chapter_id); // Assuming Chapter ID is an integer

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

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($chapter_data);
        exit();
    } else {
        // Chapter not found
        http_response_code(404);
        echo json_encode(array("error" => "Chapter not found"));
        exit();
    }
} else {
    // Chapter ID not provided
    http_response_code(400);
    echo json_encode(array("error" => "Chapter ID not provided"));
    exit();
}
?>
