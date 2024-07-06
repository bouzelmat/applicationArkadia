<?php
namespace ecf_arkadia\Models;

require_once 'class_utilisateurs.php';
require_once 'class_rapportVeterinaire.php';

class Veterinaire extends Utilisateur {
    protected $conn;
    protected $rapportVeterinaire;

    public function __construct($db) {
        parent::__construct($db);
        $this->conn = $db;
        $this->rapportVeterinaire = new RapportVeterinaire($this->conn);
    }

    public function login($username, $password) {
        if (parent::login($username, $password)) {
            return $this->role_id === 2; // Assurez-vous que 2 correspond au rôle vétérinaire
        }
        return false;
    }

    // Utilisation de la méthode de la classe RapportVeterinaire pour créer un rapport vétérinaire
    public function createRapportVeterinaire($etat, $nourritureProposee, $grammage, $datePassage, $detailEtat, $utilisateur_id, $animal_id) {
        return $this->rapportVeterinaire->create($etat, $nourritureProposee, $grammage, $datePassage, $detailEtat, $utilisateur_id, $animal_id);
    }

    // Utilisation de la méthode de la classe RapportVeterinaire pour lire tous les rapports vétérinaires
    public function readRapportsVeterinaires() {
        return $this->rapportVeterinaire->readAll();
    }

    // Utilisation de la méthode de la classe RapportVeterinaire pour supprimer un rapport vétérinaire
    public function deleteRapportVeterinaire($id) {
        return $this->rapportVeterinaire->delete($id);
    }

    // Méthode pour lire les rapports vétérinaires filtrés
    public function readRapportsVeterinairesFiltres($filters = []) {
        return $this->rapportVeterinaire->readFiltered($filters);
    }

    
// Méthode pour créer un commentaire sur un habitat
public function createCommentaireHabitat($commentaire, $utilisateur_id, $habitat_id) {
    $query = "INSERT INTO commentaire_habitat (commentaire, utilisateur_id, habitat_id)
              VALUES (?, ?, ?)";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('sii', $commentaire, $utilisateur_id, $habitat_id);

    return $stmt->execute();
}

// Méthode pour lire tous les commentaires sur les habitats
public function readCommentairesHabitat() {
    $query = "SELECT * FROM commentaire_habitat";
    $stmt = $this->conn->query($query);
    return $stmt;
}

// Méthode pour mettre à jour un commentaire sur un habitat
public function updateCommentaireHabitat($id, $commentaire) {
    $query = "UPDATE commentaire_habitat SET commentaire = ? WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('si', $commentaire, $id);

    return $stmt->execute();
}

// Méthode pour supprimer un commentaire sur un habitat
public function deleteCommentaireHabitat($id) {
    $query = "DELETE FROM commentaire_habitat WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param('i', $id);

    return $stmt->execute();
}

}
?>
