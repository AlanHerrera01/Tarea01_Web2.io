<?php
function calcularFactorial($n) {
    return $n <= 1 ? 1 : $n * calcularFactorial($n - 1);
}

function esPrimo($n) {
    if ($n <= 1) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i === 0) return false;
    }
    return true;
}

function calcularSerieMatematica($terminos) {
    $resultado = 0;
    for ($i = 1; $i <= $terminos; $i++) {
        $numerador = $i ** 2;
        $denominador = calcularFactorial($i);
        $resultado += ($i % 2 === 0 ? -1 : 1) * ($numerador / $denominador);
    }
    return $resultado;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $opcion = $_POST['opcion'];
    $numero = $_POST['numero'];

    if (!is_numeric($numero) || $numero < 0 || $numero > 10) {
        $mensaje = "Por favor, ingrese un número entre 0 y 10.";
    } else {
        switch ($opcion) {
            case '1':
                $mensaje = "El factorial de $numero es " . calcularFactorial($numero);
                break;
            case '2':
                $mensaje = "El número $numero " . (esPrimo($numero) ? "es primo" : "no es primo");
                break;
            case '3':
                $mensaje = "El resultado de la serie matemática con $numero términos es " . calcularSerieMatematica($numero);
                break;
            default:
                $mensaje = "Opción inválida.";
        }
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 50px;">
        <h2>Ejercicio 1</h2>

        <!-- Icono casita -->
        <a href="../index.html" class="btn btn-default" style="margin-top: 10px;">
            <span class="glyphicon glyphicon-home"></span> Inicio
        </a>

        <form method="post">
            <div class="form-group">
                <label for="opcion">Seleccione una opción:</label>
                <select id="opcion" name="opcion" class="form-control">
                    <option value="1">Factorial</option>
                    <option value="2">Número Primo</option>
                    <option value="3">Serie Matemática</option>
                </select>
            </div>

            <div class="form-group">
                <label for="numero">Ingrese un número (0 - 10):</label>
                <input type="number" id="numero" name="numero" class="form-control" min="0" max="10" required>
            </div>

            <button type="submit" class="btn btn-success">Calcular</button>
        </form>

        <?php if (isset($mensaje)): ?>
            <div class="alert alert-info" style="margin-top: 20px;">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
