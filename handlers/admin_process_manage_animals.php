<?php
// gestion des animaux
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_animal'])) {
    $prenom = $_POST['prenom'] ?? null;
    $race = $_POST['race'] ?? null;
    $image = $_POST['image'] ?? null;
    $etat = $_POST['etat'] ?? null;
    $habitat_id = $_POST['habitat_id'] ?? null;

    if ($prenom && $race && $habitat_id) {
        if ($animalModel->create($prenom, $race, $image, $etat, $habitat_id)) {
            $_SESSION['message'] = "Animal créé avec succès.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Erreur : Une erreur est survenue lors de la création de l'animal.";
            $_SESSION['message_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "Erreur : Prénom, race, et habitat_id sont requis.";
        $_SESSION['message_type'] = "danger";
    }

    // définition du statut de redirection
    $_SESSION['redirect'] = '../views/interface_admin.php';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_animal'])) {
    $animal_id = $_POST['animal_id'];
    $animal = new \ecf_arkadia\Models\Animal($db);
    if ($animal->delete($animal_id)) {
        $_SESSION['message'] = "Animal supprimé avec succès.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression de l'animal.";
        $_SESSION['message_type'] = "danger";
    }

    $_SESSION['redirect'] = '../views/interface_admin.php';
}
?>

