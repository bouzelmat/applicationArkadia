<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// vérification du rôle de l'utilisateur connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: access_denied.php');
    exit();
}

include 'header.php'; 
include '../handlers/interface_admin_data.php';

?>

<div class="container py-5">
    <h1 class="py-4 text-center bg-info">Bienvenue sur l'interface Admin</h1>
    
    <div class="d-flex justify-content-end mb-4">
        <a href="../handlers/logout.php" class="btn btn-danger">Déconnexion</a>
    </div>

    <!-- affichage des messages de session -->
    <?php if (isset($_SESSION['message'])): ?> 
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>" role="alert">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    <?php endif; ?>

<?php include 'admin_create_user_form.php'; ?>
<?php include 'admin_filter_vet_reports_form.php'; ?>
<?php include 'admin_manage_services_form.php'; ?>
<?php include 'admin_manage_habitats_form.php'; ?>
<?php include 'admin_manage_animals_form.php'; ?>

<!-- ajout du graphique, l'affichage du graphique est réalisé par admin_clics_Img_graphique.js  -->
    <div class="card py-4">
        <div class="card-header">
            Statistiques des Clics par Animal
        </div>
        <div class="card-body">
            <canvas id="clicsChart" style="width:100%; height:400px; border:1px solid #000;"></canvas>
        </div>
    </div>

    <script>
        var labels = <?php echo json_encode($labels); ?>;
        var clics = <?php echo json_encode($clics); ?>;
    </script>

    <!-- modification horaire -->
    <form onsubmit="updateOpeningHours(); return false;">
        <h5 class="text-uppercase mb-4 py-4">Modifier les Horaires d'Ouverture</h5>
        <table class="table text-center text-white">
            <tbody class="font-weight-normal">
                <tr>
                    <td class="bg-success text-white">Lundi - Mardi:</td>
                    <td>
                        <input type="time" id="opening_LundiMardi" value="08:30">
                        <input type="time" id="closing_LundiMardi" value="19:30">
                    </td>
                </tr>
                <tr>
                    <td class="bg-success text-white">Mercredi:</td>
                    <td>
                        <input type="time" id="opening_Mercredi" value="09:00">
                        <input type="time" id="closing_Mercredi" value="19:00">
                    </td>
                </tr>
                <tr>
                    <td class="bg-success text-white">Jeudi - Vendredi:</td>
                    <td>
                        <input type="time" id="opening_JeudiVendredi" value="08:30">
                        <input type="time" id="closing_JeudiVendredi" value="19:00">
                    </td>
                </tr>
                <tr>
                    <td class="bg-success text-white">Samedi:</td>
                    <td>
                        <input type="time" id="opening_Samedi" value="09:00">
                        <input type="time" id="closing_Samedi" value="19:00">
                    </td>
                </tr>
                <tr>
                    <td class="bg-success text-white">Dimanche:</td>
                    <td>
                        <input type="time" id="opening_Dimanche" value="09:00">
                        <input type="time" id="closing_Dimanche" value="19:00">
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="submit" class="btn bg-warning">Mettre à jour</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../assets/admin_script_filter_reports.js"></script>
<script src="../assets/admin_clics_Img_graphique.js"></script>
<script src="../assets/admin_scriptHoraire.js"></script>
<?php include 'footer.php'; ?>
