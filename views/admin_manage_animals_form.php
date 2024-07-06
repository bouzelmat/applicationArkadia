 <!-- formulaire pour créer un animal -->
<h2 class="py-4">Gestion des Animaux</h2>
<form id="createAnimalForm" method="POST" action="../handlers/interface_admin_data.php" class="mb-5">
    <input type="hidden" name="create_animal" value="1">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="animalPrenom" class="form-label">Prénom de l'animal:</label>
            <input type="text" id="animalPrenom" name="prenom" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="animalRace" class="form-label">Race de l'animal:</label>
            <input type="text" id="animalRace" name="race" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="animalImage" class="form-label">Image:</label>
            <input type="text" id="animalImage" name="image" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="animalEtat" class="form-label">État:</label>
            <input type="text" id="animalEtat" name="etat" class="form-control">
        </div>
    </div>
    <div class="mb-3">
        <label for="animalHabitatId" class="form-label">ID de l'habitat:</label>
        <input type="number" id="animalHabitatId" name="habitat_id" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Créer l'animal</button>
</form>

<!-- liste des animaux existants avec options de suppression -->
<h2 class="py-4">Liste des Animaux</h2>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Race</th>
                <th>Image</th>
                <th>État</th>
                <th>Habitat ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($animaux)): ?>
                <?php foreach ($animaux as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['prenom'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['race'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['image'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" alt="Image de l'animal" width="100"></td>
                        <td><?php echo htmlspecialchars($row['etat'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['habitat_id'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <form method="POST" action="../handlers/interface_admin_data.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal?');">
                                <input type="hidden" name="animal_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="delete_animal" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Aucun animal trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
