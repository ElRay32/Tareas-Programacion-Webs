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
                <style>
                    body {
                    background-color: #f8f9fa;
                }
                .container {
                    max-width: 1200px;
                    margin: 0 auto;
                    padding: 20px;
                }
                h1, .navbar-brand {
                    font-family: 'Arial', sans-serif;
                    color: #343a40;
                    font-size: 2.5rem;
                    letter-spacing: 1px;
                }
                .nav-link {
                    color: #343a40 !important;
                    font-weight: bold;
                    font-size: 1.1rem;
                    transition: color 0.2s;
                }
                .nav-link:hover {
                    color: #007bff !important;
                }
                .nav-tabs {
                    border-bottom: 2px solid #007bff;
                }
                .nav-item {
                    margin-right: 15px;
                }
                .nav-item.active .nav-link {
                    color: #007bff !important;
                    border-bottom: 2px solid #007bff;
                }
                .nav-item.active .nav-link:hover {
                    color: #0056b3 !important;
                }
                .nav-tabs .nav-link {
                    border: none;
                    background: transparent;
                }
                .nav-tabs .nav-link.active {
                    border-bottom: 2px solid #007bff;
                }
                .nav-tabs .nav-link:hover {
                    border-bottom: 2px solid #0056b3;
                }
                .nav-tabs .nav-link:focus {
                    box-shadow: none;
                }
                .nav-tabs .nav-link {
                    border-radius: 0;
                }
                .nav-tabs .nav-link.active {
                    background-color: #e9ecef;
                    color: #007bff !important;
                }
                .nav-tabs .nav-link.active:hover {
                    background-color: #e2e6ea;
                    color: #0056b3 !important;
                }
                .divmenu {
                    margin-bottom: 20px;
                }
                .divmenu .nav-tabs {
                    margin-bottom: 20px;
                }
                .divmenu .nav-tabs .nav-item {
                    margin-right: 10px;
                }
                .contenido {
                    padding: 20px;
                    background-color: #ffffff;
                    border-radius: 5px;
                }
                .contenido h2 {
                    font-family: 'Arial', sans-serif;
                    color: #343a40;
                    margin-bottom: 20px;
                }
                .contenido p {
                    font-family: 'Arial', sans-serif;
                    color: #6c757d;
                    line-height: 1.6;
                }
                .contenido ul {
                    list-style-type: disc;
                    padding-left: 20px;
                }
                .contenido a:active {
                    color: #0056b3;
                }
                .contenido img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 5px;
                }            
                .contenido table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                .contenido table th, .contenido table td {
                    border: 1px solid #dee2e6;
                    padding: 10px;
                    text-align: left;
                }
                .contenido table th {
                    background-color: #f8f9fa;
                    color: #343a40;
                }
                .footer {
                    text-align: center;
                    padding: 10px 0;
                    background-color: #343a40;
                    color: white;
                }
                </style>
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
                                <a class="nav-link" <?= $pagina_actual == 'visitas'?'active':'';?> href="<?= base_url("modulo/visitas/lista_visitas.php") ?>">Listado de Visitas</a>
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
