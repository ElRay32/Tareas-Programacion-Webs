<?php
require_once __DIR__ . '/../lib/db.php';
require_once __DIR__ . '/../lib/pdf_generator.php';

$db = getDB();
$id = intval($_GET['id'] ?? 0);
$p  = $db->query("SELECT * FROM personajes WHERE id=$id")->fetch_assoc();
if (!$p) { die('Personaje no encontrado'); }

generarPDF($p);
