<?php
require_once '../lib/db.php';
$db=getDB();$id=intval($_GET['id']);$p=$db->query("SELECT*FROM personajes WHERE id=$id")->fetch_assoc();
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=htmlspecialchars($p['nombre'])?></title><link rel="stylesheet" href="../assets/css/styles.css"></head><body class="rm-background">
  <header class="rm-header"><img src="../assets/img/logo.png" alt="Rick & Morty" class="rm-logo"><nav><a href="index.php">Inicio</a><a href="create.php">Agregar</a><a href="about.php">Acerca de</a></nav></header>
  <main class="rm-main">
    <h1><?=htmlspecialchars($p['nombre'])?></h1>
    <img src="../uploads/<?=htmlspecialchars($p['foto'])?>" width="200"><br><br>
    <p><strong>Color:</strong> <?=$p['color']?></p><p><strong>Tipo:</strong> <?=$p['tipo']?></p><p><strong>Nivel:</strong> <?=$p['nivel']?></p>
    <p><a href="pdf.php?id=<?=$p['id']?>">Descargar PDF</a></p>
    <p><a href="index.php" class="rm-button">Volver al inicio</a></p>
  </main>
</body></html>