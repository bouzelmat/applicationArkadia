<!-- fichier de traitement de la page connexion -->
<?php
// sécurité : démarrage de la session
session_start();

// sécurité : vérification du jeton CSRF
if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    // sécurité : journalisation
    error_log("Tentative de connexion avec un jeton CSRF invalide");
    header('Location: login.php?error=invalid_csrf');
    exit();
}

// régénérer le jeton CSRF pour la prochaine requête
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

require_once '../config/Database.php';
require_once '../models/class_utilisateurs.php';
require_once '../models/class_role.php';
require_once '../models/class_admin.php';
require_once '../models/class_veterinaire.php';
require_once '../models/class_employe.php';
require_once '../config/MongoDBConnection.php';

// sécurité : vérification de la méthode de requête
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // sécurite : journalisation
    error_log("Tentative d'accès direct au script de connexion");
    header('Location: login.php?error=invalid_request');
    exit();
}

// sécurité : vérification et nettoyage des données POST
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

if (empty($username) || empty($password)) {
    // sécurité : journalisation
    error_log("Tentative de connexion avec des champs manquants");
    header('Location: login.php?error=missing_data');
    exit();
}

try {
    $database = new \ecf_arkadia\Config\Database();
    $db = $database->getConnection();
    $mongoClient = new \ecf_arkadia\Config\MongoDBConnection();

    // initialisation des variables
    $utilisateur = null;
    $nom_role = '';

    // les utilisateurs aptes à se connecter
    $admin = new \ecf_arkadia\Models\Administrateur($db, $mongoClient);
    $veterinaire = new \ecf_arkadia\Models\Veterinaire($db);
    $employe = new \ecf_arkadia\Models\Employe($db);

    if ($admin->login($username, $password)) {
        $utilisateur = $admin;
        $nom_role = 'admin';
    } elseif ($veterinaire->login($username, $password)) {
        $utilisateur = $veterinaire;
        $nom_role = 'veterinaire';
    } elseif ($employe->login($username, $password)) {
        $utilisateur = $employe;
        $nom_role = 'employe';
    } else {
        throw new Exception("Identifiants invalides.");
    }

    if ($utilisateur !== null) {
        // sécurité : régénération de l'ID de session
        session_regenerate_id(true);

        $_SESSION['username'] = $utilisateur->username;
        $_SESSION['user_id'] = $utilisateur->id;
        $_SESSION['role'] = $nom_role;

        // sécurité : journalisation
        error_log("Connexion réussie pour l'utilisateur : $username avec le rôle : $nom_role");

        // redirection basée sur le rôle
        switch ($nom_role) {
            case 'admin':
                header('Location: ../views/interface_admin.php');
                break;
            case 'veterinaire':
                header('Location: ../views/interface_veterinaire.php');
                break;
            case 'employe':
                header('Location: ../views/interface_employe.php');
                break;
            default:
                header('Location: ../views/zoo_arkadia_accueil.php');
        }
        exit();
    } else {
        // sécurité : journalisation
        error_log("Échec de connexion pour l'utilisateur : $username");
        header('Location: login.php?error=invalid_credentials');
        exit();
    }
} catch (Exception $e) {
    // sécurité : journalisation
    error_log("Erreur lors de la connexion : " . $e->getMessage());
    header('Location: login.php?error=server_error');
    exit();
} finally {
    // fermeture de la connexion à la base de données
    if (isset($db)) {
        $db->close();
    }
}