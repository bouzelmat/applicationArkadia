<!-- fichier de traitement de l'interface admin -->
<?php
// gestion des services
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_service'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $image = $_POST['image'];

        if ($serviceModel->create($nom, $description, $image)) {
            $_SESSION['message'] = "Service créé avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur : Une erreur est survenue lors de la création du service.";
            $_SESSION['message_type'] = "danger";
        }

        // Définition du statut de redirection
        $_SESSION['redirect'] = '../views/interface_admin.php';

    } elseif (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['id_service'])) {
        $id_service = $_POST['id_service'];
        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $image = $_POST['image'] ?? '';

        if ($serviceModel->update($id_service, $nom, $description, $image)) {
            $_SESSION['message'] = "Service mis à jour avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur : Impossible de mettre à jour le service.";
            $_SESSION['message_type'] = "danger";
        }

      
        $_SESSION['redirect'] = '../views/interface_admin.php';

    } elseif (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id_service'])) {
        $id_service = $_POST['id_service'];

        if ($serviceModel->delete($id_service)) {
            $_SESSION['message'] = "Service supprimé avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur : Impossible de supprimer le service.";
            $_SESSION['message_type'] = "danger";
        }

        $_SESSION['redirect'] = '../views/interface_admin.php';
    }
}
?>

