<?php
include_once '../../lib/main.php';
define("pagina_actual", "visitas");
Plantilla::aplicar();

// Raymel Enrique Guerrero Reynoso 2023-1677


$visitas = Dbx::list("visitas");

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
    <tbody>
        <?php foreach ($visitas as $visita): ?>
        <tr>
            <td><?php echo htmlspecialchars($visita->nombre)?></td>
            <td><?php echo htmlspecialchars($visita->apellido)?></td>
            <td><?php echo htmlspecialchars($visita->cedula)?></td>
            <td><?php echo htmlspecialchars($visita->edad)?></td>
            <td><?php echo htmlspecialchars($visita->motivo)?></td>
            <td><?php echo htmlspecialchars($visita->fecha_visita)?></td>
            <td>
                <a href="<?= base_url("modulo/Visitas/visitas.php?codigo={$visita->idx}");?>" class="btn btn-primary">Editar</a>
                <a href="<?= base_url("modulo/Visitas/eliminar_visitas.php?codigo={$visita->idx}");?>" class="btn btn-danger" onclick="return confirm('Estas seguro de eliminar esta visita?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>