<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../../lib/db.php';


if ($_SERVER['REQUEST_METHOD']==='POST') {
    $n    = $_POST['nombre'];
    $l    = $_POST['apellido'];
    $q    = $_POST['cedula'];
    $c    = $_POST['telefono'];
    $t    = $_POST['correo'];
    $db   = getDB();
    $stmt = $db->prepare("INSERT INTO personas (nombre, apellido, cedula, telefono, correo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssis', $n, $l, $q, $c, $t);
    $stmt->execute();
    header('Location: lista_visitas.php');
    exit;
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Personas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<h3>
    Registar Nueva Visita
</h3>

<form method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-lebel">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Apellido</label>
        <input type="text" name="apellido" class="form-control" id="apellido" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Cedula</label>
        <input type="text" name="cedula" class="form-control" id="cedula" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Telefono</label>
        <input type="text" name="telefono" class="form-control" id="telefono" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Correo</label>
        <input type="email" name="correo" class="form-control" id="correo" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Visita</button>
    <a href="lista_visitas.php" class="btn btn-secondary">Cancelar</a>

</form>