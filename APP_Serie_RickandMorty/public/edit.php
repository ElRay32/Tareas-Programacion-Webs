<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../lib/db.php';
$db=getDB();$id=intval($_GET['id']);$p=$db->query("SELECT*FROM personajes WHERE id=$id")->fetch_assoc();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $n=$_POST['nombre'];$c=$_POST['color'];$t=$_POST['tipo'];$l=intval($_POST['nivel']);
    if(!empty($_FILES['foto']['name'])){ $fn=time().'_'.basename($_FILES['foto']['name']);move_uploaded_file($_FILES['foto']['tmp_name'],"../uploads/$fn"); }
    else{ $fn=$p['foto']; }
    $stmt=$db->prepare("UPDATE personajes SET nombre=?,color=?,tipo=?,nivel=?,foto=? WHERE id=?");
    $stmt->bind_param('sssisi',$n,$c,$t,$l,$fn,$id);$stmt->execute();header('Location:index.php');exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Editar <?=htmlspecialchars($p['nombre'])?></title><link rel="stylesheet" href="../assets/css/styles.css"></head><body class="rm-background">
  <header class="rm-header"><img src="../assets/img/logo.png" alt="Rick & Morty" class="rm-logo"><nav><a href="index.php">Inicio</a><a href="create.php">Agregar</a><a href="about.php">Acerca de</a></nav></header>
  <main class="rm-main">
    <h1>Editar <?=htmlspecialchars($p['nombre'])?></h1>
    <form method="post" enctype="multipart/form-data">
      <label>Nombre: <input name="nombre" value="<?=htmlspecialchars($p['nombre'])?>" required></label><br>
      <label>Color: <input name="color" value="<?=htmlspecialchars($p['color'])?>" required></label><br>
      <label>Tipo:  <input name="tipo" value="<?=htmlspecialchars($p['tipo'])?>" required></label><br>
      <label>Nivel: <input name="nivel" type="number" min="1" value="<?=$p['nivel']?>" required></label><br>
      <label>Foto nueva: <input name="foto" type="file" accept="image/*"></label><br>
      <button>Actualizar</button>
    </form>
    <p><a href="index.php" class="rm-button">Volver al inicio</a></p>
  </main>
</body></html>