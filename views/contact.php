<!-- fichier de la page contact -->
<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<?php include 'header.php'; ?> 

<div class="page-hero__background py-4">
    <img src="../assets/images/hero/oiseaux_hero.png" class="img_page_accueil img-fluid" alt="photo d'un lion">
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-success">Contactez-Nous</h1>
    <div class="card p-4 mx-auto shadow-sm" style="max-width: 600px;">
        <!-- affichage des messages de succès ou d'erreur -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">Votre message a été envoyé avec succès !</div>
        <?php elseif (isset($_GET['error'])): ?>
            <?php
            $errorMessages = [
                'missing_fields' => 'Tous les champs sont obligatoires.',
                'invalid_email' => 'Adresse email invalide.',
                'db_error' => 'Erreur lors de l\'enregistrement de votre message. Veuillez réessayer.',
                'server_error' => 'Une erreur est survenue. Veuillez réessayer plus tard.',
                'invalid_request' => 'Requête invalide.'
            ];
            $error = $_GET['error'];
            ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errorMessages[$error] ?? 'Une erreur inconnue est survenue.') ?></div>
        <?php endif; ?>

        <form action="../handlers/data_page_contact.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <div class="form-group">
                <label for="name" class="text-success font-weight-bold">Nom</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
            </div>
            <div class="form-group">
                <label for="email" class="text-success font-weight-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
            </div>
            <div class="form-group">
                <label for="subject" class="text-success font-weight-bold">Sujet</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet" required>
            </div>
            <div class="form-group">
                <label for="message" class="text-success font-weight-bold">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Votre message" required></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">Envoyer</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
