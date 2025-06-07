<?php

include_once '../../lib/main.php';
define("pagina_actual", "estadisticas");


$personajes = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");
$edad_total = 0;
$excom = 0;
$salpromedio = 0;
$personaje_salario_mas_alto = null;
$salario_mas_alto = -1;

// data para el grafico
$salarios_graph = [];

// para los mayor y menor salario
$mayor_salario = null;
$menor_salario = null;

$personasXprofesion = [];
foreach ($profesiones as $profesion) {

    $salarios_graph[$profesion->nombre] = $profesion->salario;


    if ($mayor_salario === null || $profesion->salario > $mayor_salario->salario) {
        $mayor_salario = $profesion;
    }

    if ($menor_salario === null || $profesion->salario < $menor_salario->salario) {
        $menor_salario = $profesion;
    }


    if (!isset($personasXprofesion[$profesion->idx])) {
        $personasXprofesion[$profesion->idx] = [
            'nombre'=> $profesion->nombre,
            'cantidad' => 0,
        ];
    }
}


foreach ($personajes as $personaje) {
    $edad_total += $personaje->edad();
    $excom += $personaje->nivel_experiencia;

    if(isset($personasXprofesion[$personaje->profesion])) {
        $personasXprofesion[$personaje->profesion]['cantidad']++;
    } 

    if (count($profesiones) > 0) {
    $total_salario = 0;
    foreach ($profesiones as $profesion) {
        $total_salario += $profesion->salario;
    }
    $salpromedio = $total_salario / count($profesiones);
}
foreach ($profesiones as $profesion) {
        if ($profesion->idx == $personaje->profesion) {
            if ($profesion->salario > $salario_mas_alto) {
                $salario_mas_alto = $profesion->salario;
                $personaje_salario_mas_alto = [
                    'nombre' => $personaje->nombre,
                    'apellido' => $personaje->apellido,
                    'profesion' => $profesion->nombre,
                    'salario' => $profesion->salario
                ];
            }
            break;
        }
    }
}

$eprom = $edad_total / count($personajes);
$excom = $excom / count($personajes);


$data = [
    'personajes' => count($personajes),
    'profesiones' => count($profesiones),
    'edad_promedio' => $eprom,
    'distribucion_categorias' => [],
    'nivel_experiencia_comun' => $excom,
    'salario_promedio' => $salpromedio
];


plantilla::aplicar();

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="container py-5">
    <h1 class="text-center mb-4">🌟 Estadísticas del Mundo Barbie</h1>

    <div class="row g-4">

      <!-- Cantidad de personajes -->
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title">👥 Personajes Registrados</h5>
            <p class="display-5 fw-bold text-primary"><?= $data['personajes'];?></p>
          </div>
        </div>
      </div>

      <!-- Cantidad de profesiones -->
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title">🛠️ Profesiones Registradas</h5>
            <p class="display-5 fw-bold text-success"><?= $data['profesiones'];?></p>
          </div>
        </div>
      </div>

      <!-- Edad promedio -->
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body text-center">
            <h5 class="card-title">🎂 Edad Promedio</h5>
            <p class="display-5 fw-bold text-danger"><?= number_format($data['edad_promedio'], 0); ?> años</p>
          </div>
        </div>
      </div>

      <!-- Distribución por categoría -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">📊 Distribución por Categoría</h5>
            <ul class="list-group">
                <?php
                foreach ($personasXprofesion as $idx => $fila) {
                    echo "<li class='list-group-item'>{$fila['nombre']}: {$fila['cantidad']} personajes</li>";
                }
                ?>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Nivel de experiencia más común -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">🏅 Nivel de Experiencia Más Común</h5>
            <p class="fs-4">
              <?= number_format($data['nivel_experiencia_comun'], 2) ?>
          </div>
        </div>
      </div>

      <!-- Profesión con salario más alto y bajo -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">💰 Profesiones por Salario</h5>
            <p><strong>Más alto:</strong><?= $mayor_salario ?></p>
            <p><strong>Más bajo:</strong><?= $menor_salario ?></p>
          </div>
        </div>
      </div>

      <!-- Salario promedio -->
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">📈 Salario Promedio</h5>
            <p class="fs-3 text-success"><?= number_format($data['salario_promedio'], 0); ?></p>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Personaje con salario más alto -->
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">👑 Personaje con el Salario Más Alto</h5>
            <p class="mb-0"><?php if ($personaje_salario_mas_alto): ?>
    <p class="mb-0">
        <?= htmlspecialchars($personaje_salario_mas_alto['nombre'] . ' ' . $personaje_salario_mas_alto['apellido']) ?>
        (<?= htmlspecialchars($personaje_salario_mas_alto['profesion']) ?>)
        - $<?= number_format($personaje_salario_mas_alto['salario'], 0) ?>
    </p>
<?php else: ?>
    <p class="mb-0">No hay personajes registrados.</p>
<?php endif; ?></p>
          </div>
        </div>
      </div>

      <!-- Gráfico Chart.js -->
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">📊 Distribución de Salarios por Categoría</h5>
            <canvas id="salaryChart" height="120"></canvas>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php
    $labels = array_keys($salarios_graph);
    $data = array_values($salarios_graph);
?>

  <script>
    const ctx = document.getElementById('salaryChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
          label: 'Salario Promedio ($)',
          data: <?= json_encode($data) ?>,
          backgroundColor: ['#4e79a7', '#f28e2c', '#e15759', '#76b7b2', '#59a14f']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'USD'
            }
          }
        }
      }
    });
  </script>