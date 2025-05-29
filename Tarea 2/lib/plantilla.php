<?php

class plantilla{

    public static $instancia = null;

    public static function aplicar(): plantilla
    {
        if (self::$instancia === null) {
            self::$instancia = new plantilla();
        }
        return self::$instancia;
    }

    public function __construct(){
        ?>
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


    <div style="min-height: 500px">

<?php

    }

    public function __destruct()
    {
               ?>
 </div>

    <div class="text-center text-footer">
        <hr>
        <p>Todos los derechos reservados</p> &copy; 2025
    </div>
    </div>
</body>
</html>

<?php 
    }

}