<?php
// cette class est utilisée pour traiter l'envoi de message depuis la page contact du site web
namespace ecf_arkadia\Models;

class ContactMessages {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function saveMessage($name, $email, $subject, $message) {
        $stmt = null;
        try {
            $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('ssss', $name, $email, $subject, $message);
            $stmt->execute();
            
            // SÉCURITÉ : Journalisation
            error_log("Nouveau message de contact enregistré pour : $email");

            // Envoi d'un email de notification à l'employé
            $to = "joseArkadiaZoo@gmail.com";
            $email_subject = "Nouveau message de contact: " . htmlspecialchars($subject);
            $email_body = "Vous avez reçu un nouveau message de contact.\n\n".
                          "Nom: " . htmlspecialchars($name) . "\n".
                          "Email: " . htmlspecialchars($email) . "\n\n".
                          "Message:\n" . htmlspecialchars($message);
            $headers = "From: noreply@votredomaine.com\r\n";
            $headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            
            if (mail($to, $email_subject, $email_body, $headers)) {
                error_log("Email de notification envoyé pour le message de contact de : $email");
            } else {
                error_log("Échec de l'envoi de l'email de notification pour le message de contact de : $email");
            }

            return true;
        } catch (\Exception $e) {
            error_log("Erreur lors de l'enregistrement du message de contact : " . $e->getMessage());
            return false;
        } finally {
            if ($stmt) {
                $stmt->close();
            }
        }
    }

    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
