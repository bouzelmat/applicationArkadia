<!-- ce fichier va inclure tous les fichiers neccessaires au traitement de l'interface employe ainsi que l'instanciation des classes avec des methodes de lectures (read()) uniquement. quant aux autres operations du CRUD il faut consulter les autres fichier de traitement spécialisé (gestion des avis, gestion du rapport alimentaire...) de l'interface employe -->
<?php
require_once '../config/Database.php';
require_once '../models/class_animal.php';
require_once '../models/class_avis.php';
require_once '../models/class_service.php';
require_once '../models/class_alimentation.php';
require_once '../models/class_employe.php';
require_once '../vendor/autoload.php';
require_once '../config/MongoDBConnection.php';
require_once '../models/mongoDB/class_evenement.php';

$database = new \ecf_arkadia\Config\Database();
$db = $database->getConnection();

$animal = new \ecf_arkadia\Models\Animal($db);
$service = new \ecf_arkadia\Models\Service($db);
$alimentation = new \ecf_arkadia\Models\Alimentation($db);
$evenement = new \ecf_arkadia\Models\Evenement();

// instance de la classe Employe qui contient une instance de Avis
$employe = new \ecf_arkadia\Models\Employe($db);
$avis = $employe->getAvisInstance();

$animaux = $animal->read();
$avis_non_valide = $avis->readNonValide();
$services = $service->read();
$alimentations = $alimentation->read();
$evenements = $evenement->readAll();

?>

