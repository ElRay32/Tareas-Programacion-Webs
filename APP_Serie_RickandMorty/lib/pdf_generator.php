<?php
// ① Autoload de Composer para Dompdf y demás librerías
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Genera y envía un PDF con el estilo de tu web.
 * @param array $p  Datos del personaje (nombre, color, tipo, nivel, foto)
 */
function generarPDF(array $p){
    // ② Opciones de Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Helvetica');

    $dompdf = new Dompdf($options);

    // ③ Carga tu CSS de la web
    $cssFile = __DIR__ . '/../assets/css/styles.css';
    $css = file_exists($cssFile)
         ? file_get_contents($cssFile)
         : '';

    // ④ Prepara la imagen del personaje en base64
    $imgPath = __DIR__ . '/../uploads/' . $p['foto'];
    $imgTag  = '';
    if (file_exists($imgPath)) {
        $mime   = mime_content_type($imgPath);
        $data   = base64_encode(file_get_contents($imgPath));
        $imgTag = "<img src=\"data:{$mime};base64,{$data}\" class=\"rm-img-pdf\" />";
    }

    // ⑤ Prepara el logo (incrústalo también en base64)
    $logoPath = __DIR__ . '/../assets/img/logo.png';
    $logoTag  = '';
    if (file_exists($logoPath)) {
        $mimeL   = mime_content_type($logoPath);
        $dataL   = base64_encode(file_get_contents($logoPath));
        $logoTag = "<img src=\"data:{$mimeL};base64,{$dataL}\" class=\"rm-logo-pdf\" />";
    }

    // ⑥ Construye el HTML completo con <style> y tu CSS
    $html = <<<HTML
<html>
  <head>
    <meta charset="utf-8">
    <style>
      /* Aquí va TODO tu CSS de la web */
      {$css}

      /* Ajustes especiales para PDF */
      .rm-img-pdf { width:120px; border-radius:8px; border:2px solid #C2FF00; margin-bottom:10px; }
      .rm-logo-pdf { height:40px; margin-right:10px; }
      .rm-main { padding:20px; }
      header { display:flex; align-items:center; margin-bottom:20px; }
    </style>
  </head>
  <body class="rm-background">
    <header>
      {$logoTag}
      <h2>Rick & Morty</h2>
    </header>
    <main class="rm-main">
      <h1 style="color:{$p['color']};">{$p['nombre']}</h1>
      {$imgTag}
      <p><strong>Tipo:</strong> {$p['tipo']}</p>
      <p><strong>Nivel:</strong> {$p['nivel']}</p>
    </main>
  </body>
</html>
HTML;

    // ⑦ Genera y envía el PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4','portrait');
    $dompdf->render();

    $fileName = preg_replace('/[^a-zA-Z0-9\-_]/','_', $p['nombre']) . '.pdf';
    $dompdf->stream($fileName, ['Attachment' => true]);
}
