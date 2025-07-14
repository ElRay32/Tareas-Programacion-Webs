<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require_once '../../lib/db.php';

$db=getDB();

$id=intval($_GET['id']);$p=$db->query("SELECT*FROM personas WHERE id=$id")->fetch_assoc();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $n=$_POST['nombre'];
    $l=$_POST['apellido'];
    $q=$_POST['cedula'];
    $c=$_POST['telefono'];
    $t=$_POST['correo'];

    $stmt=$db->prepare("UPDATE personas SET nombre=?, apellido=?, cedula=?, telefono=?, correo=? WHERE id=?");
    $stmt->bind_param('sssisi',$n,$l,$q,$c,$t,$id);
    $stmt->execute();header('Location:lista_visitas.php');
    exit;
}
?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?=htmlspecialchars($p['nombre'])?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  </head>

  <main class="rm-main">
    <h1>Editar <?=htmlspecialchars($p['nombre'])?></h1>
    <form method="post" enctype="multipart/form-data">

      <div class="mb-3">
      <label class="form-lebel">Nombre: 
      <input type="text" name="nombre" class="form-control" id="nombre" value="<?=htmlspecialchars($p['nombre'])?>" required></label><br>
      </div>
      
      <div class="mb-3">
      <label class="form-lebel">Apellido:
      <input type="text" name="apellido" class="form-control" id="apellido" value="<?=htmlspecialchars($p['apellido'])?>" required></label><br>
      </div>

      <div class="mb-3">
      <label class="form-lebel">Cedula:
      <input type="text" name="cedula" class="form-control" id="cedula" value="<?=htmlspecialchars($p['cedula'])?>" required></label><br>
      </div>

      <div class="mb-3">
      <label class="form-lebel">Telefono:
      <input type="text" name="telefono" class="form-control" id="telefono" value="<?=htmlspecialchars($p['telefono'])?>" required></label><br>
      </div>

      <div class="mb-3">
      <label class="form-lebel">Correo:
      <input type="email" name="correo" class="form-control" id="correo" value="<?=htmlspecialchars($p['correo'])?>" required></label><br>
      </div>

      <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
    <p><a href="lista_visitas.php" class="btn btn-secondary">Cancelar</a></p>
  </main>
