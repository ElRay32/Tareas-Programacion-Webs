<?php
require_once '../lib/db.php';
$db  = getDB();
$res = $db->query("SELECT * FROM personajes ORDER BY nivel DESC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Rick & Morty – Personajes</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body class="rm-background">
  <header class="rm-header">
    <img src="../assets/img/logo.png" alt="Rick & Morty" class="rm-logo">
    <nav>
      <a href="index.php">Inicio</a>
      <a href="create.php">Agregar</a>
      <a href="about.php">Acerca de</a>
    </nav>
  </header>
  <main class="rm-main">
    <h1>Lista de Personajes</h1>
    <table class="rm-table">
      <tr><th>Foto</th><th>Nombre</th><th>Tipo</th><th>Nivel</th><th>Acciones</th></tr>
      <?php while($p = $res->fetch_assoc()): ?>
      <tr>
        <td><img src="../uploads/<?=htmlspecialchars($p['foto'])?>" width="60"></td>
        <td><?=htmlspecialchars($p['nombre'])?></td>
        <td><?=htmlspecialchars($p['tipo'])?></td>
        <td><?=$p['nivel']?></td>
        <td class="rm-actions">
          <a href="view.php?id=<?=$p['id']?>">Ver</a>
          <a href="edit.php?id=<?=$p['id']?>">Editar</a>
          <a href="delete.php?id=<?=$p['id']?>" onclick="return confirm('¿Borrar <?=$p['nombre']?>?')">Borrar</a>
          <a href="pdf.php?id=<?=$p['id']?>">PDF</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </main>
</body>
</html>
