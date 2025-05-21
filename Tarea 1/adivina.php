<?php require_once 'Partes/head.php'; ?>

<h3>Juego de Adivinanza</h3>
<p>Adivina el numero del 1 a 5</p>

<form method="get" action="">
<input type = "number" name="numeroa" required id="numero" min="1" max="5" placeholder="Introduce un número del 1 al 5"
value="<?= isset($_GET['numeroa']) ? $_GET['numeroa']: ''; ?>" />
<button type="submit">Enviar</button>
</form>

<?php
if (isset($_GET['numeroa'])) {
    $numero = $_GET['numeroa'];
    $aleatorio = rand(1, 5);
    if ($numero == $aleatorio) {
        echo "<p>¡Felicidades! Adivinaste el número: $aleatorio</p>";
    } else {
        echo "<p>Lo siento, el número era: $aleatorio</p>";
    }
}
?>


<?php require_once 'Partes/foot.php'; ?>