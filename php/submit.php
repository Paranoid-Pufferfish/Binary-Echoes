<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');
$id = $_SESSION['id'];
function addTeamToSubmits($teamId, $chapterId, $chapterCode, $dbConnection) {
    // Vérifier si le code du chapitre est valide pour l'ID donné
    $query = "SELECT id FROM Chapter WHERE id = ? AND code = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("ss", $chapterId, $chapterCode);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        // Insérer une nouvelle ligne dans la table Submits
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


// Fonction pour récupérer les chapitres débloqués par une équipe
function getUnlockedChapters($teamId, $dbConnection) {
    // Requête pour récupérer les chapitres débloqués par l'équipe avec la date
    $query = "SELECT chapterId, date FROM Submits WHERE teamId = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("s", $teamId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Créer un tableau pour stocker les chapitres débloqués avec la date
    $unlockedChapters = array();
    
    // Parcourir les résultats et ajouter les chapitres débloqués avec la date au tableau
    while ($row = $result->fetch_assoc()) {
        $unlockedChapters[] = array(
            'chapterId' => $row['chapterId'],
            'date' => $row['date']
        );
    }
    
    return $unlockedChapters;
}
// Exemple d'utilisation
$teamId = $id;
$chapterId = $_GET['chapterId'] ?? '';
$chapterCode = $_GET['chapterCode'] ?? '';


$function = $_GET['function'] ?? '';

if ($function === 'getUnlockedChapters') {
    $unlockedChapters = getUnlockedChapters($teamId, $conn);
    header('Content-Type: application/json'); // Set the content type to JSON
    echo json_encode($unlockedChapters);
} elseif ($function == 'addTeamToSubmits'){
    if (addTeamToSubmits($teamId, $chapterId, $chapterCode, $conn)) {
        $result = true;
    } else {
        $result = false;
    }
    header('Content-Type: application/json'); // Set the content type to JSON
    echo json_encode($result);
} else {
    echo "Invalid function specified.";
}




$conn->close();

