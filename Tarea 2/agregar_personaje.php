<?php
require_once 'lib\plantilla.php';
require_once 'lib\objetos.php';

$obra = new Obra();

$personaje = new Personaje();



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

if($_POST){
    $personaje->cedula = $_POST['cedula'];
    $personaje->foto_url = $_POST['foto_url'];
    $personaje->nombre = $_POST['nombre'];
    $personaje->apellido = $_POST['apellido'];
    $personaje->fecha_nacimiento = $_POST['fecha_nacimiento'];
    $personaje->sexo = $_POST['sexo'];
    $personaje->actor = $_POST['actor'];
    $personaje->habilidades = $_POST['habilidades'];

     if(!isset($obra->personajes)){
            $obra->personajes = [];
        }

    $obra->personajes[] = $personaje;

    if(!is_dir(filename:'datos')){
        echo "<div class='alert alert-danger'>Error: No se pudo crear el directorio de datos.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a>";
        exit();
    }

    $ruta = 'datos/' . $obra->codigo . '.json';
    

    file_put_contents(filename: $ruta, data: json_encode(value: $obra));



    echo "<div class='alert alert-success'>Personaje agregado exitosamente.</div>";
    echo "<a href='personaje.php?codigo={$obra->codigo}' class='btn btn-primary'>Volver a los personajes</a>";
    plantilla::aplicar();
    exit();

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
        <h2>Datos del Personaje</h2>
        <form method="post" action="agregar_personaje.php?codigo=<?= $obra->codigo ?>">
            <div class="mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" required>
            </div>
            <div class="mb-3">
                <label for="foto_url" class="form-label">URL de la foto</label>
                <input type="text" class="form-control" id="foto_url" name="foto_url" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-select" id="sexo" name="sexo">
                    <option value="">Seleccione...</option>
                    <option value="Masculino" <?=($personaje->sexo =='Masculino') ?'Selected': ''?>>Masculino</option>
                    <option value="Femenino" <?=($personaje->sexo =='Femenino') ?'Selected': ''?>>Femenino</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="actor" class="form-label">Actor/Actriz:</label>
                <select class="form-select" id="actor" name="actor">
                    <option value="">Seleccione...</option>
                    <option value="Actor" <?=($personaje-> actor =='Actor') ?'Selected': ''?>>Actor</option>
                    <option value="Actriz" <?=($personaje-> actor =='Actriz') ?'Selected': ''?>>Actriz</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="habilidades" class="form-label">Habilidades</label>
                <textarea class="form-control" id="habilidades" name="habilidades" rows="3"></textarea>
            </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="personaje.php?codigo=<?= $obra->codigo ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>