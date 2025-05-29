<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitio Web de Peliculas y series que visto</title>
    <!-- Bootstrap CSS 5.3.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <h1 class="mt-3">Lo que visto con el tiempo</h1>
    <p>Listado de Peliculas y Series que son las mejores Peliculas</p>
    </div>
    <div class="text-end">
        <a href="agregar_personaje.php" class="btn btn-primary">Agregar Personaje</a>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Imagen</th>
                    <th>Tipo</th>
                    <th>Genero</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Pais</th>
                    <th>Fecha de estreno</th>
                    <th>Autor</th>
                    <th>Acciones</th>
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
    </div>
</body>
</html>
