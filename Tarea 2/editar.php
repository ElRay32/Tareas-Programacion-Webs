<?php
require_once 'lib\plantilla.php';
require_once 'lib\objetos.php';

$obra = new Obra();

if(isset($_GET['codigo'])){
    $codigo = $_GET['codigo'];
    $ruta = 'datos/' . $codigo . '.json';

    if(file_exists(filename: $ruta)){
        $json = file_get_contents(filename: $ruta);
        $obra = json_decode(json: $json);
    } 
}

if($_POST){
    $obra->codigo = $_POST['codigo'];
    $obra->foto_url = $_POST['foto_url'];
    $obra->tipo = $_POST['tipo'];
    $obra->genero = $_POST['genero'];
    $obra->nombre = $_POST['nombre'];
    $obra->descripcion = $_POST['descripcion'];
    $obra->pais = $_POST['pais'];
    $obra->fecha_estreno = $_POST['fecha_estreno'];
    $obra->autor = $_POST['autor'];

    if(!is_dir(filename: 'datos')){
        mkdir(directory: 'datos');
    }

    if(!is_dir(filename: 'datos')){
        plantilla::aplicar();
        echo "<div class='alert alert-danger'>Error: No se pudo crear el directorio de datos.</div>";
        echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a>";
        exit();
    }

    $ruta = 'datos/' . $obra->codigo . '.json';
    $json = json_encode(value: $obra);

    file_put_contents(filename:$ruta, data:$json);

    plantilla::aplicar();
    echo "<div class='alert alert-success'>Obra guardada exitosamente.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a>";
    exit();
    }
    plantilla::aplicar();
?>

<form method="post" action="editar.php">

    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $obra->codigo; ?>" required>
    </div>

    <div class="mb-3">
        <label for="foto_url" class="form-label">URL de la imagen</label>
        <input type="text" class="form-control" id="foto_url" name="foto_url" value="<?php echo $obra->foto_url; ?>" required>
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo</label>
        <select class="form-select" id="tipo" name="tipo">
            <option value="" selected disabled>Seleccione un tipo</option>
            <?php
            foreach (datos::tipos_de_obras() as $key => $value) {
                echo "<option value='$key'>$value</option>";
            }
            ?> 
        </select>
    </div>

    <div class="mb-3">
        <label for="genero" class="form-label">Género</label>
        <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $obra->genero; ?>" required>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $obra->nombre; ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion"><?php echo $obra->descripcion; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="pais" class="form-label">País</label>
        <input type="text" class="form-control" id="pais" name="pais" value="<?php echo $obra->pais; ?>" required>
    </div>

    <div class="mb-3">
        <label for="fecha_estreno" class="form-label">Fecha de estreno</label>
        <input type="date" class="form-control" id="fecha_estreno" name="fecha_estreno" value="<?php echo $obra->fecha_estreno; ?>" required>
    </div>

    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $obra->autor; ?>" required>
    </div>
    
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>