<?php
namespace ecf_arkadia\Config;

class Database {
    private $host;
    private $port;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        if (getenv('JAWSDB_URL')) {
            $url = parse_url(getenv('JAWSDB_URL'));
            $this->host = $url['host'] ?? null;
            $this->port = $url['port'] ?? null;
            $this->db_name = isset($url['path']) ? ltrim($url['path'], '/') : null;
            $this->username = $url['user'] ?? null;
            $this->password = $url['pass'] ?? null;
        } else {
            $config = require __DIR__ . '/config.php';
            $this->host = $config['db_host'];
            $this->port = $config['db_port'];
            $this->db_name = $config['db_name'];
            $this->username = $config['db_username'];
            $this->password = $config['db_password'];
        }
    
        if (!$this->host || !$this->username || !$this->password || !$this->db_name) {
            throw new \Exception("Configuration de base de données incomplète");
        }
    }
    public function getConnection() {
        $this->conn = null;

        try {
            
            $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->db_name, $this->port);

            // sécurité : Vérification de la connexion
            if ($this->conn->connect_error) {
                // sécurité  : journalisation
                error_log("Erreur de connexion à la base de données : " . $this->conn->connect_error);
                throw new \Exception("Erreur de connexion à la base de données");
            }

            // sécurité  : Configuration de la connexion
            $this->conn->set_charset('utf8mb4');
            $this->conn->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);

            return $this->conn;
        } catch (\Exception $e) {
            // sécurité : journalisation
            error_log("Erreur lors de la connexion à la base de données : " . $e->getMessage());
            throw $e;
        }
    }

    // méthode pour fermer la connexion
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // méthode pour obtenir l'instance de connexion
    public function getConn() {
        return $this->conn;
    }

    // méthode pour vérifier si la connexion est active
    public function isConnected() {
        return ($this->conn && $this->conn->ping());
    }
}