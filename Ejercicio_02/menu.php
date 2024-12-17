<?php
// Función para generar la serie Fibonacci
function generarFibonacci($n) {
    $fibonacci = [1, 1];
    for ($i = 2; $i < $n; $i++) {
        $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }
    return array_slice($fibonacci, 0, $n);
}

// Función para calcular números cúbicos
function numerosCubo($max) {
    $resultado = [];
    for ($i = 1; $i <= $max; $i++) {
        $sumaCubos = array_sum(array_map(function ($digito) {
            return pow($digito, 3);
        }, str_split($i)));
        if ($sumaCubos == $i) {
            $resultado[] = $i;
        }
    }
    return $resultado;
}

// Función para evaluar la expresión fraccionaria
function calcularFraccionarios($a, $b, $c, $d) {
    return $a + ($b * $c) - $d;
}

// Variables para manejar las respuestas
$mensaje = '';
$opcion = isset($_POST['opcion']) ? $_POST['opcion'] : '';
$n = isset($_POST['numero']) ? (int)$_POST['numero'] : 0;
$max = isset($_POST['max']) ? (int)$_POST['max'] : 0;
$a = isset($_POST['a']) ? (float)$_POST['a'] : 0;
$b = isset($_POST['b']) ? (float)$_POST['b'] : 0;
$c = isset($_POST['c']) ? (float)$_POST['c'] : 0;
$d = isset($_POST['d']) ? (float)$_POST['d'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($opcion) {
        case '1': // Fibonacci
            if ($n >= 1 && $n <= 50) {
                $resultado = generarFibonacci($n);
                $mensaje = "Los primeros $n números de Fibonacci son:<br>" . implode(', ', $resultado);
            } else {
                $mensaje = "Por favor, ingresa un número entre 1 y 50.";
            }
            break;

        case '2': // Números cúbicos
            if ($max >= 1 && $max <= 1000000) {
                $resultado = numerosCubo($max);
                $mensaje = "Números cúbicos entre 1 y $max:<br>" . implode(', ', $resultado);
            } else {
                $mensaje = "Por favor, ingresa un número entre 1 y 1,000,000.";
            }
            break;

        case '3': // Fraccionarios
            $resultado = calcularFraccionarios($a, $b, $c, $d);
            $mensaje = "El resultado de la expresión A + B * C - D es: $resultado";
            break;

        default:
            $mensaje = "Por favor, selecciona una opción válida.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Menú</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script>
        function mostrarCampos() {
            var opcion = document.getElementById('opcion').value;
            document.getElementById('fibonacciInput').style.display = (opcion === '1') ? 'block' : 'none';
            document.getElementById('numerosCuboInput').style.display = (opcion === '2') ? 'block' : 'none';
            document.getElementById('fraccionariosInput').style.display = (opcion === '3') ? 'block' : 'none';
        }
    </script>
</head>
<body>
<div class="container">
    <h2 class="text-center">Ejercicio 2 - Menú</h2>

    <!-- Icono casita -->
    <a href="../index.html" class="btn btn-default" style="margin-top: 10px;">
        <span class="glyphicon glyphicon-home"></span> Inicio
    </a>

    <form method="POST" action="">
        <div class="form-group">
            <label for="opcion">Seleccione una opción:</label>
            <select name="opcion" id="opcion" class="form-control" onchange="mostrarCampos()">
                <option value="">-- Seleccione --</option>
                <option value="1">Serie Fibonacci</option>
                <option value="2">Números cúbicos</option>
                <option value="3">Fraccionarios</option>
            </select>
        </div>

        <!-- Entrada para Fibonacci -->
        <div class="form-group" id="fibonacciInput" style="display: none;">
            <label for="numero">Ingrese un número (1 - 50):</label>
            <input type="number" name="numero" id="numero" class="form-control" min="1" max="50">
        </div>

        <!-- Entrada para Números Cúbicos -->
        <div class="form-group" id="numerosCuboInput" style="display: none;">
            <label for="max">Ingrese un límite máximo (1 - 1,000,000):</label>
            <input type="number" name="max" id="max" class="form-control" min="1" max="1000000">
        </div>

        <!-- Entrada para Fraccionarios -->
        <div id="fraccionariosInput" style="display: none;">
            <label>Ingrese valores para la expresión A + B * C - D:</label>
            <div class="form-inline">
                <input type="number" name="a" placeholder="A" class="form-control" step="any">
                <input type="number" name="b" placeholder="B" class="form-control" step="any">
                <input type="number" name="c" placeholder="C" class="form-control" step="any">
                <input type="number" name="d" placeholder="D" class="form-control" step="any">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Calcular</button>
    </form>

    <br>
    <!-- Muestra resultados -->
    <?php if (!empty($mensaje)): ?>
        <div class="alert alert-info">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
