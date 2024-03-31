<?php
require('../database/connection.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(!isset($_SESSION['id']) || !isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('HTTP/1.1 401 Unauthorized');
    exit();
}

$id = $_SESSION['id'];

function hasUnlockedChapter($teamId, $chapterId, $dbConnection)
{
    // Requête pour vérifier si l'équipe a soumis ce chapitre
    $query = "SELECT * FROM Submits WHERE teamId = ? AND chapterId = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("ss", $teamId, $chapterId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Retourner vrai si le chapitre est débloqué par l'équipe, faux sinon
    return $result->num_rows > 0;
}

function fetchChapters($conn, $id)
{

    $stmt = $conn->prepare("SELECT id, description, journalUrl, locked FROM Chapter");
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $chapters = array();

        while ($row = $result->fetch_assoc()) {
            if ($row['locked'] == true) {
                unset($row['description']);
                unset($row['journalUrl']);
            } else {
                $teamId = $id;
                $chapterId = $row['id'];
                $unlocked = hasUnlockedChapter($teamId, $chapterId, $conn);

                $row['checked'] = $unlocked ? 1 : 0;
                if ($unlocked == 1) {
                    $unlockDate = getUnlockDate($teamId, $chapterId, $conn);
                    $row['unlockDate'] = $unlockDate;
                }
            }
            $chapters[] = $row;
        }

        $stmt->close();
        $conn->close();

        header('Content-Type: application/json');
        echo json_encode($chapters);
    } else {
        echo json_encode(array("error" => "No chapters found"));
    }
}

function getUnlockDate($teamId, $chapterId, $conn)
{
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

fetchChapters($conn, $id);
