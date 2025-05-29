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
                <td>1</td>
                <td><img src="https://via.placeholder.com/100" alt="Imagen de la pelicula"></td>
                <td>Película</td>
                <td>Acción</td>
                <td>Avengers: Endgame</td>
                <td>Los Vengadores deben enfrentarse a Thanos una vez más.</td>
                <td>Estados Unidos</td>
                <td>26 de abril de 2019</td>
                <td>Anthony y Joe Russo</td>
                <td>
                    <a href="editar.php?id=1" class="btn btn-warning">Editar</a>
                    <a href="detalle.php?id=1" class="btn btn-danger">Detalles</a>
            </tbody>
   