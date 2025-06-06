<?php

include_once '../../lib/main.php';
define("pagina_actual", "profesiones");
plantilla::aplicar();

$profesiones = Dbx::list("profesiones");

?>
<h1>Profesiones</h1>
<p>
    En el mundo de Barbie, las profesiones son tan diversas como los personajes que las ejercen. Desde la medicina hasta la ingeniería, cada profesión aporta un valor único a la sociedad y refleja la diversidad de intereses y habilidades de los personajes.
</p>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Profesión</th>
            <th>categoria</th>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($profesiones as $profesion): ?>
        <tr>
            <td><?php echo htmlspecialchars($profesion['nombre']); ?></td>
            <td><?php echo htmlspecialchars($profesion['categoria']); ?></td>
            <td><a href="<?= base_url("modulos/profesiones/editar.php?codigo={$profesion->codigo}"); ?>" class="btn btn-primary">Editar</a>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>