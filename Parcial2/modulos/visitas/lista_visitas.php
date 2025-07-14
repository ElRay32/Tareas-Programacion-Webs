<?php
require_once '../../lib/db.php';
$db  = getDB();
$res = $db->query("SELECT * FROM personas");


// Raymel Enrique Guerrero Reynoso 2023-1677
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Personas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="divmenu">
        <ul class="nav nav-tabs">
             <li class="nav-item">
                 <a class="nav-link" href="../../index.php">Inicio</a>
             </li>
            <li class="nav-item">
                <a class="nav-link" href="lista_visitas.php">Listado de Visitas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../about.php">Cerca de mi</a>
            </li>
        </ul>
    </div>


<h3>Listas de Personas</h3>
<div class="container mt-4">
    <p class="text-center fs-4">Lista de Visitas Registradas</p>
</div>
<div class="text-end mb-3">
    <a href="crear_visitas.php" class="btn btn-success">Registar Nueva Visita</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($p = $res->fetch_assoc()): ?>
        <tr>
            <td><?=htmlspecialchars($p['nombre'])?></td>
            <td><?=htmlspecialchars($p['apellido'])?></td>
            <td><?=htmlspecialchars($p['cedula'])?></td>
            <td><?=htmlspecialchars($p['telefono'])?></td>
            <td><?=htmlspecialchars($p['correo'])?></td>
            <td>
                <a href="editar_visitas.php?id=<?=$p['id']?>" class="btn btn-sm btn-warning">Editar</a>
                <a href="eliminar_visitas.php?id=<?=$p['id']?>" class="btn btn-danger" onclick="return confirm('Estas seguro de eliminar esta visita?');">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>