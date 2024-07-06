<?php
$url = parse_url(getenv("JAWSDB_URL"));
return [
    'db_host' => $url["host"],
    'db_port' => $url["port"],
    'db_name' => ltrim($url["path"], "/"),
    'db_username' => $url["user"],
    'db_password' => $url["pass"],
];