<?php

require_once 'lib/main.php';

$id = $_GET['codigo'];
$cedula = $_GET['cedula'];

$obra = new obra();
$ruta = 'datos/' . $id . '.json';
if(!is_file(filename: $ruta)){
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error: No se encontró la obra con el código especificado.</div>";
    echo "<a href='index.php' class='btn btn-primary'>Volver al listado</a></div>";
    exit();
}

$json = file_get_contents(filename: $ruta);
$obra = json_decode(json: $json);

$personaje = null;

foreach ($obra->personajes as $p) {
    if ($p->cedula === $cedula) {
        $personaje = $p;
        break;
    }
}

if ($personaje === null) {
    plantilla::aplicar();
    echo "<div class='text-center'><div class='alert alert-danger'>Error: No se encontró el personaje con la cédula especificada.</div>";
    echo "<a href='personaje.php?codigo=$id' class='btn btn-primary'>Volver a los personajes</a></div>";
    exit();
}

$obra->personajes = array_filter(array: $obra->personajes, callback: function($p) use ($cedula) {
    return $p->cedula !== $cedula;
});

file_put_contents(filename: $ruta, data: json_encode(value: $obra));
plantilla::aplicar();

echo "<div class='text-center'><div class='alert alert-success'>Personaje eliminado exitosamente.</div>";
echo "<a href='personaje.php?codigo=$id' class='btn btn-primary'>Volver a los personajes</a></div>";
exit();
?>