<?php
include_once '../../lib/main.php';
define("pagina_actual", "visitas");

if (isset($_GET['codigo'])){ 
    $codigo = $_GET['codigo'];
    $visita = Dbx::get("visitas", $codigo);

    if ($visita) {
        $datapath = DATA_DIR . "/visitas/{$codigo}.dat";
        if (file_exists($datapath)){
            unlink($datapath);
            header("Location: " . base_url("modulo/visitas/lista_visitas.php"));
            exit;
        } else {
            echo "Error: No se pudo encontar la visita para eliminar.";
        } 
    } else {
        echo "Error: Visita no encontrada.";
    }
} else { 
    echo "Error: Codigo de visita no proporcionado.";
    header("Location: " . base_url("modulo/visitas/lista_visitas.php"));
    exit;
}

plantilla::aplicar();
?>