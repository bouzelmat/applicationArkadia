<?php
namespace ecf_arkadia\Models;
class Habitat {
    private $conn;
    private $table_name = "habitats";

    public $id;
    public $nom;
    public $description;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour créer un habitat
    public function create($nom, $description, $image) {
        $query = "INSERT INTO " . $this->table_name . " (nom, description, image) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            throw new \Exception("Erreur de préparation de la requête : " . $this->conn->error);
        }

        $stmt->bind_param("sss", $nom, $description, $image);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new \Exception("Erreur lors de l'exécution de la requête : " . $stmt->error);
        }
    }
    // Méthode pour lire tous les habitats
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
    
        return $result; // Retourner directement l'objet résultat
    }

    public function update($id, $nom, $description, $image) {
        $query = "UPDATE " . $this->table_name . " SET nom=?, description=?, image=? WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $nom = htmlspecialchars(strip_tags($nom));
        $description = htmlspecialchars(strip_tags($description));
        $image = htmlspecialchars(strip_tags($image));
        $id = intval($id);

        $stmt->bind_param("sssi", $nom, $description, $image, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);

        $id = intval($id);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
?>
