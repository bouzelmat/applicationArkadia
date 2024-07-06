<?php
session_start();

// vérification du rôle de l'utilisateur connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'employe') {
    header('Location: access_denied.php');
    exit();
}

include '../handlers/interface_employe_data.php';
?>

<?php include 'header.php'; ?>

<div class="container py-4">
    <h1 class="py-4 bg-info text-center">Bienvenue sur l'interface Employé</h1>

    <div class="d-flex justify-content-end mb-4">
        <a href="../handlers/logout.php" class="btn btn-danger">Déconnexion</a>
    </div>

    <!-- affichage et gestion des messages de session -->
    <?php if (isset($_SESSION['message'])): ?> 
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>" role="alert">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    <?php endif; ?>

    <!-- contenu spécifique pour les employés -->
    <h2 class="py-5 text-success">Avis Non Validés</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avis</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $avis_non_valide->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($row['commentaire'] ?? '', ENT_QUOTES); ?></td>
                        <td>
                            <!-- bouton pour valider l'avis -->
                            <form action="../handlers/employe_process_avis.php" method="post" class="d-inline">
                                <input type="hidden" name="avis_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="valider_avis" class="btn btn-success btn-sm">Valider</button>
                            </form>
                            <!-- bouton pour supprimer l'avi -->
                            <form action="../handlers/employe_process_avis.php" method="post" class="d-inline">
                                <input type="hidden" name="avis_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="supprimer_avis" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <h2 class="py-4 text-success">Services du Zoo</h2>
    <?php
    $services = $service->read();
    while ($row = $services->fetch_assoc()): ?>
        <div class="mb-4">
            <h3><?php echo htmlspecialchars($row['nom'], ENT_QUOTES); ?></h3>
            <p><?php echo htmlspecialchars($row['description'], ENT_QUOTES); ?></p>
            <img src="<?php echo htmlspecialchars($row['image'], ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($row['nom'], ENT_QUOTES); ?>" class="img-fluid mb-3">
            <!-- form pour mettre à jour le formulaire -->
            <form action="../handlers/employe_update_service.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="service_id" value="<?php echo $row['id_service']; ?>">
                <div class="mb-3">
                    <label for="nom_<?php echo $row['id_service']; ?>" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control" id="nom_<?php echo $row['id_service']; ?>" value="<?php echo $row['nom']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description_<?php echo $row['id_service']; ?>" class="form-label">Description</label>
                    <textarea name="description" class="form-control" id="description_<?php echo $row['id_service']; ?>" required><?php echo $row['description']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_<?php echo $row['id_service']; ?>" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image_<?php echo $row['id_service']; ?>">
                </div>
                <button type="submit" name="modifier_service" class="btn btn-warning">Modifier</button>
            </form>
        </div>
    <?php endwhile; ?>

    <!-- bloc permettant à l'employé d'ajouter un rapport alimentaire pour un animal -->
    <h2 class="py-5 text-success">Animaux</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Race</th>
                    <th>Image</th>
                    <th>État</th>
                    <th>Alimentation</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $animaux->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id'] ?? '', ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($row['prenom'] ?? '', ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($row['race'] ?? '', ENT_QUOTES); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['image'] ?? '', ENT_QUOTES); ?>" alt="Image de l'animal" class="img-fluid" width="100"></td>
                        <td><?php echo htmlspecialchars($row['etat'] ?? '', ENT_QUOTES); ?></td>
                        <td>
                            <!-- formulaire alimentaire -->
                            <form action="../handlers/employe_process_alimentation.php" method="post" class="row g-3">
                                <input type="hidden" name="id_animal" value="<?php echo $row['id']; ?>">
                                <div class="col-md-4">
                                    <input type="text" name="nourritureProposee" class="form-control" placeholder="Nourriture Proposée" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" name="grammage" class="form-control" placeholder="Grammage (g)" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" name="dateAlimentation" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="ajouter_alimentation" class="btn btn-primary mt-2">Ajouter</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
    <!-- ici les évenemts crées seront stockés dans une bdd mongoDB -->
    <h2 class="py-5 text-success">Créer un Nouvel Événement</h2>
    <form action="../handlers/mongoDB/employe_process_evenement.php" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'événement</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <button type="submit" name="create_event" class="btn btn-primary">Créer Événement</button>
    </form>

    <h2 class="py-5 text-success">Liste des Événements</h2>
    <?php foreach ($evenements as $event): ?>
        <div class="mb-4">
            <h3><?php echo htmlspecialchars($event['nom'], ENT_QUOTES); ?></h3>
            <p><?php echo htmlspecialchars($event['description'], ENT_QUOTES); ?></p>
            <img src="<?php echo htmlspecialchars($event['image'], ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($event['nom'], ENT_QUOTES); ?>" class="img-fluid mb-3" style="max-width: 100px;">
            <p>Date: <?php echo htmlspecialchars($event['date'], ENT_QUOTES); ?></p>
            <!-- formulaire pour mettre à jour un événement -->
            <form action="../handlers/mongoDB/employe_process_evenement.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="event_id" value="<?php echo $event['_id']; ?>">
                <div class="mb-3">
                    <label for="nom_<?php echo $event['_id']; ?>" class="form-label">Nom de l'événement</label>
                    <input type="text" class="form-control" id="nom_<?php echo $event['_id']; ?>" name="nom" value="<?php echo htmlspecialchars($event['nom'], ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description_<?php echo $event['_id']; ?>" class="form-label">Description</label>
                    <textarea class="form-control" id="description_<?php echo $event['_id']; ?>" name="description" rows="3" required><?php echo htmlspecialchars($event['description'], ENT_QUOTES); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image_<?php echo $event['_id']; ?>" class="form-label">Image URL</label>
                    <input type="text" class="form-control" id="image_<?php echo $event['_id']; ?>" name="image" value="<?php echo htmlspecialchars($event['image'], ENT_QUOTES); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date_<?php echo $event['_id']; ?>" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date_<?php echo $event['_id']; ?>" name="date" value="<?php echo htmlspecialchars($event['date'], ENT_QUOTES); ?>" required>
                </div>
                <button type="submit" name="update_event" class="btn btn-warning">Modifier</button>
            </form>
            <form action="../handlers/mongoDB/employe_process_evenement.php" method="post" class="d-inline">
                <input type="hidden" name="event_id" value="<?php echo $event['_id']; ?>">
                <button type="submit" name="delete_event" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cet événement?');">Supprimer</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
