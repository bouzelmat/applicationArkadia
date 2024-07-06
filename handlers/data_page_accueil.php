<?php
// Ce fichier recupère les données de la BDD pour afficher le contenu dynamique sur la page d'accueil
require_once '../config/Database.php'; 
require_once '../models/class_habitat.php';
require_once '../models/class_animal.php';
require_once '../models/class_service.php';
require_once '../models/class_employe.php'; // la classe Employe qui encapsule Avis

$database = new \ecf_arkadia\Config\Database();
$db = $database->getConnection();

$habitatModel = new \ecf_arkadia\Models\Habitat($db);
$animalModel = new \ecf_arkadia\Models\Animal($db);
$serviceModel = new \ecf_arkadia\Models\Service($db);
$employeModel = new \ecf_arkadia\Models\Employe($db);

$habitats = $habitatModel->read()->fetch_all(MYSQLI_ASSOC);
$animaux = $animalModel->read()->fetch_all(MYSQLI_ASSOC);
$services = $serviceModel->read()->fetch_all(MYSQLI_ASSOC);
$avis = $employeModel->readAvisValide()->fetch_all(MYSQLI_ASSOC);

?>


