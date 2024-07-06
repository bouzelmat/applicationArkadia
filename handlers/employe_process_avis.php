<!-- fichier de traitement des avis de l'espace employé -->
<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employe') {
    header('Location: ../views/login.php');
    exit();
}

include '../config/Database.php';
include '../models/class_avis.php';
include '../models/class_employe.php';

$database = new \ecf_arkadia\Config\Database();
$conn = $database->getConnection();

$employe = new \ecf_arkadia\Models\Employe($conn);

// vérifie si le formulaire a été soumis avec la méthode POST et si le bouton de validation ou de suppression de l'avis a été cliqué.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['valider_avis'])) {
        // récupère l'ID de l'avis à valider à partir du formulaire.
        $avis_id = $_POST['avis_id'];
        
        // appelle la méthode validerAvis de l'employé pour valider l'avis. Stocke un message de succès ou d'erreur selon le résultat.
        if ($employe->validerAvis($avis_id)) {
            $_SESSION['message'] = "Avis validé avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la validation de l'avis.";
            $_SESSION['message_type'] = "danger";
        }
    } elseif (isset($_POST['supprimer_avis'])) {
        // récupère l'ID de l'avis à supprimer à partir du formulaire.
        $avis_id = $_POST['avis_id'];
        
        if ($employe->supprimerAvis($avis_id)) {
            $_SESSION['message'] = "Avis supprimé avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression de l'avis.";
            $_SESSION['message_type'] = "danger";
        }
    }
}

header('Location: ../views/interface_employe.php');
exit();
?>
