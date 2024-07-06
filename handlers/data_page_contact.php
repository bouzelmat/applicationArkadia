<!-- fichier de traitement de la page contact -->
<?php
session_start();
require_once '../config/Database.php';
require_once '../models/class_contact_messages.php';

use ecf_arkadia\Models\ContactMessages;
use ecf_arkadia\Config\Database;

// sécurité : vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // sécurité : vérification du token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        error_log("Tentative d'envoi de formulaire de contact avec un token CSRF invalide");
        header("Location: ../views/contact.php?error=invalid_request");
        exit();
    }

    // sécurité : validation et nettoyage des entrées
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // sécurité : vérification des champs obligatoires
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        error_log("Tentative d'envoi de formulaire de contact avec des champs manquants");
        header("Location: ../views/contact.php?error=missing_fields");
        exit();
    }

    // sécurité : validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        error_log("Tentative d'envoi de formulaire de contact avec un email invalide");
        header("Location: ../views/contact.php?error=invalid_email");
        exit();
    }

    try {
        $database = new Database();
        $db = $database->getConnection();

        $contactMessages = new ContactMessages($db);

        // enregistre le message de contact
        if ($contactMessages->saveMessage($name, $email, $subject, $message)) {
            header("Location: ../views/contact.php?success=1");
        } else {
            error_log("Échec de l'enregistrement du message de contact pour : $email");
            header("Location: ../views/contact.php?error=db_error");
        }
    } catch (\Exception $e) {
        error_log("Erreur lors du traitement du formulaire de contact : " . $e->getMessage());
        header("Location: ../views/contact.php?error=server_error");
    }
} else {
    error_log("Tentative d'accès direct au script de traitement du formulaire de contact");
    header("Location: ../views/contact.php?error=invalid_request");
}
?>
