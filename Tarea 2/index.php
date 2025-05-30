<?php
require_once 'lib\plantilla.php';
$plantilla = plantilla::aplicar();
?>

     <div class="text-end mt-3">
        <a href="editar.php" class="btn btn-primary">Agregar Personaje</a>   
    </div>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Genero</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Pais</th>
                    <th scope="col">Fecha de estreno</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                     if(is_dir(filename: 'datos')){
                        $archivos = scandir(directory: 'datos');

                        foreach ($archivos as $archivo) {
                            $ruta = 'datos/' . $archivo;
                            if (is_file(filename: $ruta)) {
                                    $json = file_get_contents(filename: $ruta);
                                    $obra = json_decode(json: $json);
                                    ?>
                                    <tr>
                                        <td><?= $obra->codigo; ?></td>
                                        <td><img src="<?= $obra->foto_url ?>" alt="<?= $obra->nombre ?>" height="100"></td>
                                        <td><?= $obra->tipo ?></td>
                                        <td><?= $obra->genero ?></td>
                                        <td><?= $obra->nombre ?></td>
                                        <td><?= $obra->descripcion ?></td>
                                        <td><?= $obra->pais ?></td>
                                        <td><?= $obra->fecha_estreno ?></td>
                                        <td><?= $obra->autor ?></td>

                                        <td>
                                            <a href="editar.php?codigo=<?php echo urlencode($obra->codigo); ?>" class="btn btn-warning">Editar</a>
                                            <a href="personaje.php?codigo=<?php echo urlencode($obra->codigo); ?>" class="btn btn-success">Agregar</a>
                                            <a href="detalle.php?codigo=<?php echo urlencode($obra->codigo); ?>" class="btn btn-danger">Detalles</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                ?>
                </tbody>
        </table>
   