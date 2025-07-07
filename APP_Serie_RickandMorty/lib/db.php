<?php
require_once __DIR__ . '/../config/db_config.php';
function getDB(){
    static $db = null;
    if (!$db) {
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($db->connect_error) {
            die("Error de conexión MySQL: " . $db->connect_error);
        }
        $db->set_charset('utf8mb4');
    }
    return $db;
}
