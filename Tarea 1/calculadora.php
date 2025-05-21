<?php require_once 'Partes/head.php'; ?>

<style>
    .inputx{
        margin: 10px 0;
    }
    .inputx label{
        display: inline-block;
        width: 100px;
    }
    .inputx input{
        width: 200px;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
</style>

<form method="GET" action="calculadora_Resultado.php">
    <h2>Calculadora</h2>
    <div class="inputx">
        <label>
            Num1:
        </label><input required type="number" name="num1"/>
    </div>
    <div class="inputx">
        <label>
            Num2:
        </label><input required type="number" name="num2"/>
    </div>
    <div class="inputx">
        <select name="operacion" required>
            <option value="">Seleccione una operacion</option>
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select>
    </div>
    <div class="inputx">
        <button type="submit">Calcular</button>
    </div>


<?php require_once 'Partes/foot.php'; ?>