<?php
require('../database/connection.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}
$teamId = $_SESSION['id'];

function addTeamToSubmits($teamId, $chapterId, $chapterCode, $dbConnection)
{
    $query = "SELECT id FROM Chapter WHERE id = ? AND code = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("ss", $chapterId, $chapterCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $query_insert = "INSERT INTO Submits (teamId, chapterId, date) VALUES (?, ?, NOW())";
        $stmt_insert = $dbConnection->prepare($query_insert);
        $stmt_insert->bind_param("ss", $teamId, $chapterId);

        if ($stmt_insert->execute()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function getUnlockedChapters($teamId, $dbConnection)
{
    $query = "SELECT chapterId, date FROM Submits WHERE teamId = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("s", $teamId);
    $stmt->execute();
    $result = $stmt->get_result();

    $unlockedChapters = array();

    while ($row = $result->fetch_assoc()) {
        $unlockedChapters[] = array(
            'chapterId' => $row['chapterId'],
            'date' => $row['date']
        );
    }

    return $unlockedChapters;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $chapterId = $_POST['chapterId'] ?? '';
    $chapterCode = $_POST['code'] ?? '';
    $result = addTeamToSubmits($teamId, $chapterId, $chapterCode, $conn);

    if($result === true) {
        echo json_encode(["success"=> "true"]);
    } else {
        echo json_encode(["success"=> "false"]);
    }
}
$conn->close();
