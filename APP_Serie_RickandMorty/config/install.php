<?php
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $h = $_POST['host'];
    $u = $_POST['user'];
    $p = $_POST['pass'];
    $n = $_POST['dbname'];

    $mysqli = new mysqli($h, $u, $p);
    if ($mysqli->connect_errno) {
        $error = "Error de conexión: " . $mysqli->connect_error;
    } else {
        $mysqli->query("CREATE DATABASE IF NOT EXISTS `$n` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $mysqli->select_db($n);
        $sql = "CREATE TABLE IF NOT EXISTS personajes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            color VARCHAR(50) NOT NULL,
            tipo VARCHAR(50) NOT NULL,
            nivel INT NOT NULL,
            foto VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $mysqli->query($sql);

        $cfg = "<?php
"
             . "define('DB_HOST', '$h');
"
             . "define('DB_USER', '$u');
"
             . "define('DB_PASS', '$p');
"
             . "define('DB_NAME', '$n');
";
        file_put_contents(__DIR__.'/db_config.php', $cfg);

        header('Location: ../public/index.php');
        exit;
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Instalación</title></head>
<body>
<h1>Asistente de Instalación</h1>
<?php if(!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
  Host: <input name="host" value="localhost"><br>
  Usuario: <input name="user" value="root"><br>
  Contraseña: <input name="pass" type="password"><br>
  Nombre BD: <input name="dbname" value="serie_db"><br>
  <button>Instalar y configurar</button>
</form>
</body></html>
