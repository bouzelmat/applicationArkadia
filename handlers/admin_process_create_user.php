<!-- fichier de traitement de l'interface admin -->
<?php
// traitement du formulaire de création d'utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $role_id = $_POST['role_id'];

    if ($admin->creerCompte($username, $email, $password, $prenom, $nom, $role_id)) {
        $_SESSION['message'] = "Utilisateur créé avec succès.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Erreur : Nom d'utilisateur ou email déjà utilisé ou une autre erreur est survenue.";
        $_SESSION['message_type'] = "danger";
    }

    // définition du statut de redirection
    $_SESSION['redirect'] = '../views/interface_admin.php';
}
?>
