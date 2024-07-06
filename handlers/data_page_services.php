<?php
// ce fichier récupère les données de la bdd, ensuite ces données sont traitées par le fichier services.js pour effectuer l'affichage sur la page service.
require_once '../config/Database.php';
require_once '../models/class_Service.php';

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
