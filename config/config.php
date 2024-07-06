<?php
$url = parse_url(getenv("JAWSDB_URL") ?: '');
return [
    'db_host' => $url["host"] ?? null,
    'db_port' => $url["port"] ?? null,
    'db_name' => isset($url["path"]) ? ltrim($url["path"], "/") : null,
    'db_username' => $url["user"] ?? null,
    'db_password' => $url["pass"] ?? null,
];