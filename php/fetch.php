<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');
$id = $_SESSION['id'];

$host = "srv1160.hstgr.io";
$username = "u209047910_echoes";
$password = "Echoes123#";
$database = "u209047910_echoes";

$conn = new mysqli($host, $username, $password, $database);
function hasUnlockedChapter($teamId, $chapterId, $dbConnection) {
    // Requête pour vérifier si l'équipe a soumis ce chapitre
    $query = "SELECT * FROM Submits WHERE teamId = ? AND chapterId = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("ss", $teamId, $chapterId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Retourner vrai si le chapitre est débloqué par l'équipe, faux sinon
    return $result->num_rows > 0;
}

function fetchChapters($conn, $id) {

    // Establish database connection

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
            } else {
                // Check if the chapter is unlocked by the team
                $teamId = $id; // Replace with the actual team ID
                $chapterId = $row['id'];
                $unlocked = hasUnlockedChapter($teamId, $chapterId, $conn);

                // Add the 'checked' parameter to the row
                $row['checked'] = $unlocked ? 1 : 0;
                if($unlocked == 1){
                // Get the unlock date for the chapter
                $unlockDate = getUnlockDate($teamId, $chapterId, $conn);
                $row['unlockDate'] = $unlockDate;
                }
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
}

function getUnlockDate($teamId, $chapterId, $conn) {
    // Prepare SQL statement to retrieve unlock date
    $stmt = $conn->prepare("SELECT date FROM Submits WHERE teamId = ? AND chapterId = ?");
    $stmt->bind_param("ss", $teamId, $chapterId);
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if unlock date is found
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['date'];
    } else {
        return null;
    }
}

// Call the function to fetch chapters
fetchChapters($conn, $id);
