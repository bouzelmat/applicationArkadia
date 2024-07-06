<?php
// ce fichier permet à l'employé de mettre à jour les services depuis son interface. 
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employe') {
    header('Location: ../views/login.php');
    exit();
}

require_once '../config/Database.php';
require_once '../models/class_Employe.php';
require_once '../models/class_Service.php';

$database = new \ecf_arkadia\config\Database();
$conn = $database->getConnection();
$employe = new \ecf_arkadia\models\Employe($conn);
$service = new \ecf_arkadia\models\Service($conn);

if (isset($_POST['modifier_service'])) {
    $service_id = $_POST['service_id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = '../assets/images/services/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        // récupérer l'image existante si aucune nouvelle image n'est téléchargée
        $existingService = $service->read_one($service_id);
        $image = $existingService['image'];
    }

    if ($service->update($service_id, $nom, $description, $image)) {
        $_SESSION['message'] = "Service modifié avec succès.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la modification du service.";
        $_SESSION['message_type'] = "danger";
    }
    header('Location: ../views/interface_employe.php');
    exit();
}
?>
