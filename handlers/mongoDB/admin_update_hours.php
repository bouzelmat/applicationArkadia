<?php
// ce fichier est utilsé pour enregistrer les nouvelles horaires dans la bdd. pour etre plus précis : ce fichier PHP est responsable du traitement côté serveur des nouvelles valeurs d'horaires envoyées depuis le script JavaScript (admin_scriptHoraire.js)
ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json');

try {
    require_once __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . '/../../config/MongoDBConnection.php';
    require_once __DIR__ . '/../../models/mongoDB/class_horaire.php';

    $rawData = file_get_contents('php://input'); // lit les données brutes envoyées dans le corps de la requête HTTP
    error_log("Données brutes reçues : " . $rawData);

    if (empty($rawData)) {  // vérifie si les données brutes sont vides
        throw new Exception("Aucune donnée reçue");
    }

    $data = json_decode($rawData, true);    // décode les données JSON en un tableau associatif PHP

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Erreur de décodage JSON : " . json_last_error_msg());
    }

    error_log("Données décodées : " . print_r($data, true));

    $horaireManager = new \ecf_arkadia\models\HoraireManager();
    
    // appel de la méthode nettoyerDoublons()
    $cleanResult = $horaireManager->nettoyerDoublons();
    if (!$cleanResult) {
        error_log("Avertissement : Le nettoyage des doublons a échoué");
    }

    $result = $horaireManager->modifierHoraires($data);

    if ($result) {
        echo json_encode(["success" => "Horaires modifiés avec succès"]);
    } else {
        throw new Exception("Erreur lors de la modification des horaires");
    }
} catch (Exception $e) {
    error_log("Erreur : " . $e->getMessage());
    echo json_encode(["error" => $e->getMessage()]);
}
