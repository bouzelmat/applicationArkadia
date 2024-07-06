<!-- ce fichier est utilisé pour traiter les operations CRUD réialisées sur l'interface employe -->
<?php
require_once '../../vendor/autoload.php';
require_once '../../config/MongoDBConnection.php';
require_once '../../models/mongoDB/class_evenement.php';

session_start();

use ecf_arkadia\Config\MongoDBConnection;
use ecf_arkadia\Models\Evenement;

$mongo = new MongoDBConnection();
$client = $mongo->connect();
$evenement = new Evenement($client);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_event'])) {
        // créer un événement
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $date = $_POST['date'];

        $evenement->create($nom, $description, $image, $date);
        $_SESSION['message'] = "Événement créé avec succès!";
        $_SESSION['message_type'] = "success";
    } elseif (isset($_POST['update_event'])) {
        // mettre à jour un événement
        $id = $_POST['event_id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $date = $_POST['date'];

        $evenement->update($id, $nom, $description, $image, $date);
        $_SESSION['message'] = "Événement mis à jour avec succès!";
        $_SESSION['message_type'] = "success";
    } elseif (isset($_POST['delete_event'])) {
        // supprimer un événement
        $id = $_POST['event_id'];

        $evenement->delete($id);
        $_SESSION['message'] = "Événement supprimé avec succès!";
        $_SESSION['message_type'] = "danger";
    }
}

header('Location: ../../views/interface_employe.php');
exit();
?>
