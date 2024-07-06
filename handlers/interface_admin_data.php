<!-- ce fichier va inclure tous les fichiers neccessaires au traitement de l'interface admin ainsi que l'instanciation des classes. également, ce fichier va contenir directement une fonctionnalités de l'interface admin : bloc de code responsable de la récupération des données de clics sur les images d'animaux depuis MongoDB et de leur préparation pour l'affichage dans un graphique JavaScript -->
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../config/Database.php';
require_once '../models/class_role.php';
require_once '../models/class_admin.php';
require_once '../models/class_rapportVeterinaire.php';
require_once '../models/class_animal.php';
require_once '../models/class_Service.php';
require_once '../models/class_Habitat.php';
require_once '../vendor/autoload.php';
require_once '../config/MongoDBConnection.php';

use ecf_arkadia\Config\MongoDBConnection;

$mongoConnection = new MongoDBConnection();
$mongoClient = $mongoConnection->connect();

$database = new \ecf_arkadia\Config\Database();
$db = $database->getConnection();
$admin = new \ecf_arkadia\Models\Administrateur($db, $mongoClient);
$rapportVeterinaire = new \ecf_arkadia\Models\RapportVeterinaire($db);
$serviceModel = new \ecf_arkadia\Models\Service($db);
$habitatModel = new \ecf_arkadia\Models\Habitat($db);
$animalModel = new \ecf_arkadia\Models\Animal($db);

// lire les animaux
try {
    $animaux = $animalModel->read();
    if ($animaux === null) {
        throw new Exception("Erreur lors de la lecture des animaux.");
    } else {
        $_SESSION['animaux'] = $animaux;
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

$animaux = $_SESSION['animaux'] ?? [];

$services = $serviceModel->read();
$habitats = $habitatModel->read();

$action = $_POST['action'] ?? null;
$id = $_POST['id'] ?? null;

// inclusion des fichiers de traitement
$files_to_include = [
    'admin_process_create_user.php',
    'admin_process_filter_vet_reports.php',
    'admin_process_manage_services.php',
    'admin_process_manage_habitats.php',
    'admin_process_manage_animals.php',
  
];

foreach ($files_to_include as $file) {
    if (file_exists($file)) {
        include $file;
    } else {
        error_log("Le fichier $file n'existe pas.");
    }
}

// gestion des redirections si nécessaire
if (isset($_SESSION['redirect'])) {
    header('Location: ' . $_SESSION['redirect']);
    unset($_SESSION['redirect']);
    exit();
}

// récupérer les clics depuis MongoDB
try {
    $mongo = new MongoDBConnection();
    $client = $mongo->connect();
    $collection = $client->ecf_arkadia->image_clicks;

    // récupéreration de tous les documents d'images avec leur nombre de clics
    $clicks = $collection->find()->toArray();


    $labels = [];
    $clics = [];

    foreach ($clicks as $click) {
        $labels[] = (int) $click['animal_id']; 
        $clics[] = (int) $click['clicks']; 
    }

    // encodage des données pour être utilisées dans JavaScript
    $labelsEncoded = json_encode($labels);
    $clicsEncoded = json_encode($clics);
} catch (Exception $e) {
    $labelsEncoded = json_encode([]);
    $clicsEncoded = json_encode([]);
}

?>