<?php $nombre = "Raymel"; $apellido = "Guerrero"; $edad = 22; $carrera = "Desarrollo de Software"; $universidad = "Itla";

$mensaje = ($edad >= 18) ? "Eres mayor de edad." : "Eres menor de edad.";


require_once 'Partes/head.php'; ?>

<table border ="1"> 
    <tr>
        <td>Nombre:</td>
        <td><?php echo $nombre; ?></td>
    </tr>
    <tr>
        <td>Apellido:</td>
        <td><?php echo $apellido; ?></td>
    </tr>
    <tr>
        <td>Edad:</td>
        <td><?php echo $edad; ?></td>
    </tr>
    <tr>
        <td>Carrera:</td>
        <td><?php echo $carrera; ?></td>
    </tr>
    <tr>
        <td>Universidad:</td>
        <td><?php echo $universidad; ?></td>
    </tr>
</table>

<h3><?= $mensaje; ?></h3>

<p><a href="index.php">Volver a la página principal</a></p>

<?php require_once 'Partes/foot.php'; ?>