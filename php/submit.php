<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');
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

// Fonction pour récupérer les chapitres débloqués par une équipe
function getUnlockedChapters($teamId, $dbConnection) {
    // Requête pour récupérer les chapitres débloqués par l'équipe
    $query = "SELECT chapterId FROM Submits WHERE teamId = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("s", $teamId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Créer un tableau pour stocker les chapitres débloqués
    $unlockedChapters = array();
    
    // Parcourir les résultats et ajouter les chapitres débloqués au tableau
    while ($row = $result->fetch_assoc()) {
        $unlockedChapters[] = $row['chapterId'];
    }
    
    return $unlockedChapters;
}
// Exemple d'utilisation
$teamId = "Team Zarbou3i";
$chapterId = "Chapter2";



if (hasUnlockedChapter($teamId, $chapterId, $conn)) {
    echo "L'équipe a débloqué le chapitre $chapterId.";
} else {
    echo "L'équipe n'a pas débloqué le chapitre $chapterId.";
}


$unlockedChapters = getUnlockedChapters($teamId, $conn);
echo "Les chapitres débloqués par l'équipe sont : " . implode(", ", $unlockedChapters);


$conn->close();

