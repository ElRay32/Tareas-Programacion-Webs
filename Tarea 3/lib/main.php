<?php
include_once 'plantilla.php';
include_once 'modelo.php';
include_once 'Dbx.php';

function base_url($path = '') {
    
    // Protocol

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

    //host
    $host = $_SERVER['HTTP_HOST'];

    // Path
    $path = trim($path, '/');

    // Return the full URL
    return $protocol . $host . '/' . $path;
}

?>