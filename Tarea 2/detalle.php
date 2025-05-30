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

plantilla::aplicar();

?>
<div class="text-end">
    <button class="btn btn-primary" onclick="window.location.href='index.php'">Volver al listado</button>
    <button onclick="window.print();" class="btn btn-secondary">Imprimir</button>
</div>

<div class="row">
    <div class="col-md-12">
        <h2><?=$obra->nombre?></h2>
        <img src="<?=$obra->foto_url?>" alt="<?=$obra->nombre?>" height="200">
        <p><strong>Tipo:</strong><?= datos::tipos_de_obras()[$obra->tipo]?></p>
        <p><strong>Autor:</strong><?=$obra->autor?></p>
        <p><strong>Género:</strong><?=$obra->genero?></p>
        <p><strong>Descripción:</strong><?=$obra->descripcion?></p>
        <p><strong>País:</strong><?=$obra->pais?></p>
        <p><strong>Fecha de estreno:</strong><?=$obra->fecha_estreno?></p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h2>Personajes</h2>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Cédula</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Actor</th>
                    <th scope="col">Habilidades</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($obra->personajes as $personaje){
                    echo "<tr>";
                    echo "<td>{$personaje->cedula}</td>";
                    echo "<td><img src='{$personaje->foto_url}' alt='{$personaje->nombre}' height='100'></td>";
                    echo "<td>{$personaje->nombre}</td>";
                    echo "<td>{$personaje->apellido}</td>";
                    echo "<td>{$personaje->fecha_nacimiento}</td>";
                    echo "<td>{$personaje->sexo}</td>";
                    echo "<td>{$personaje->actor}</td>";
                    echo "<td>{$personaje->habilidades}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>