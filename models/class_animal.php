<?php
namespace ecf_arkadia\Models;

class Animal {
    private $conn;
    private $table_name = "animaux";

    public $id;
    public $prenom;
    public $race;
    public $image;
    public $etat;
    public $habitat_id;
    public $utilisateur_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour créer un animal
    public function create($prenom, $race, $image, $etat, $habitat_id) {
        $query = "INSERT INTO " . $this->table_name . " (prenom, race, image, etat, habitat_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            throw new \Exception("Erreur de préparation de la requête : " . $this->conn->error);
        }

        // Protection contre les injections SQL
        $prenom = htmlspecialchars(strip_tags($prenom));
        $race = htmlspecialchars(strip_tags($race));
        $image = htmlspecialchars(strip_tags($image));
        $etat = htmlspecialchars(strip_tags($etat));
        $habitat_id = htmlspecialchars(strip_tags($habitat_id));

        $stmt->bind_param("ssssi", $prenom, $race, $image, $etat, $habitat_id);

        if ($stmt->execute()) {
            $stmt->close(); // Libérer le statement après exécution
            return true;
        }
        $stmt->close();
        return false;
    }

    // Méthode pour lire tous les animaux
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
    
        return $result; // Retourner directement l'objet résultat
    }

    // Méthode pour supprimer un animal
    public function delete($id) {
        // Vérifiez si l'ID existe
        $check_query = "SELECT id FROM " . $this->table_name . " WHERE id=?";
        $check_stmt = $this->conn->prepare($check_query);
        $check_stmt->bind_param("i", $id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
    
        if ($check_result->num_rows == 0) {
            echo "L'animal avec l'ID " . $id . " n'existe pas.";
            return false;
        }
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
    
        if ($stmt === false) {
            echo "Erreur de préparation de la requête : " . $this->conn->error;
            return false;
        }
    
        $id = intval($id);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Erreur lors de l'exécution de la requête de suppression : " . $stmt->error;
        }
    
        $stmt->close();
        return false;
    }
    
}
?>
