<?php
//ce fichier gère unquement la fonctionnalité "créer" un rapport alimentaire sur l'interface employe. quant a la fonctionnalité supprimer (présente sur ce fichier) et mise a jour (non présente sur ce fichier) elles sont sujet à etre ajoutées sur l'interface employe.  
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employe') {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../config/Database.php';
    require_once '../models/class_Alimentation.php';

    $database = new \ecf_arkadia\Config\Database();
    $db = $database->getConnection();

    $alimentation = new \ecf_arkadia\models\Alimentation($db);

    if (isset($_POST['action']) && $_POST['action'] === 'delete_alimentation') {
        $alimentation->id = $_POST['id'];

        if ($alimentation->delete(db)) {
            $_SESSION['message'] = "Informations d'alimentation supprimées avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression des informations d'alimentation.";
            $_SESSION['message_type'] = "danger";
        }

        header('Location: ../views/interface_veterinaire.php');
        exit();
    } else {
        $alimentation->id_animal = $_POST['id_animal'];
        $alimentation->nourritureProposee = $_POST['nourritureProposee'];
        $alimentation->grammage = $_POST['grammage'];
        $alimentation->dateAlimentation = $_POST['dateAlimentation'];

        if ($alimentation->create()) {
            $_SESSION['message'] = "Informations d'alimentation ajoutées avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de l'ajout des informations.";
            $_SESSION['message_type'] = "danger";
        }

        header('Location: ../views/interface_employe.php');
        exit();
    }
}
