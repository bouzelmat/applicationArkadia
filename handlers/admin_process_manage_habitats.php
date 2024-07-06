<!-- fichier de traitement de l'interface admin -->
<?php
// gestion des habitats
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_habitat'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $image = $_POST['image'];

        if ($habitatModel->create($nom, $description, $image)) {
            $_SESSION['message'] = "Habitat créé avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur : Une erreur est survenue lors de la création de l'habitat.";
            $_SESSION['message_type'] = "danger";
        }

        // définition du statut de redirection
        $_SESSION['redirect'] = '../views/interface_admin.php';

    } elseif (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['id'])) {
        $id_habitat = $_POST['id'];
        $nom = $_POST['nom'] ?? '';
        $description = $_POST['description'] ?? '';
        $image = $_POST['image'] ?? '';

        if ($habitatModel->update($id_habitat, $nom, $description, $image)) {
            $_SESSION['message'] = "Habitat mis à jour avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur : Impossible de mettre à jour l'habitat.";
            $_SESSION['message_type'] = "danger";
        }

        
        $_SESSION['redirect'] = '../views/interface_admin.php';

    } elseif (isset($_POST['action']) && $_POST['action'] == 'delete' && isset($_POST['id'])) {
        $id_habitat = $_POST['id'];

        if ($habitatModel->delete($id_habitat)) {
            $_SESSION['message'] = "Habitat supprimé avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur : Impossible de supprimer l'habitat.";
            $_SESSION['message_type'] = "danger";
        }

        $_SESSION['redirect'] = '../views/interface_admin.php';
    }
}
?>


