<?php
require_once '../lib/db.php';
$db = getDB();
$id = intval($_GET['id']);
$p = $db->query("SELECT foto FROM personajes WHERE id=$id")->fetch_assoc();
if ($p) unlink(__DIR__ . "/../uploads/" . $p['foto']);
$db->query("DELETE FROM personajes WHERE id=$id");
header('Location: index.php');
exit;
