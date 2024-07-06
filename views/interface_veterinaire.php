<?php
session_start();
// vérification du rôle de l'utilisateur connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'veterinaire') {
    header('Location: access_denied.php');
    exit();
}
include '../handlers/Rapport_veterinaire_data.php';
include 'header.php';
?>

<div class="container py-4">
    <h1 class="py-4 bg-info text-center">Bienvenue sur l'interface Vétérinaire</h1>

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
    
    <!-- ici on va retrouver le rapport alimentaire envoyé par l'utilisateur employe -->
    <h2 class="py-4 text-success">Informations d'alimentation</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID de l'animal</th>
                    <th>Nourriture Proposée</th>
                    <th>Grammage</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $alimentations->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($row['nourritureProposee'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($row['grammage'], ENT_QUOTES); ?></td>
                        <td><?php echo isset($row['datePassage']) ? htmlspecialchars($row['datePassage'], ENT_QUOTES) : ''; ?></td>
                        <td>
                            <form action="../handlers/rapport_veterinaire_data.php" method="post" class="d-inline">
                                <input type="hidden" name="action" value="delete_alimentation">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ces informations d\'alimentation ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- formulaire pour ajouter un rapport vétérinaire -->
    <h2 class="py-4 text-success">Ajouter un rapport vétérinaire</h2>
    <form action="interface_veterinaire.php" method="post">
        <input type="hidden" name="action" value="ajouter_rapport">
        <div class="mb-3">
            <label for="etat" class="form-label">État de l'animal :</label>
            <input type="text" name="etat" id="etat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nourritureProposee" class="form-label">Nourriture proposée :</label>
            <input type="text" name="nourritureProposee" id="nourritureProposee" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="grammage" class="form-label">Grammage :</label>
            <input type="number" name="grammage" id="grammage" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="datePassage" class="form-label">Date de passage :</label>
            <input type="date" name="datePassage" id="datePassage" class="form-control" value="<?php echo isset($row['datePassage']) ? htmlspecialchars($row['datePassage'], ENT_QUOTES) : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="detailEtat" class="form-label">Détails de l'état :</label>
            <textarea name="detailEtat" id="detailEtat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="animal_id" class="form-label">ID de l'animal :</label>
            <select name="animal_id" id="animal_id" class="form-control" required>
                <?php while ($animal = $animaux->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($animal['id'], ENT_QUOTES); ?>">
                        <?php echo htmlspecialchars($animal['prenom'] . ' (' . $animal['race'] . ')', ENT_QUOTES); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>

    <!-- formulaire pour ajouter un commentaire sur un habitat -->
    <h2 class="py-4 text-success">Ajouter un commentaire sur un habitat</h2>
    <form action="interface_veterinaire.php" method="post">
        <input type="hidden" name="action" value="ajouter_commentaire">
        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="habitat_id" class="form-label">Nom de l'habitat :</label>
            <select name="habitat_id" id="habitat_id" class="form-control" required>
                <?php while ($habitat = $habitats->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($habitat['id'], ENT_QUOTES); ?>">
                        <?php echo htmlspecialchars($habitat['nom'], ENT_QUOTES); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>

    <!-- affichage des rapports vétérinaires -->
    <h2 class="py-4 text-success">Rapports vétérinaires</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>État</th>
                    <th>Nourriture Proposée</th>
                    <th>Grammage</th>
                    <th>Date de Passage</th>
                    <th>Détails de l'État</th>
                    <th>ID Utilisateur</th>
                    <th>Nom de l'animal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $rapportsVeterinaires->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo isset($row['id']) ? htmlspecialchars($row['id'], ENT_QUOTES) : ''; ?></td>
                        <td><?php echo htmlspecialchars($row['etat'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($row['nourritureProposee'], ENT_QUOTES); ?></td>
                        <td><?php echo isset($row['grammage']) ? htmlspecialchars($row['grammage'], ENT_QUOTES) : ''; ?></td>
                        <td><?php echo isset($row['datePassage']) && $row['datePassage'] !== null ? htmlspecialchars($row['datePassage'], ENT_QUOTES) : ''; ?></td>
                        <td><?php echo htmlspecialchars($row['detailEtat'], ENT_QUOTES); ?></td>
                        <td><?php echo isset($row['utilisateur_id']) ? htmlspecialchars($row['utilisateur_id'], ENT_QUOTES) : ''; ?></td>
                        <td>
                            <?php
                            $animal_id = $row['animal_id'];
                            $animal_name_query = "SELECT prenom FROM animaux WHERE id = $animal_id";
                            $animal_name_result = $db->query($animal_name_query);
                            if ($animal_name_result && $animal_name = $animal_name_result->fetch_assoc()) {
                                echo htmlspecialchars($animal_name['prenom'], ENT_QUOTES);
                            }
                            ?>
                        </td>
                        <td>
                            <form action="interface_veterinaire.php" method="post" class="d-inline">
                                <input type="hidden" name="action" value="supprimer_rapport">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rapport ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- affichage des commentaires sur les habitats -->
    <h2 class="py-4 text-success">Commentaires sur les habitats</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Commentaire</th>
                    <th>ID Utilisateur</th>
                    <th>Nom de l'habitat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $commentaires->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?></td>
                        <td><?php echo htmlspecialchars($row['commentaire'], ENT_QUOTES); ?></td>
                        <td><?php echo isset($row['utilisateur_id']) ? htmlspecialchars($row['utilisateur_id'], ENT_QUOTES) : ''; ?></td>
                        <td>
                            <?php
                            $habitat_id = $row['habitat_id'];
                            $habitat_name_query = "SELECT nom FROM habitats WHERE id = $habitat_id";
                            $habitat_name_result = $db->query($habitat_name_query);
                            if ($habitat_name_result && $habitat_name = $habitat_name_result->fetch_assoc()) {
                                echo htmlspecialchars($habitat_name['nom'], ENT_QUOTES);
                            }
                            ?>
                        </td>
                        <td>
                            <form action="interface_veterinaire.php" method="post" class="d-inline">
                                <input type="hidden" name="action" value="supprimer_commentaire">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
