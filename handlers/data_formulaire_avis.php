<!-- ce fichier gère le traitement des avis envoyés depuis la page d'accueil -->
<?php
// securité : démarrage de la session 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// sécurité : ajout de headers de sécurité
header("Content-Security-Policy: default-src 'self'; style-src 'self' https://stackpath.bootstrapcdn.com;");
header("X-Frame-Options: DENY");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");

require_once '../config/Database.php';
require_once '../models/class_avis.php';
require_once '../models/class_employe.php';

$database = new \ecf_arkadia\Config\Database();
$conn = $database->getConnection();

$message = '';
$messageType = '';

// sécurité : vérification de la méthode de requête et du token CSRF
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // sécurité : vérification du token CSRF
    $csrf_valid = isset($_POST['csrf_token']) && isset($_SESSION['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'];
    if (!$csrf_valid) {
        // log l'erreur
        error_log("Tentative de soumission avec un token CSRF invalide");
        $message = "Une erreur de sécurité est survenue. Veuillez réessayer.";
        $messageType = "danger";
    } else {
        // validation et nettoyage des entrées
        $pseudo = trim($_POST['pseudo']);
        $commentaire = trim($_POST['commentaire']);

        // sécurité : Vérification des champs obligatoires et de leur longueur
        if (empty($pseudo) || empty($commentaire) || strlen($pseudo) > 50 || strlen($commentaire) > 500) {
            $message = "Erreur de validation. Vérifiez vos entrées.";
            $messageType = "danger";
        } else {
            try {
                $employe = new \ecf_arkadia\Models\Employe($conn);
                
                $avis = $employe->getAvisInstance();

                // Attribution des valeurs
                $avis->pseudo = $pseudo;
                $avis->commentaire = $commentaire;
                $avis->valide = 0; // Par défaut, l'avis n'est pas validé

                // sécurité : vérification de la session et de l'ID utilisateur
                $avis->utilisateur_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : NULL;

                if ($avis->create()) {
                    $message = "Votre avis a été soumis et est en attente de validation";
                    $messageType = "success";
                    // sécurité : journalisation
                    error_log("Nouvel avis soumis par : $pseudo");
                } else {
                    $message = "Erreur lors de la soumission de votre avis. Veuillez réessayer.";
                    $messageType = "danger";
                    // sécurité : journalisation
                    error_log("Échec de la soumission d'avis pour : $pseudo");
                }
            } catch (Exception $e) {
                $message = "Une erreur est survenue. Veuillez réessayer plus tard.";
                $messageType = "danger";
                // sécurité : journalisation
                error_log("Erreur lors de la soumission d'avis : " . $e->getMessage());
            }
        }
    }
}

// génération d'un nouveau token CSRF pour la prochaine requête
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumettre un avis</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $messageType; ?>" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($messageType !== 'success'): ?>
            <a href="../views/zoo_arkadia_accueil.php" class="btn btn-primary">Retour au formulaire</a>
        <?php endif; ?>
        
        <a href="../views/zoo_arkadia_accueil.php" class="btn btn-secondary">Retour à l'accueil</a>
    </div>
</body>
</html>
