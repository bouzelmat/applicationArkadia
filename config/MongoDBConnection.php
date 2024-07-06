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
                $options = [
                    'tls' => true,
                    'tlsAllowInvalidCertificates' => true,
                    'retryWrites' => true,
                    'w' => 'majority',
                    'serverSelectionTimeoutMS' => 5000,
                    'connectTimeoutMS' => 10000
                ];
                error_log("Tentative de connexion à MongoDB avec l'URI : " . $this->uri);
                $this->client = new Client($this->uri, $options);
                $this->client->listDatabases();
                error_log("Connexion à MongoDB réussie");
            } catch (\Exception $e) {
                error_log("Erreur de connexion MongoDB détaillée : " . $e->getMessage());
                throw new \Exception("Erreur de connexion à MongoDB: " . $e->getMessage());
            }
        }
        return $this->client;
    }
}
