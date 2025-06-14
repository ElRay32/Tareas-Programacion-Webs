<?php

include_once 'plantilla.php';
include_once 'modelo.php';
include_once 'Dbx.php';

function base_url($path = ''){

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

    $host = $_SERVER['HTTP_HOST'];

    $path = trim($path, '/');

    return $protocol . $host . '/' . $path;
}

?>