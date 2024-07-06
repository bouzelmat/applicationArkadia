<?php
// Ce fichier reçoit les requêtes AJAX venant du fichier scriptHabitats.js pour enregistrer les clics (sur les images animaux) dans MongoDB.

require '../../vendor/autoload.php';
require '../../config/MongoDBConnection.php';

use ecf_arkadia\Config\MongoDBConnection;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['animal_id'])) {
    $animalId = $_POST['animal_id'];

    try {
        
        $mongoDB = new MongoDBConnection();
        $client = $mongoDB->connect();
        $collection = $client->ecf_arkadia->image_clicks; // nom de la collection

        // mettre à jour le document de l'animal
        $result = $collection->updateOne(
            ['animal_id' => $animalId],
            ['$inc' => ['clicks' => 1]],
            ['upsert' => true]
        );

        // gestion des réponses et des erreurs dans le script PHP
        echo json_encode(['status' => 'success', 'message' => 'Clic enregistré']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Requête invalide']);
}


