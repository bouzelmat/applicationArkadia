<?php
return [
    'mongo_uri' => getenv("MONGODB_URI") ?: null,
    'mongo_options' => [
        // options supplémentaires si nécessaire
    ]
];