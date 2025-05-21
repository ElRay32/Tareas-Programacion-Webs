<!DOCTYPE html>
<html>
    <head>
        <title>Programacion Webs: Tarea 1</title>
        <style>
            
            body{
                font-family: arial, sans-serif;
                background-color: rgb(46, 103, 64);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin: 0;
                padding: 0;
            }
            #tarea1{
                width: auto;
                max-width: 1000px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            #idmenu{
               margin: 20px 0;
               background: black;
               padding: 2px;
               border-radius: 5px;
               color: white;
               text-align: center;

            }

            #idmenu ul{
                list-style-type: none;
                padding: 0;
            }

            #idmenu li{
                display: inline;
                margin-right: 20px;
            }

            #idmenu a{
                text-decoration: none;
                color: whitesmoke;
                font-weight: bold;
            }

            #idmenu a:hover{
                text-decoration: underline;
                color:rgb(199, 199, 199);
            }

            #idcontenido{
                min-height: 200px;

            }
            
        </style>
    </head>
    <body>
        <div id="tarea1">

        <div>
            <h1>Tarea 1</h1>
            <p>Desarrollado habilidades</p>
        </div>

        <div id="idmenu">
            <ul>
                <li>
                    <a href="mi_tarjeta.php">Mi Tarjeta</a>
                </li>
                <li>
                    <a href="calculadora.php">Calculadora</a>
                </li>
                <li>
                    <a href="adivina.php">Adivina</a>
                </li>
                <li>
                    <a href="acerca_de.php">Acerca de Mi</a>
                </li>
            </ul>
        </div>
        <div id="idcontenido">