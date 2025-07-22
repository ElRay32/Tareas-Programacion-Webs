<?php
// install.php
require_once __DIR__ . '/functions.php';

// 1) Cargo la configuración
$cfg = require __DIR__ . '/config.php';

try {
    // 2) Conexión al servidor **sin** especificar base de datos
    $dsnServer = "mysql:host={$cfg['db_host']};charset=utf8mb4";
    $pdoServer = new PDO(
        $dsnServer,
        $cfg['db_user'],
        $cfg['db_pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // 3) Creo la base de datos si no existe
    $pdoServer->exec("
        CREATE DATABASE IF NOT EXISTS `{$cfg['db_name']}`
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci
    ");

    // 4) Ahora sí me conecto a la BD recién creada
    $dsnDb = "mysql:host={$cfg['db_host']};dbname={$cfg['db_name']};charset=utf8mb4";
    $pdo = new PDO(
        $dsnDb,
        $cfg['db_user'],
        $cfg['db_pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // 5) Ejecuto el esquema
    $sql = file_get_contents(__DIR__ . '/sql/schema.sql');
    $pdo->exec($sql);

    // 6) Creo el empleado “demo” por defecto
    createDefaultEmployee($pdo);

    echo "¡Instalación completada con éxito!";

} catch (PDOException $e) {
    echo "Error en la instalación: " . $e->getMessage();
}
