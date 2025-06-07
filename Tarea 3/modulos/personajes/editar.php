<?php

include_once '../../lib/main.php';
define("pagina_actual", "personajes");


if($_POST){
    $personaje = new personaje($_POST);
    
    Dbx::save("personajes",$personaje);
    header("Location: " . base_url("modulos/personajes/lista_per.php"));
    exit;
}

plantilla::aplicar();

if(isset($_GET['codigo'])){
    $tmp = Dbx::get("personajes", $_GET['codigo']);
    if($tmp){
        $personaje = $tmp;
    }
} else {
    $personaje = new Personaje();
}
?>
<h3>Editar Personaje</h3>
<!--
    public $idx = '';
    public $identificacion = '';
    public $nombre;
    public $apellido;
    public $fecha_nacimiento;
    public $foto;
    public $profesion;
    public $nivel_experiencia;
    -->


<form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    <div class="mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" class="form-control" id="idx" name="idx" value="<?= htmlspecialchars($personaje->idx); ?>" readonly>
    </div>

    <div class="mb-3">
        <label for="identificacion" class="form-label">Identificación</label>
        <input type="text" class="form-control" id="identificacion" name="identificacion" value="<?= htmlspecialchars($personaje->identificacion); ?>" required>
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($personaje->nombre); ?>" required>
    </div>

    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($personaje->apellido); ?>" required>
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($personaje->fecha_nacimiento); ?>" required>
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto del Personaje</label>
        <input type="text" class="form-control" id="foto" name="foto" value="<?= htmlspecialchars($personaje->foto); ?>" required>
    </div>

    <div class="mb-3">
        <label for="profesion" class="form-label">Profesión</label>
        <select class="form-select" id="profesion" name="profesion" required>
            <option value="" disabled selected>Seleccione una profesión</option>
            <?php
            $profesiones = Dbx::list("profesiones");
            foreach ($profesiones as $prof): ?>
            <option value="<?= htmlspecialchars($prof->idx); ?>" <?= $personaje->profesion == $prof->idx ? 'selected' : ''; ?>>
                <?= htmlspecialchars($prof->nombre); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="nivel_experiencia" class="form-label">Nivel de Experiencia</label>
        <input type="number" class="form-control" id="nivel_experiencia" name="nivel_experiencia" value="<?= htmlspecialchars($personaje->nivel_experiencia); ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="<?= base_url("modulos/personajes/lista_per.php"); ?>" class="btn btn-secondary">Cancelar</a>
</form>


