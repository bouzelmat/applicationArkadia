<!-- page service du site web -->
<?php include 'header.php'; ?>

<div class="page-hero__background py-4">
  <img src="../assets/images/hero/service_hero.png" class="img_page_accueil img-fluid" alt="photo d'un lion">
</div>

<div class="container mt-5">
    <h1 class="text-center mb-5 py-4 text-success">Profitez de nos services</h1>
    <div class="row" id="services-container">
        <!-- les blocs de services seront insérés ici par JavaScript -->
    </div>
    <div class="container mt-5">
        <h1 class="text-center mb-5 py-4 text-info">Événements à venir</h1>
        <div class="row" id="events-container">
            <!-- les blocs d'événements seront insérés ici par JavaScript -->
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/services.js"></script>
<script src="../assets/evenements.js"></script>
