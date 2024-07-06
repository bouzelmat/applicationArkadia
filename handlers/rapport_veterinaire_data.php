<!-- fichier de traitement de l'interface véterinaire. il gère l'ensemble des fonctionnalités de l'interface véterinaire -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use ecf_arkadia\Config\Database;
use ecf_arkadia\Models\Veterinaire;
use ecf_arkadia\Models\Alimentation;
use ecf_arkadia\Models\Habitat;
use ecf_arkadia\Models\Animal;

include '../config/Database.php';
include '../models/class_veterinaire.php';
include '../models/class_alimentation.php';
include '../models/class_habitat.php';
include '../models/class_animal.php';

$database = new Database();
$db = $database->getConnection();
$veterinaire = new Veterinaire($db);
$alimentation = new Alimentation($db);
$animal = new Animal($db);
$habitat = new Habitat($db);

$alimentations = $alimentation->read();
$rapportsVeterinaires = $veterinaire->readRapportsVeterinaires();
$animaux = $animal->read();
$habitats = $habitat->read();
$commentaires = $veterinaire->readCommentairesHabitat();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'ajouter_commentaire') {
        $commentaire = $_POST['commentaire'];
        $habitat_id = $_POST['habitat_id'];
        $utilisateur_id = $_SESSION['id'];

        if ($veterinaire->createCommentaireHabitat($commentaire, $utilisateur_id, $habitat_id)) {
            $_SESSION['message'] = "Commentaire ajouté avec succès";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de l'ajout du commentaire";
            $_SESSION['message_type'] = "danger";
        }
        header('Location: ../views/interface_veterinaire.php');
        exit();
    } elseif ($action == 'modifier_commentaire') {
        $id = $_POST['id'];
        $commentaire = $_POST['commentaire'];

        if ($veterinaire->updateCommentaireHabitat($id, $commentaire)) {
            $_SESSION['message'] = "Commentaire modifié avec succès";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la modification du commentaire";
            $_SESSION['message_type'] = "danger";
        }
        header('Location: ../views/interface_veterinaire.php');
        exit();
    } elseif ($action == 'supprimer_commentaire') {
        $id = $_POST['id'];

        if ($veterinaire->deleteCommentaireHabitat($id)) {
            $_SESSION['message'] = "Commentaire supprimé avec succès";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression du commentaire";
            $_SESSION['message_type'] = "danger";
        }
        header('Location: ../views/interface_veterinaire.php');
        exit();
    } elseif ($action == 'ajouter_rapport') {
        $etat = $_POST['etat'];
        $nourritureProposee = $_POST['nourritureProposee'];
        $grammage = $_POST['grammage'];
        $datePassage = $_POST['datePassage'];
        $detailEtat = $_POST['detailEtat'];
        $utilisateur_id = $_SESSION['id'];
        $animal_id = $_POST['animal_id'];

        if ($veterinaire->createRapportVeterinaire($etat, $nourritureProposee, $grammage, $datePassage, $detailEtat, $utilisateur_id, $animal_id)) {
            $_SESSION['message'] = "Rapport ajouté avec succès";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de l'ajout du rapport";
            $_SESSION['message_type'] = "danger";
        }
        header('Location: ../views/interface_veterinaire.php');
        exit();
    } elseif ($action == 'supprimer_rapport') {
        $id = $_POST['id'];

        if ($veterinaire->deleteRapportVeterinaire($id)) {
            $_SESSION['message'] = "Rapport supprimé avec succès";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression du rapport";
            $_SESSION['message_type'] = "danger";
        }
        header('Location: ../views/interface_veterinaire.php');
        exit();
    } elseif ($action == 'delete_alimentation') {
        $id = $_POST['id'];

        if ($alimentation->delete($id)) {
            $_SESSION['message'] = "Informations d'alimentation supprimées avec succès";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression des informations d'alimentation";
            $_SESSION['message_type'] = "danger";
        }
        header('Location: ../views/interface_veterinaire.php');
        exit();
    }
}
?>
