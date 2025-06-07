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

        $pagina_actual = (defined('pagina_actual') ? pagina_actual : "inicio");
    
    ?>
    <!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Barbie</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!---Bootstrap 5-->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
             <!--Fuente de barbie de google form-->
            <link href="https://fonts.googleapis.com/css2?family=Barbie+New+Font:wght@400;700&display=swap" rel="stylesheet">
            <!-- Fuente alternativa para títulos -->
            <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
            <style>
        body {
            background: linear-gradient(135deg, #ffd6ec 0%, #ffe3f7 100%);
            min-height: 100vh;
        }
        .container {
            background: rgba(255,255,255,0.85);
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(253,13,181,0.15);
            padding: 30px 30px 10px 30px;
            margin-top: 30px;
        }
        h1, .navbar-brand {
            font-family: 'Pacifico', 'Barbie New Font', cursive;
            color: #fd0db5;
            font-size: 3rem;
            letter-spacing: 2px;
            text-shadow: 2px 2px 8px #fff0fa;
        }
        .divmenu .nav-tabs {
            border-bottom: 2px solid #fd0db5;
        }
        .nav-link {
            color: #fd0db5 !important;
            font-weight: bold;
            font-size: 1.2rem;
            background: transparent !important;
            border: none !important;
            transition: color 0.2s;
        }
        .nav-link.active, .nav-link:hover {
            color: #fff !important;
            background: linear-gradient(90deg, #fd0db5 60%, #ffb6e6 100%) !important;
            border-radius: 10px 10px 0 0 !important;
            box-shadow: 0 2px 8px #fd0db540;
        }
        label, .form-label, .card-title {
            color: #fd0db5;
            font-family: 'Barbie New Font', cursive;
        }
        .btn-primary, .btn {
            background: linear-gradient(90deg, #fd0db5 60%, #ffb6e6 100%);
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 20px;
            box-shadow: 0 2px 8px #fd0db540;
        }
        .btn-primary:hover, .btn:hover {
            background: linear-gradient(90deg, #ffb6e6 0%, #fd0db5 100%);
            color: #fff;
        }
        .footer {
            text-align: center;
            color: #fd0db5;
            font-family: 'Barbie New Font', cursive;
            background: transparent;
            margin-top: 40px;
        }
        .card {
            border: 2px solid #fd0db5;
            border-radius: 20px;
        }
        .card-title {
            font-size: 1.5rem;
        }
        .form-control, .form-select {
            border: 2px solid #fd0db5;
            border-radius: 10px;
        }

        </style>
        </head>
        <body>

        <div class="container">
            <div>
                <h1>Mundo Barbie</h1>
            </div>
            <div class="divmenu">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?= $pagina_actual == 'inicio'?'active':'';?> " href="<?= base_url() ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pagina_actual == 'personajes'?'active':'';?>" href="<?= base_url('modulos/personajes/lista_per.php'); ?>">Personajes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pagina_actual == 'profesiones'?'active':'';?>" href="<?= base_url('modulos/profesiones/lista.php'); ?>">Profesiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pagina_actual == 'estadisticas'?'active':'';?>" href="<?= base_url('modulos/reportes/menu.php'); ?>">Estadisticas</a>
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