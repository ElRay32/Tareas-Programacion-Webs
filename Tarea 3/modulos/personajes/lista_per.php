<?php

include_once '../../lib/main.php';
define("pagina_actual", "personajes");
plantilla::aplicar();

$personajes = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");

// Crear un mapa de idx => nombre
$mapa_profesiones = [];
foreach ($profesiones as $prof) {
    $mapa_profesiones[$prof->idx] = $prof->nombre;
}

?>
<h3>Personajes</h3>

<div class="text-end mb-3">
    <a href="<?= base_url("modulos/personajes/editar.php"); ?>" class="btn btn-success">Nuevo Personaje</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Experiencia</th>
            <th>Profesión</th>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($personajes as $personaje): ?>
        <tr>
            <td>
                <?php if (!empty($personaje->foto)): ?>
                    <img src="<?= htmlspecialchars($personaje->foto); ?>" alt="Foto" style="height:60px; border-radius:10px;">
                <?php else: ?>
                    <span class="text-muted">Sin foto</span>
                <?php endif; ?>
            </td>
            <td><?php echo htmlspecialchars($personaje->nombre); ?></td>
            <td><?php echo htmlspecialchars($personaje->edad()); ?></td>
            <td><?php echo htmlspecialchars($personaje->nivel_experiencia); ?></td>
            <td><?= isset($mapa_profesiones[$personaje->profesion]) ? htmlspecialchars($mapa_profesiones[$personaje->profesion]) : '<span class="text-muted">Sin profesión</span>'; ?></td>
            <td><a href="<?= base_url("modulos/personajes/editar.php?codigo={$personaje->idx}"); ?>" class="btn btn-primary">Editar</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
