<?php
//cette class encapsule la class avis. les methodes de la class avis ne peuvent etre utilisées qu'à travers la class employé
namespace ecf_arkadia\Models;

require_once 'class_utilisateurs.php';
require_once 'class_avis.php';

class Employe extends Utilisateur {
    private $avis;

    public function __construct($db) {
        parent::__construct($db);
        $this->avis = new Avis($db);
    }

    public function login($username, $password) {
        if (parent::login($username, $password)) {
            return $this->role_id === 3; 
        }
        return false;
    }

    public function getAvisInstance() {
        return $this->avis;
    }

    public function validerAvis($avis_id) {
        return $this->avis->validerAvis($avis_id);
    }

    public function supprimerAvis($avis_id) {
        return $this->avis->supprimerAvis($avis_id);
    }
    public function readAvisValide() {
        return $this->avis->readValide();
    }
}
?>
