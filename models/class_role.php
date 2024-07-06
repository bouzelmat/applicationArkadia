<?php
namespace ecf_arkadia\Models;

class Role {
    private $conn;
    private $table_name = "role";

    public $id_role;
    public $nom_role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Méthode pour récupérer le nom du rôle par ID
    public function getRoleById($role_id) {
        $query = "SELECT nom_role FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            die('Erreur de préparation de la requête SQL : ' . $this->conn->error);
        }
        
        $stmt->bind_param("i", $role_id);
        $stmt->execute();
        $stmt->bind_result($nom_role);
        $stmt->fetch();
        
        return $nom_role;
    }
}
?>
