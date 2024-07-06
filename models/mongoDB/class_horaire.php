<?php

namespace ecf_arkadia\Models;

use ecf_arkadia\Config\MongoDBConnection;

class HoraireManager {
    private $collection;

    public function __construct() {
        $mongo = new MongoDBConnection();
        $client = $mongo->connect();
        $this->collection = $client->ecf_arkadia->horaires;
    }

    public function obtenirHoraires() {
        try {
            $horaires = $this->collection->find()->toArray();
            
            // Définir l'ordre des jours
            $ordre = [
                'Lundi Mardi' => 1,
                'Mercredi' => 2,
                'Jeudi Vendredi' => 3,
                'Samedi' => 4,
                'Dimanche' => 5
            ];
            
            // Trier les horaires selon l'ordre défini
            usort($horaires, function($a, $b) use ($ordre) {
                return $ordre[$a['jour']] - $ordre[$b['jour']];
            });
            
            return $horaires;
        } catch (\Exception $e) {
            error_log("Erreur lors de l'obtention des horaires : " . $e->getMessage());
            return [];
        }
    }

    public function modifierHoraires($horaires) {
        try {
            foreach ($horaires as $jour => $heures) {
                if (!isset($heures['ouverture']) || !isset($heures['fermeture'])) {
                    error_log("Données manquantes pour $jour");
                    continue;
                }
                // Formater les jours groupés
                $jourFormate = str_replace(['LundiMardi', 'JeudiVendredi'], ['Lundi Mardi', 'Jeudi Vendredi'], $jour);
                $this->collection->updateOne(
                    ['jour' => $jourFormate],
                    ['$set' => ['ouverture' => $heures['ouverture'], 'fermeture' => $heures['fermeture']]],
                    ['upsert' => true]
                );
            }
            return true;
        } catch (\Exception $e) {
            error_log("Erreur lors de la modification des horaires : " . $e->getMessage());
            return false;
        }
    }
    
    public function nettoyerDoublons() {
        try {
            $this->collection->deleteMany(['jour' => 'LundiMardi']);
            $this->collection->deleteMany(['jour' => 'JeudiVendredi']);
            return true;
        } catch (\Exception $e) {
            error_log("Erreur lors du nettoyage des doublons : " . $e->getMessage());
            return false;
        }
    }
}