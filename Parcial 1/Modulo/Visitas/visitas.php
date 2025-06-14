<?php

include_once '../../lib/main.php';
define("pagina_actual", "visitas");

if($_POST){
    $visitas = new visita($_POST);

    Dbx::save("visitas", $visitas);
    header("Location: " . base_url("modulo/Visitas/lista_visitas.php"));
    exit;
}

Plantilla::aplicar();

if(isset($_GET['codigo'])){
    $tmp = Dbx::get("visitas", $_GET['codigo']);
    if($tmp){
        $visita = $tmp;
    }
} else { 
    $visita = new Visita();
}

?>
<!--
 public $idx = '';
    public $cedula ='';
    public $nombre = '';
    public $apellido ='';
    public $edad = 0;
    public $motivo ='';
    public $fecha_visita = '';
-->

<h3>
    Registar Nueva Visita
</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    <div class="mb-3">
        <label class="form-lebel">Codigo</label>
        <input type="text" name="idx" class="form-control" value="<?= htmlspecialchars($visita->idx);?>" readonly>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Cedula</label>
        <input type="text" name="cedula" class="form-control" id="cedula" value="<?= htmlspecialchars($visita->cedula);?>" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" value="<?= htmlspecialchars($visita->nombre);?>" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Apellido</label>
        <input type="text" name="apellido" class="form-control" id="apellido" value="<?= htmlspecialchars($visita->apellido);?>" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Edad</label>
        <input type="text" name="edad" class="form-control" id="edad" value="<?= htmlspecialchars($visita->edad);?>" required>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Motivo</label>
        <select name="motivo" class="form-select" required>
            <option value="">Seleccione un motivo</option>
            <?php foreach (motivos::tipos_de_motivos() as $key => $label):
                $sel = ($visita->motivo === $key) ? ' Selected' : '';
            ?>
            <option value="<?= $key ?>"<?= $sel ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-lebel">Fecha y Hora de la Visita</label>
        <input type="datetime-local" name="fecha_visita" class="form-control" id="fecha_visita" value="<?= htmlspecialchars($visita->fecha_visita);?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Visita</button>
    <a href="<?= base_url("modulo/Visitas/lista_visitas.php");?>" class="btn btn-secondary">Cancelar</a>

</form>