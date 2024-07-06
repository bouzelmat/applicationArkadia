 <!-- formulaire pour créer un habitat -->
 <h2 class="py-4">Gestion des Habitats</h2>
    <form id="createHabitatForm" method="POST" action="../handlers/interface_admin_data.php" class="mb-5">
        <input type="hidden" name="create_habitat" value="1">
        <div class="mb-3">
            <label for="habitatName" class="form-label">Nom de l'habitat:</label>
            <input type="text" id="habitatName" name="nom" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="habitatDescription" class="form-label">Description:</label>
            <input type="text" id="habitatDescription" name="description" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="habitatImage" class="form-label">Image:</label>
            <input type="text" id="habitatImage" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Créer l'habitat</button>
    </form>

 <!-- liste des habitats existants avec options de mise à jour et suppression -->
 <h2 class="py-4">Liste des Habitats</h2>
    <?php foreach ($habitats as $habitat) { ?>
        <div class="habitat-item mb-4">
            <!-- formulaire pour mettre à jour un habitat -->
            <form method="POST" action="../handlers/interface_admin_data.php">
                <input type="hidden" name="id" value="<?= $habitat['id'] ?>">
                <input type="hidden" name="action" value="update">
            
                <div class="mb-3">
                    <label for="nom_<?= $habitat['id'] ?>" class="form-label">Nom de l'habitat:</label>
                    <input type="text" id="nom_<?= $habitat['id'] ?>" name="nom" class="form-control" value="<?= $habitat['nom'] ?>" required>
                </div>
            
                <div class="mb-3">
                    <label for="description_<?= $habitat['id'] ?>" class="form-label">Description:</label>
                    <input type="text" id="description_<?= $habitat['id'] ?>" name="description" class="form-control" value="<?= $habitat['description'] ?>" required>
                </div>
            
                <div class="mb-3">
                    <label for="image_<?= $habitat['id'] ?>" class="form-label">Image:</label>
                    <input type="text" id="image_<?= $habitat['id'] ?>" name="image" class="form-control" value="<?= $habitat['image'] ?>" required>
                </div>
            
                <button type="submit" class="btn btn-warning">Mettre à jour</button>
            </form>
        
            <!-- formulaire pou supprimer un habitat -->
            <form method="POST" action="../handlers/interface_admin_data.php" class="mt-2">
                <input type="hidden" name="id" value="<?= $habitat['id'] ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    <?php } ?>