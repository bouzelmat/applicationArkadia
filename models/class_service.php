<?php
namespace ecf_arkadia\Models;

class Service {
    private $conn;
    private $table_name = "service";

    public $id_service;
    public $nom;
    public $description;
    public $image;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour créer un service
    public function create($nom, $description, $image) {
        $query = "INSERT INTO " . $this->table_name . " (nom, description, image) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
    
        // Protection contre les injections SQL
        $nom = htmlspecialchars(strip_tags($nom));
        $description = htmlspecialchars(strip_tags($description));
        $image = htmlspecialchars(strip_tags($image));
    
        $stmt->bind_param("sss", $nom, $description, $image);
    
        if ($stmt->execute()) {
            return true;
        } else {
            // Afficher l'erreur SQL
            echo "Erreur: " . $this->conn->error;
            return false;
        }
    }

    // Méthode pour lire tous les services  §
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    // Méthode pour lire un seul service §
    public function read_one($id_service) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_service=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_service);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Méthode pour mettre à jour un service §
    public function update($service_id, $nom, $description, $image) {
        $query = "UPDATE " . $this->table_name . " SET nom=?, description=?, image=? WHERE id_service=?";
        $stmt = $this->conn->prepare($query);

        // Protection contre les injections SQL
        $nom = htmlspecialchars(strip_tags($nom));
        $description = htmlspecialchars(strip_tags($description));
        $image = htmlspecialchars(strip_tags($image));
        $service_id = intval($service_id);

        $stmt->bind_param("sssi", $nom, $description, $image, $service_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Méthode pour supprimer un service
    public function delete($service_id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_service=?";
        $stmt = $this->conn->prepare($query);

        // Protection contre les injections SQL
        $service_id = intval($service_id);

        $stmt->bind_param("i", $service_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
