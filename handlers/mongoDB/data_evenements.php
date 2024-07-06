<?php
// ce fichier est utilisé pour afficher les évenements sur la page service du site web. son traitement est utilisé par le fichier evenements.js.
require_once '../../vendor/autoload.php';
require_once '../../config/MongoDBConnection.php';
require_once '../../models/mongoDB/class_evenement.php';

use ecf_arkadia\Config\MongoDBConnection;
use ecf_arkadia\Models\Evenement;

$mongo = new MongoDBConnection();
$client = $mongo->connect();

$evenementModel = new Evenement();

$evenements = $evenementModel->readAll();

// envoi des données au format JSON
header('Content-Type: application/json');
echo json_encode($evenements);
?>
