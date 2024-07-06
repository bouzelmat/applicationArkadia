<?php
namespace ecf_arkadia\Config;

use MongoDB\Client;

class MongoDBConnection {
    private $uri;
    private $client;

    public function __construct() {
        // utilise l'URI de Heroku si disponible, sinon elle utilise la configuration locale
        $this->uri = getenv('MONGODB_URI') ?: (require __DIR__ . '/mongo_config.php')['mongo_uri'];
    }

    public function connect() {
        if ($this->client === null) {
            try {
                $this->client = new Client($this->uri);
                $this->client->listDatabases();
            } catch (\Exception $e) {
                error_log("Erreur de connexion MongoDB : " . $e->getMessage());
                throw new \Exception("Erreur de connexion à MongoDB");
            }
        }
        return $this->client;
    }
}