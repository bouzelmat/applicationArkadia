<?php
namespace ecf_arkadia\Models;

abstract class Utilisateur {
    protected $conn;
    private $table_name = "utilisateur";

    public $id;
    public $username;
    public $email;
    public $password;
    public $prenom;
    public $nom;
    public $role_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT id, username, password, role_id FROM " . $this->table_name . " WHERE username = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die('Erreur de préparation de la requête SQL : ' . $this->conn->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($this->id, $this->username, $this->password, $this->role_id);
            $stmt->fetch();

            if (password_verify($password, $this->password)) {
                return true;
            }
        }

        return false;
    }

    public function updatePassword($username, $new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        $query = "UPDATE " . $this->table_name . " SET password = ? WHERE username = ?";

        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die('Erreur de préparation de la requête SQL : ' . $this->conn->error);
        }

        $stmt->bind_param("ss", $hashed_password, $username);

        if ($stmt->execute()) {
            echo "Mot de passe de l'utilisateur '$username' mis à jour avec succès.<br>";
        } else {
            die('Erreur lors de la mise à jour du mot de passe : ' . $stmt->error);
        }
    }
}
?>