<?php
// il y a des méthodes de cette class qui sont utilisées par la class veterinaire à travers l'encapsulation. la methode read($filters = []) est utilisée par l'admin. la methode readAll() est egalemnt utilisé dans la page habitats et animaux du site web afin d'affichre une modale contenant le rapport veterinaire
namespace ecf_arkadia\Models;

require_once 'class_utilisateurs.php';

class RapportVeterinaire {
    private $conn;
    private $table_name = "rapport_veterinaire";

    public $id;
    public $etat;
    public $nourritureProposee;
    public $grammage;
    public $datePassage;
    public $detailEtat;
    public $utilisateur_id;
    public $animal_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($etat, $nourritureProposee, $grammage, $datePassage, $detailEtat, $utilisateur_id, $animal_id) {
        $query = "INSERT INTO " . $this->table_name . " (etat, nourritureProposee, grammage, datePassage, detailEtat, utilisateur_id, animal_id)
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssissii', $etat, $nourritureProposee, $grammage, $datePassage, $detailEtat, $utilisateur_id, $animal_id);

        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    // Méthode pour lire les rapports vétérinaires filtrés
    public function readFiltered($filters = []) {
        $query = "SELECT rv.*, a.prenom FROM " . $this->table_name . " rv JOIN animaux a ON rv.animal_id = a.id";
        $conditions = [];
        $params = [];
        $types = '';

        if (!empty($filters['datePassage'])) {
            $conditions[] = "rv.datePassage = ?";
            $params[] = $filters['datePassage'];
            $types .= 's';
        }

        if (!empty($filters['animal_id'])) {
            $conditions[] = "rv.animal_id = ?";
            $params[] = $filters['animal_id'];
            $types .= 'i';
        }

        if ($conditions) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->conn->prepare($query);

        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
    // cette methode n'est pas encapsulée dans la class veterinaire car elle est utilisé par la class admin. elle est utilisée pour interroger la base de données et récupérer les rapports vétérinaires en fonction des filtres spécifiés 
    public function read($filters = []) {
        $query = "SELECT rv.*, a.prenom FROM " . $this->table_name . " rv JOIN animaux a ON rv.animal_id = a.id";
        $conditions = [];
        $params = [];
        $types = '';

        if (!empty($filters['datePassage'])) {
            $conditions[] = "rv.datePassage = ?";
            $params[] = $filters['datePassage'];
            $types .= 's';
        }

        if (!empty($filters['animal_id'])) {
            $conditions[] = "rv.animal_id = ?";
            $params[] = $filters['animal_id'];
            $types .= 'i';
        }

        if ($conditions) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $this->conn->prepare($query);

        if ($params) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
