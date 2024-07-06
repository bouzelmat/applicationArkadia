<?php include '../handlers/mongoDB/horaires_footer.php'; ?> <!--ce fichier recupere les données horaires depuis la bdd mongoDB afin de les afficher dans le footer -->

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

</body>
</html>

