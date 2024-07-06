<?php
namespace ecf_arkadia\Config;

use MongoDB\Client;

class MongoDBConnection {
    private $uri;
    private $client;

    public function __construct() {
        $this->uri = getenv('MONGODB_URI') ?: (require __DIR__ . '/mongo_config.php')['mongo_uri'];
        if (!$this->uri) {
            throw new \Exception("L'URI MongoDB n'est pas définie");
        }
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