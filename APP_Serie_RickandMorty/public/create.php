<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once '../lib/db.php';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $n    = $_POST['nombre'];
    $c    = $_POST['color'];
    $t    = $_POST['tipo'];
    $l    = intval($_POST['nivel']);
    $foto = $_FILES['foto'];
    $fn   = time().'_'.basename($foto['name']);
    move_uploaded_file($foto['tmp_name'], "../uploads/$fn");
    $db   = getDB();
    $stmt = $db->prepare("INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssis', $n, $c, $t, $l, $fn);
    $stmt->execute();
    header('Location: index.php');
    exit;
}
?>
<!doctype html><html><head>
  <meta charset="utf-8"><title>Agregar Personaje</title>
  <link rel="stylesheet" href="../assets/css/styles.css">
</head><body class="rm-background">
  <header class="rm-header">
    <img src="../assets/img/logo.png" alt="Rick & Morty" class="rm-logo">
    <nav><a href="index.php">Inicio</a><a href="create.php">Agregar</a><a href="about.php">Acerca de</a></nav>
  </header>
  <main class="rm-main">
    <h1>Agregar Personaje</h1>
    <form method="post" enctype="multipart/form-data">
      <label>Nombre: <input name="nombre" required></label><br>
      <label>Color: <input name="color" required></label><br>
      <label>Tipo: <input name="tipo" required></label><br>
      <label>Nivel: <input name="nivel" type="number" min="1" required></label><br>
      <label>Foto: <input name="foto" type="file" accept="image/*" required></label><br>
      <button type="submit">Guardar</button>
    </form>
    <p><a href="index.php" class="rm-button">Volver al inicio</a></p>
  </main>
</body></html>