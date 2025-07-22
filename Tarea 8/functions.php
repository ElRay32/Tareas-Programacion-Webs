<?php
// functions.php

function getPDO() {
    $cfg = require __DIR__ . '/config.php';
    $dsn = "mysql:host={$cfg['db_host']};dbname={$cfg['db_name']};charset=utf8mb4";
    return new PDO($dsn, $cfg['db_user'], $cfg['db_pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
}

function createDefaultEmployee(PDO $pdo) {
    // Si no hay empleados, crea el demo/demo/demo:tareafacil25
    $stmt = $pdo->query("SELECT COUNT(*) FROM empleados");
    if ($stmt->fetchColumn() == 0) {
        $pwHash = password_hash('tareafacil25', PASSWORD_DEFAULT);
        $pdo->prepare("
            INSERT INTO empleados (nombre, apellido, correo, password)
            VALUES (?, ?, ?, ?)
        ")->execute(['Demo', 'Demo', 'demo', $pwHash]);
    }
}

function checkLogin(PDO $pdo, $nombre, $apellido, $correo, $pass) {
    $stmt = $pdo->prepare("
        SELECT password
        FROM empleados
        WHERE nombre = ? AND apellido = ? AND correo = ?
    ");
    $stmt->execute([$nombre, $apellido, $correo]);
    $hash = $stmt->fetchColumn();
    return $hash && password_verify($pass, $hash);
}
