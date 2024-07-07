<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ce fichier récupère les données de la bdd, ensuite ces données sont traitées par le fichier services.js pour effectuer l'affichage sur la page service.
require_once '../config/Database.php';
require_once '../models/class_service.php';

$database = new \ecf_arkadia\Config\Database();
$db = $database->getConnection();

$service = new \ecf_arkadia\models\Service($db);
$stmt = $service->read();
$services = [];
while ($row = $stmt->fetch_assoc()) {
    $services[] = $row;
}

header('Content-Type: application/json');
echo json_encode($services);
?>
