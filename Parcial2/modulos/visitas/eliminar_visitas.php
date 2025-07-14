<?php
require_once '../../lib/db.php';

$db = getDB();
$id = intval($_GET['id']);

$db->query("DELETE FROM personas WHERE id=$id");
header('Location: lista_visitas.php');
exit;

?>