<!--  page de connexion -->
<?php
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<?php include 'header.php'; ?>

<div class="page-hero__background py-4">
    <img src="../assets/images/hero/connexion_hero.png" class="img_page_accueil img-fluid" alt="photo d'un lion">
</div>

<div class="container mt-5 py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-success">Connexion</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php // sélection du message d'erreur approprié
                            switch ($_GET['error']) {
                                case 'invalid_credentials':
                                    echo "Identifiant ou mot de passe incorrect.";
                                    break;
                                case 'invalid_csrf':
                                    echo "Erreur de sécurité. Veuillez réessayer.";
                                    break;
                                case 'missing_data':
                                    echo "Veuillez remplir tous les champs.";
                                    break;
                                default:
                                    echo "Une erreur s'est produite. Veuillez réessayer.";
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    <!-- formulaire de connexion -->
                    <form action="../handlers/data_login.php" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>