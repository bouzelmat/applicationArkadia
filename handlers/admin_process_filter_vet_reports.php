<!-- fichier de traitement de l'interface admin -->
<?php
// traitement du formulaire de filtrage des rapports vétérinaires
if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_GET['datePassage']) || isset($_GET['animal_id']))) {
    $filters = [];
    if (isset($_GET['datePassage'])) {
        $filters['datePassage'] = $_GET['datePassage'];
    }
    if (isset($_GET['animal_id'])) {
        $filters['animal_id'] = $_GET['animal_id'];
    }

    $rapports = $rapportVeterinaire->read($filters);

    if ($rapports->num_rows > 0) {
        // affichage du tableau des rapports filtrés
        echo '<div class="container my-5">
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>État</th>
                                <th>Nourriture Proposée</th>
                                <th>Grammage</th>
                                <th>Date de Passage</th>
                                <th>Détail État</th>
                                <th>ID Utilisateur</th>
                                <th>ID Animal</th>
                                <th>Prénom Animal</th>
                            </tr>
                        </thead>
                        <tbody>';
        while ($row = $rapports->fetch_assoc()) {
            echo '<tr>
                     <td>' . (isset($row['id']) ? htmlspecialchars($row['id']) : '') . '</td>
                     <td>' . (isset($row['etat']) ? htmlspecialchars($row['etat']) : '') . '</td>
                     <td>' . (isset($row['nourritureProposee']) ? htmlspecialchars($row['nourritureProposee']) : '') . '</td>
                     <td>' . (isset($row['grammage']) ? htmlspecialchars($row['grammage']) : '') . '</td>
                     <td>' . (isset($row['datePassage']) ? htmlspecialchars($row['datePassage']) : '') . '</td>
                     <td>' . (isset($row['detailEtat']) ? htmlspecialchars($row['detailEtat']) : '') . '</td>
                     <td>' . (isset($row['utilisateur_id']) ? htmlspecialchars($row['utilisateur_id']) : '') . '</td>
                     <td>' . (isset($row['animal_id']) ? htmlspecialchars($row['animal_id']) : '') . '</td>
                     <td>' . (isset($row['prenom']) ? htmlspecialchars($row['prenom']) : '') . '</td>
                </tr>';
        }
        echo '      </tbody>
                    </table>
                </div>
              </div>';
    } else {
        echo '<div class="container my-5">
                <p>Aucun rapport trouvé.</p>
              </div>';
    }

}
?>