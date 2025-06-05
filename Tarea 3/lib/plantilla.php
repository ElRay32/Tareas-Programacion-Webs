<?php

class Plantilla {

    static $instancia = null;
    public static function aplicar(){
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }

    
    function __construct() {
    
    ?>
        <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Barbie</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!---Bootstrap 5-->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
        </head>
        <body>

        <div class="container">
            <div>
                <h1>Mundo Barbie</h1>
            </div>
            <div class="divmenu">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="./">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="personaje.php">Personajes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profesiones.php">Profesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estadisticas.php">Estadisticas</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="contenido" style="min-height: 600px;">
             <?php
    }

   
    function __destruct() {
    ?>
                </div>
        <div class="footer">
            <hr>
            <p>© 2025 Mundo Barbie. Todos los derechos reservados.</p>
        </div>

        </div>
        </body>
    </html>
    <?php
    }
}

?>