<?php
require_once 'lib\main.php';

$obra = new Obra();

if(isset($_GET['codigo'])){
    $ruta = 'datos/' .$_GET['codigo'] . '.json';

    if(is_file(filename: $ruta)){
        $json = file_get_contents(filename: $ruta);
        $obra = json_decode(json: $json);
    }else {
        plantilla::aplicar();
        echo "<div class='text-center'><div class='alert alert-danger'>Error: No se encontró la obra con el código especificado.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a></div>";
        exit();
    }

}
$plantilla = plantilla::aplicar();
?>

<div class="row">
    <div class="col-md-4">
        <h2><?= $obra->nombre; ?></h2>
        <img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="200">
        <p><strong>Tipo:</strong><?= datos::tipos_de_obras()[$obra->tipo]?></p>
        <p><strong>Genero:</strong> <?= $obra->genero ?></p>
        <p><strong>Descripción:</strong> <?= $obra->descripcion ?></p>
        <p><strong>País:</strong> <?= $obra->pais ?></p>
        <p><strong>Fecha de estreno:</strong> <?= $obra->fecha_estreno ?></p>
        <p><strong>Autor:</strong> <?= $obra->autor ?></p>
    </div>

<div class="col-md-8">
    <h2>Personajes</h2>
    <div class="alert alert-info">
        <p>En esta sección puedes ver los personajes de la obra <strong><?= $obra->nombre ?></strong>.</p>
        <p>Si deseas agregar un nuevo personaje, haz clic en el botón "Agregar Personaje".</p>
    </div>
    <div class="mt-3">
        <a href="index.php" class="btn btn-secondary">Volver al listado</a>
    </div>
    <div class="text-end mt-3">
        <a href="agregar_personaje.php?codigo=<?= $obra->codigo ?>" class="btn btn-primary">Agregar Personaje</a>
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Cedula</th>
                <th scope="col">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Sexo</th>
                <th scope="col">Actor/Actriz</th>
                <th scope="col">Habilidades</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($obra->personajes as $personaje){
                echo "<tr>
                    <td>$personaje->cedula</td>
                    <td><img src='$personaje->foto_url' alt='$personaje->nombre' height='50'></td>
                    <td>$personaje->nombre</td>
                    <td>$personaje->apellido</td>
                    <td>$personaje->fecha_nacimiento</td>
                    <td>$personaje->sexo</td>
                    <td>$personaje->actor</td>
                    <td>$personaje->habilidades</td>
                    <td>
                        <a href='eliminar_personaje.php?codigo={$obra->codigo}&cedula={$personaje->cedula}' class='btn btn-danger'>Eliminar</a>
                    </td>
                </tr>";
            } ?>
        </tbody>
    </table>
</div>