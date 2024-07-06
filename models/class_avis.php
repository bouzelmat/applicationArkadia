<?php
namespace ecf_arkadia\Models;

class Avis {
    private $conn;
    private $table_name = "avis";

    public $id;
    public $pseudo;
    public $commentaire;
    public $valide;
    public $utilisateur_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        // Requête SQL pour insérer un nouvel avis
        $query = "INSERT INTO " . $this->table_name . " (pseudo, commentaire, valide, utilisateur_id) VALUES (?, ?, ?, ?)";
        
        // Préparation de la requête avec mysqli
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die('Erreur de préparation de la requête SQL : ' . $this->conn->error);
        }

        // Liaison des paramètres
        $stmt->bind_param("ssii", $this->pseudo, $this->commentaire, $this->valide, $this->utilisateur_id);

        // Exécution de la requête
        if ($stmt->execute()) {
            return true;
        } else {
            die('Erreur lors de l\'exécution de la requête : ' . $stmt->error);
        }
    }

    // Méthode pour lire tous les avis non validés
    public function readNonValide() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE valide = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close(); // Ferme le statement après avoir récupéré le résultat
        return $result;
    }

    // Méthode pour valider un avis
    public function validerAvis($avis_id) {
        $query = "UPDATE avis SET valide = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die('Erreur de préparation de la requête SQL : ' . $this->conn->error);
        }

        $stmt->bind_param("i", $avis_id);

        if ($stmt->execute()) {
            return true;
        } else {
            die('Erreur lors de l\'exécution de la requête : ' . $stmt->error);
        }
    }

    // Méthode pour supprimer un avis
    public function supprimerAvis($avis_id) {
        $query = "DELETE FROM avis WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die('Erreur de préparation de la requête SQL : ' . $this->conn->error);
        }

        $stmt->bind_param("i", $avis_id);

        if ($stmt->execute()) {
            return true;
        } else {
            die('Erreur lors de l\'exécution de la requête : ' . $stmt->error);
        }
    }

    public function readValide() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE valide = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }
}
?>
