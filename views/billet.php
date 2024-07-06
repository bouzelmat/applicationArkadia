<?php include 'header.php'; ?>

<div class="page-hero__background py-4">
  <img src="../assets/images/hero/billet.png" class="img_page_accueil img-fluid" alt="photo d'un lion">
</div>

<div class="container mt-5">
  <div class="card">
      <div class="card-header text-center">
          <h2 class="bg-success text-white">Acheter un billet</h2>
      </div>
      <div class="card-body text-success">
          <p class="text-success fw-bold">Bienvenue dans la section de réservation de billets d'Arkadia Zoo. Veuillez sélectionner votre type de billet ci-dessous :</p>
          <div class="row">
              <div class="col-md-4 mb-3">
                  <div class="card bg-success text-white">
                      <div class="card-body text-center">
                          <h5 class="card-title">Billet Adulte</h5>
                          <p class="card-text">Accès complet au zoo pour une journée</p>
                          <a href="serviceDePaiment.php" class="btn btn-primary">Acheter</a>
                      </div>
                  </div>
              </div>
              <div class="col-md-4 mb-3">
                  <div class="card bg-success text-white">
                      <div class="card-body text-center">
                          <h5 class="card-title">Billet Enfant</h5>
                          <p class="card-text">Accès complet au zoo pour une journée</p>
                          <a href="serviceDePaiment.php" class="btn btn-primary">Acheter</a>
                      </div>
                  </div>
              </div>
              <div class="col-md-4 mb-3">
                  <div class="card bg-success text-white">
                      <div class="card-body text-center">
                          <h5 class="card-title">Billet Famille</h5>
                          <p class="card-text">Accès complet : 2 adultes + 2 enfants</p>
                          <a href="serviceDePaiment.php" class="btn btn-primary">Acheter</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include 'footer.php'; ?>
