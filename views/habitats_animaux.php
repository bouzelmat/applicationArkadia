<!-- l'affichage des données dynamiques de ce fichier sont traitées par le fichier scriptHabitats.js -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/style_page_hero.css" rel="stylesheet">
    <link href="../assets/style_habitats_animaux.css" rel="stylesheet">
    <link href="../assets/typography.css" rel="stylesheet">
    <link href="../assets/menuNavigation.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Manrope&family=Montserrat&family=Open+Sans&display=swap" rel="stylesheet">
    <title>Arkadia zoo</title>
</head>


<body style=" background-color: rgb(222, 247, 215);">
    <header class="py-4">
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-success">
            <div class="container">
                <a class="navbar-brand" href="/ecf_arkadia/views/zoo_arkadia_accueil.php">
                    <img src="../assets/images/logo/logo_zoo_arkadia.png" alt="Logo du zoo arkadia" class="appBar__logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link bg-info text-white nav-hover-effect" href="zoo_arkadia_accueil.php">ACCUEIL</a></li>
                        <li class="nav-item"><a class="nav-link bg-info text-white nav-hover-effect" href="service.php">SERVICES</a></li>
                        <li class="nav-item"><a class="nav-link bg-info text-white nav-hover-effect" href="habitats_animaux.php">HABITATS ET ANIMAUX</a></li>
                        <li class="nav-item"><a class="nav-link bg-info text-white nav-hover-effect" href="login.php">CONNEXION</a></li>
                        <li class="nav-item"><a class="nav-link bg-info text-white nav-hover-effect" href="contact.php">CONTACTS</a></li>
                        <li class="nav-item"><a href="billet.php" class="btn btn-primary nav-hover-effect">ACHETER MON BILLET</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="page-hero__background py-4">
        <img src="../assets/images/hero/singe.png" class="img_page_accueil img-fluid" alt="photo d'un singe">
    </div>

    <div class="container">
        <h1 class="py-1 text-success text-center">Les animaux et leurs habitats</h1>
    </div>

    <div class="container py-4">
        <p class="text-justify">
            Les habitats dans un zoo représentent des écosystèmes artificiels soigneusement conçus pour offrir un environnement naturel aux animaux qui y résident.
            Chaque habitat est une fenêtre sur un monde unique,
            où la faune et la flore se mêlent pour recréer les conditions de vie spécifiques à chaque espèce. Des vastes plaines herbeuses aux forêts luxuriantes,
            en passant par les environnements aquatiques, les habitats zoo offrent une diversité incroyable de paysages.
            Ces espaces sont aménagés avec attention pour répondre aux besoins physiologiques, comportementaux et sociaux des animaux,
            favorisant ainsi leur bien-être et leur épanouissement. Les visiteurs peuvent ainsi observer les animaux dans des conditions proches de leur habitat naturel, tout en apprenant sur la nécessité de préserver ces écosystèmes fragiles.
            Chaque habitat est une invitation à la découverte et à la sensibilisation à la préservation de la biodiversité.
        </p>
    </div>
    <!-- l'affichage des données dynamiques de ce fichier sont traitées par le fichier scriptHabitats.js -->
    <div class="container py-3">
        <h5 class="py-5 text-success text-center fw-bold">Entrez dans l'intimité de la nature : nos habitats vous révèlent la vie secrète de leurs occupants</h5>
        <p class="text-center text-success mb-3">Choisissez un habitat ci-dessous pour découvrir les merveilleux animaux qui y vivent !</p>
        <div id="habitat-buttons" class="text-center mb-4">
            <button class="btn btn-success m-2 w-25" data-habitat="La jungle">La jungle</button>
            <button class="btn btn-success m-2 w-25" data-habitat="La savane">La savane</button>
            <button class="btn btn-success m-2 w-25" data-habitat="Les marais">Les marais</button>
        </div>
        <div id="habitat-info" class="habitat-info mb-4"></div>
        <div id="animal-list" class="row"></div>
    </div>

    <div class="modal fade" id="rapportModal" tabindex="-1" aria-labelledby="rapportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content bg-transparent bg-opacity-75">
                <div class="modal-header">
                    <h5 class="modal-title bg-warning fw-bold" id="rapportModalLabel">Rapport Vétérinaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-white bg-opacity-75">
                    <!-- les informations du rapport vétérinaire seront affichées ici -->
                </div>
            </div>
        </div>
    </div>
    <?php include '../handlers/mongoDB/horaires_footer.php'; ?>

<div class="container W-100">
    <footer class="text-white text-center text-lg-start bg-primary">
        <div class="container p-5">
            <div class="row mt-4 mx-5">
                <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">RESSOURCES</h5>
                    <a class="text-light" href="#">Réglement intérieur</a> <br/>
                    <a class="text-light" href="#">Conditions générales de vente</a> <br/>
                    <a class="text-light" href="#">Mentions légales</a> <br/>
                    <a class="text-light" href="#">Politique de confidentialité</a>
                    <div class="mt-4">
                        <a type="button" class="btn btn-floating btn-success btn-lg"><i class="bi bi-facebook"></i></a>
                        <a type="button" class="btn btn-floating btn-success btn-lg"><i class="bi bi-instagram"></i></a>
                        <a type="button" class="btn btn-floating btn-success btn-lg"><i class="bi bi-whatsapp"></i></a>
                        <a type="button" class="btn btn-floating btn-success btn-lg"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <ul class="fa-ul" style="margin-left: 1.65em;">
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Aureville, Avenue de Dunkerque, France</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">Arkadia_zoo@example.com</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">+ 07 234 567 88</span>
                        </li>
                        <li class="mb-3">
                            <span class="fa-li"><i class="fas fa-print"></i></span><span class="ms-2">+ 03 234 567 89</span>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0 bg-success">
                    <h5 class="text-uppercase mb-4 py-2">HORAIRES D'OUVERTURES</h5>
                    <table class="table text-center text-white">
                        <tbody class="font-weight-normal">
                            <?php foreach ($horaires as $horaire) : ?>
                                <tr>
                                    <td class="bg-success text-white"><?= htmlspecialchars($horaire['jour']) ?>:</td>
                                    <td class="bg-success text-white"><?= htmlspecialchars($horaire['ouverture']) ?> - <?= htmlspecialchars($horaire['fermeture']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </footer>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../assets/scriptHabitats.js"></script>
</body>
</html>
