<?php
include_once '../../lib/main.php';
define("pagina_actual", "visitas");
Plantilla::aplicar();

// Raymel Enrique Guerrero Reynoso 2023-1677




?>

<h3>Visitas al Consultorio Dental</h3>
<div class="text-end mb-3">
    <a href="<?= base_url("modulo/Visitas/visitas.php");?>" class="btn btn-success">Registar Nueva Visita</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Edad</th>
            <th>Motivo</th>
            <th>Fecha y Hora</th>
            <th>Acciones</th>
        </tr>
    </thead>
</table>