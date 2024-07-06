<?php

namespace ecf_arkadia\Models;

require_once 'class_utilisateurs.php';
require_once __DIR__ . '/../config/MongoDBConnection.php';

class Administrateur extends Utilisateur {
    private $mongoClient;

    public function __construct($db, $mongoClient) {
        parent::__construct($db);
        $this->mongoClient = $mongoClient;
    }

    public function login($username, $password) {
        if (parent::login($username, $password)) {
            return $this->role_id === 1; // Assurez-vous que 1 correspond au rôle admin
        }
        return false;
    }

    public function modifierHoraires($jour, $ouverture, $fermeture) {
        $collection = $this->mongoClient->ecf_arkadia->horaires;
        $collection->updateOne(
            [ 'jour' => $jour ],
            [ '$set' => [ 'ouverture' => $ouverture, 'fermeture' => $fermeture ] ]
        );
    }
    public function creerCompte($username, $email, $password, $prenom, $nom, $role_id) {
        // Vérifier si le nom d'utilisateur ou l'email existe déjà
        $query = "SELECT id FROM utilisateur WHERE username = ? OR email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Nom d'utilisateur ou email déjà utilisé
            return false;
        }

        // Insérer l'utilisateur
        $query = "INSERT INTO utilisateur (username, email, password, prenom, nom, role_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssssi", $username, $email, $hashed_password, $prenom, $nom, $role_id);

        return $stmt->execute();
    }
}