<?php
namespace ecf_arkadia\Models;

class Alimentation {
    private $conn;
    private $table_name = "alimentation";

    public $id;
    public $id_animal;
    public $nourritureProposee;
    public $grammage;
    public $dateAlimentation;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour créer une alimentation
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (id_animal, nourritureProposee, grammage, dateAlimentation) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Protection contre les injections SQL
        $this->id_animal = htmlspecialchars(strip_tags($this->id_animal));
        $this->nourritureProposee = htmlspecialchars(strip_tags($this->nourritureProposee));
        $this->grammage = htmlspecialchars(strip_tags($this->grammage));
        $this->dateAlimentation = htmlspecialchars(strip_tags($this->dateAlimentation));

        $stmt->bind_param("isds", $this->id_animal, $this->nourritureProposee, $this->grammage, $this->dateAlimentation);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Méthode pour lire toutes les alimentations
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Méthode pour supprimer une alimentation par ID
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

}

