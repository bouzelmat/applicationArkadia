<?php
namespace ecf_arkadia\Models;

use ecf_arkadia\Config\MongoDBConnection;
use MongoDB\BSON\ObjectId;

class Evenement {
    private $collection;

    public function __construct() {
        $mongo = new MongoDBConnection();
        $client = $mongo->connect();
        $this->collection = $client->ecf_arkadia->evenements;
    }
    // actions CRUD sur les évenements

    public function create($nom, $description, $image, $date) {
        $result = $this->collection->insertOne([
            'nom' => $nom,
            'description' => $description,
            'image' => $image,
            'date' => $date
        ]);
        return $result->getInsertedId();
    }

    public function readAll() {
        return $this->collection->find()->toArray();
    }

    public function update($id, $nom, $description, $image, $date) {
        $this->collection->updateOne(
            ['_id' => new ObjectId($id)],
            ['$set' => [
                'nom' => $nom,
                'description' => $description,
                'image' => $image,
                'date' => $date
            ]]
        );
    }

    public function delete($id) {
        $this->collection->deleteOne(['_id' => new ObjectId($id)]);
    }
}
?>
