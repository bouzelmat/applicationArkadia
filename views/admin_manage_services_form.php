<h2 class="py-4">Gestion des Services</h2>
    <!-- formulaire pour créer un service -->
    <form id="createServiceForm" method="POST" action="../handlers/interface_admin_data.php" class="mb-5">
        <input type="hidden" name="create_service" value="1">
        <div class="mb-3">
            <label for="serviceName" class="form-label">Nom du service:</label>
            <input type="text" id="serviceName" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="serviceDescription" class="form-label">Description:</label>
            <input type="text" id="serviceDescription" name="description" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="serviceImage" class="form-label">Image:</label>
            <input type="text" id="serviceImage" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Créer le service</button>
    </form>

<!-- liste des service existants avec options de mise à jour et suppression -->
<h2 class="py-4">Liste des Services</h2>
    <?php foreach ($services as $service) { ?>
        <div class="service-item mb-4">
            <!-- formulaire pour mettre à jour un service -->
            <form method="POST" action="../handlers/interface_admin_data.php">
                <input type="hidden" name="id_service" value="<?= $service['id_service'] ?>">
                <input type="hidden" name="action" value="update">
            
                <div class="mb-3">
                    <label for="nom_<?= $service['id_service'] ?>" class="form-label">Nom du service:</label>
                    <input type="text" id="nom_<?= $service['id_service'] ?>" name="nom" class="form-control" value="<?= $service['nom'] ?>" required>
                </div>
            
                <div class="mb-3">
                    <label for="description_<?= $service['id_service'] ?>" class="form-label">Description:</label>
                    <input type="text" id="description_<?= $service['id_service'] ?>" name="description" class="form-control" value="<?= $service['description'] ?>" required>
                </div>
            
                <div class="mb-3">
                    <label for="image_<?= $service['id_service'] ?>" class="form-label">Image:</label>
                    <input type="text" id="image_<?= $service['id_service'] ?>" name="image" class="form-control" value="<?= $service['image'] ?>" required>
                </div>
            
                <button type="submit" class="btn btn-warning">Mettre à jour</button>
            </form>
        
            <!-- formulaire pour supprimer un service -->
            <form method="POST" action="../handlers/interface_admin_data.php" class="mt-2">
                <input type="hidden" name="id_service" value="<?= $service['id_service'] ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    <?php } ?>