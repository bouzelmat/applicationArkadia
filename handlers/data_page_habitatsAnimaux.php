<?php
// ce fichier recupere les données des habitas et des animaux et les rapports véterinaires depuis la bdd. concernant l'affichage des données : le fichier scriptHabitats.js va traiter l'affichage sur la pahe habitats et animaux
require_once '../config/Database.php'; 
require_once '../models/class_Habitat.php';
require_once '../models/class_Animal.php';
require_once '../models/class_RapportVeterinaire.php';

$database = new \ecf_arkadia\Config\Database();
$db = $database->getConnection();

$habitat = new \ecf_arkadia\Models\Habitat($db);
$animal = new \ecf_arkadia\Models\Animal($db);
$rapport = new \ecf_arkadia\Models\RapportVeterinaire($db);

$habitats = $habitat->read()->fetch_all(MYSQLI_ASSOC);
$animals = $animal->read()->fetch_all(MYSQLI_ASSOC);
$rapports = $rapport->readAll()->fetch_all(MYSQLI_ASSOC);

// mettre les données dans un tableau
$data = array("habitats" => $habitats, "animals" => $animals, "rapports" => $rapports);

// encodage les données en JSON
header('Content-Type: application/json');
echo json_encode($data);

?>
