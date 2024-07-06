<?php // ce fichier recupere les données horaires depuis la bdd mongoDB afin de les afficher dans le footer 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/MongoDBConnection.php';
require_once __DIR__ . '/../../models/mongoDB/class_horaire.php';

use ecf_arkadia\Config\MongoDBConnection;
use ecf_arkadia\Models\HoraireManager;

try {
    $mongoConnection = new MongoDBConnection();
    $mongoClient = $mongoConnection->connect();

    $horaireManager = new HoraireManager();
    $horaires = $horaireManager->obtenirHoraires();

    if (empty($horaires)) {
        error_log("Aucun horaire trouvé dans la base de données.");
    } else {
        error_log("Horaires récupérés : " . print_r($horaires, true));
    }
} catch (Exception $e) {
    error_log("Erreur lors de la récupération des horaires : " . $e->getMessage());
    $horaires = [];
}
