<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once '../handlers/data_page_accueil.php'; ?> <!-- ce fichier gère l'ensemble du traitement php de cette page hormis le traitement des avis envoyés par le visiteur (pour cette fonctionnalité consultez data_formulaire_avis.php) -->

<?php include 'header.php'; ?>

<div class="page-hero__background position-relative py-4">
    <img src="../assets/images/hero/tigre.png" class="img_page_accueil img-fluid" alt="photo d'un lion">
    <div class="bloc_page_hero bg-success text-center text-lg-start">
        <h1 class="mb-1 page-hero__title text-white">EXPLOREZ, PRÉSERVEZ : VOTRE AVENTURE ZOO COMMENCE !</h1>
        <a href="billet.php" class="btn_page_hero btn btn-primary  btn-sm btn-md-normal 
               fs-7 fs-sm-6 fs-md-5">ACHETER MON BILLET</a>
    </div>
</div>

<div class="history_zoo py-4">
    <div class="container">
        <div class="bloc_historyZoo bg-success d-flex flex-column flex-lg-row align-items-center p-4">
            <img src="../assets/images/divers/photo_history_zoo2.png" class="photo_etablissement_zoo img-fluid mb-3 mb-lg-0 me-lg-4" alt="photo de l'etablissement du zoo">
            <div class="text_history_zoo">
                <h2 class="text-white py-4">Bienvenu à Arkadia Zoo</h2>
                <p class="text-white">À 15 km de Toulouse, Arkadia Zoo, fondé en 2004 par José, un ancien éleveur passionné, s'étend sur 30 hectares. Ce sanctuaire naturel abrite plus de 400 animaux de 80 espèces dans des habitats recréés comme la jungle et la savane, offrant une expérience immersive et éducative aux visiteurs. Le Zoo Arkadia se distingue par son engagement profond envers la protection de l'environnement et le bien-être animal. À travers ses installations modernes et ses programmes de conservation, le zoo offre une expérience immersive tout en sensibilisant les visiteurs à l'importance de la préservation des espèces et de leurs habitats naturels. Chaque visite contribue directement aux efforts de conservation et d'éducation du zoo.</p>
                <a href="notre_mission.php" class="btn btn-primary mt-3">En savoir plus sur notre mission</a>
            </div>
            </div>
        </div>
    </div>
</div>

<section class="bloc_habitat">
    <div class="bloc_habitats"> <!-- le code suivant permet d'afficher les habitats. les animaux sont cachés par defaut . pour afficher les animaux, l'utilsateur doit appyé sur un bouton -->
        <h1 class="title_habitat text-center py-5 text-success">Découvrez les habitats et leurs animaux</h1>
        <?php foreach ($habitats as $habitat): ?>
            <div class="habitat-section text-center py-4">
                <h2 class="text-success py-4"><?php echo htmlspecialchars($habitat['nom'], ENT_QUOTES); ?></h2>
                <img src="<?php echo htmlspecialchars($habitat['image'], ENT_QUOTES); ?>" class="img-fluid habitat-image" alt="photo de <?php echo htmlspecialchars($habitat['nom'], ENT_QUOTES); ?>">
                <div class="text-center"> <!-- showAnimals est une fonction JS -->
                    <button class="btn btn-primary mt-3" onclick="showAnimals('<?php echo htmlspecialchars($habitat['id'], ENT_QUOTES); ?>')">Voir les animaux</button> 
                </div>
                <div id="carousel<?php echo htmlspecialchars($habitat['id'], ENT_QUOTES); ?>" class="carousel slide mt-4 d-none" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <?php 
                        $first = true;
                        foreach ($animaux as $animal): 
                            if ($animal['habitat_id'] == $habitat['id']): ?>
                                <div class="carousel-item <?php if ($first) { echo 'active'; $first = false; } ?>">
                                    <img src="<?php echo htmlspecialchars($animal['image'], ENT_QUOTES); ?>" class="d-block w-100 animal-image" alt="photo de <?php echo htmlspecialchars($animal['prenom'], ENT_QUOTES); ?>">
                                    <div class="carousel-caption d-block">
                                        <h5><?php echo htmlspecialchars($animal['prenom'], ENT_QUOTES); ?></h5>
                                    </div>
                                </div>
                            <?php endif; 
                        endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo htmlspecialchars($habitat['id'], ENT_QUOTES); ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo htmlspecialchars($habitat['id'], ENT_QUOTES); ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="container"> <!-- ce bloc ne fait que de l'affichage statique -->
        <h2 class="title_ecologie py-5 text-center">
            <span class="bg-warning">Préservons la </span> 
            <span class="bg-success">nature</span>
        </h2>

        <img src="../assets/images/divers/ecologie.png" class="img_ecologie img-fluid py-4 mx-auto d-block" alt="photo d'une jungle">

        <div class="bloc_txt_habitat bg-success p-4">
            <p class="txt_habitat">La protection des habitats des animaux est essentielle pour préserver la biodiversité et assurer la survie de nombreuses espèces animales.
                Les habitats naturels fournissent non seulement un abri aux animaux, mais également des ressources essentielles telles que nourriture, eau et abri.
            
                Malheureusement, de nombreux habitats naturels sont menacés par la déforestation, l'urbanisation, la pollution,
                le changement climatique et d'autres activités humaines.
                Ces perturbations affectent directement la vie sauvage, entraînant la disparition d'espèces et la fragmentation des écosystèmes.
            
                Pour protéger les habitats des animaux, il est crucial de mettre en place des mesures de conservation efficaces.
                Cela peut inclure la création de réserves naturelles, parcs nationaux et zones protégées,
                où les activités humaines sont réglementées pour minimiser les perturbations.
                La restauration des écosystèmes dégradés et la sensibilisation du public à l'importance de la protection de la nature sont également des actions clés.
            
                En travaillant ensemble pour protéger les habitats des animaux, nous pouvons contribuer à maintenir l'équilibre écologique de notre planète et garantir
                un avenir durable pour toutes les formes de vie. La préservation des habitats naturels est un engagement essentiel pour assurer la cohabitation harmonieuse entre
                l'homme et la nature.
            </p>
        </div>
    </div>
</section>

<section class="bloc_service">
    <h1 class="title_service text-center py-5 text-success">Découvrez nos services</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 mx-5">
        <?php foreach ($services as $service): ?>
            <div class="col">
                <div class="card h-100">
                    <img src="<?php echo htmlspecialchars($service['image'], ENT_QUOTES); ?>" class="card-img-top" alt="Image de <?php echo htmlspecialchars($service['nom'], ENT_QUOTES); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($service['nom'], ENT_QUOTES); ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="bloc_avis py-5 ">
    <h1 class="title_avis text-center py-5 text-success">Les avis de nos visiteurs</h1>
    <div id="carouselAvis" class="carousel slide mx-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($avis as $index => $avi): ?>
                <div class="carousel-item carousel-item_avis <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="card card_avis h-100 bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($avi['pseudo'], ENT_QUOTES); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($avi['commentaire'], ENT_QUOTES); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAvis" data-bs-slide="prev">
            <span class="carousel-control-prev-icon carousel-control-prev-icon_avis" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselAvis" data-bs-slide="next">
            <span class="carousel-control-next-icon carousel-control-next-icon_avis" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container py-5">
        <h2 class="text-center text-success">Laissez un avis</h2>
        <form action="../handlers/data_formulaire_avis.php" method="post" class="mt-4">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo" required maxlength="50">
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Commentaire</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="3" required maxlength="500"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/main_page_accueil.js"></script>