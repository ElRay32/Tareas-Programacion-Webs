<?php

// Raymel Enrique Guerrero Reynoso 2023-1677

class Plantilla {

    static $instancia = null;
    public static function aplicar(){
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
        return self::$instancia;
    }


    function __construct()
    {
        $pagina_actual = (defined('pagina_actual') ? pagina_actual : "inicio");


        ?>

        <!DOCTYPE html>
        <html lang="es">
            <head>
                <meta charset="UFT-8">
                <title>Doctor Elimina Caries</title>
                <meta name="viewport" content="width=device=width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            </head>
            <body>
                <div class="container">
                    <div>
                        <h1>Doctor Elimina Caries</h1>
                    </div>
                    <div class="divmenu">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" <?= $pagina_actual == 'inicio'?'active':'';?> href="<?= base_url() ?>">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" <?= $pagina_actual == 'visitas'?'active':'';?> href="<?= base_url() ?>">Listado de Visitas</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <div class="contenido" style="min-height: 600px;">
            <?php
        }
    
    function __destruct(){
        ?>
            </div>
            <div class="footer">
                <hr>
                <p>
                    Creado por Ray. Todos los derechos reservados.
                </p>
            </div>
            </body>
        </html>
        <?php

    }
}


?>
