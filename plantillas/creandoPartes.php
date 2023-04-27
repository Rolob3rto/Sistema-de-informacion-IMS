<?php

include 'db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // preparar la consulta
    $stmt = $mysqli->prepare("INSERT INTO partetrabajo (anio, numeroParte, cliente, tipo, fechaEntrada, fechaSalida, tecnico, intervencion, marca, modelo, numeroSerie, horas, descAveria, descReparacion, notas, estado) 
        SELECT YEAR(NOW()), IFNULL(MAX(numeroParte), 0) + 1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?
        FROM partetrabajo 
        WHERE anio = YEAR(NOW())");

    if (!$stmt) {
        die("Error de consulta preparada: " . $mysqli->error);
    }

    $cliente = $_POST['cliente'];
    $tipo = $_POST['tipo'];
    $fechaEntrada = date('Y-m-d H:i:s', strtotime($_POST["fechaEntrada"]));
    $fechaSalida = isset($_POST['date_time_input']) ? date('Y-m-d H:i:s', strtotime($_POST["fechaSalida"])) : null;
    $tecnico = $_POST['tecnico'];
    $intervencion = $_POST['intervencion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $numeroSerie = $_POST['numeroSerie'];
    $horas = $_POST['horas'];
    $descAveria = $_POST['descAveria'];
    $descReparacion = $_POST['descReparacion'];
    $notas = $_POST['notas'];
    $estado = $_POST['estado'];

    // enlazar parámetros
    $stmt->bind_param("sssssssssissss",
        $cliente,
        $tipo,
        $fechaEntrada,
        $fechaSalida,
        $tecnico,
        $intervencion,
        $marca,
        $modelo,
        $numeroSerie,
        $horas,
        $descAveria,
        $descReparacion,
        $notas,
        $estado,
    );

    // ejecutar la consulta
    $stmt->execute();
    
    // cerrar la consulta
    $stmt->close();
}

//echo mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
//echo date('Y-m-d H:i:s', strtotime($_POST["fechaEntrada"]));
/* echo $_POST["cliente"] . '<br>';
echo $_POST["tipo"] . '<br>';
echo $_POST["fechaEntrada"] . '<br>';
echo $_POST["tecnico"] . '<br>';
echo $_POST["intervencion"] . '<br>';
echo $_POST["marca"] . '<br>';
echo $_POST["modelo"] . '<br>';
echo $_POST["numeroSerie"] . '<br>';
echo $_POST["horas"] . '<br>';
echo $_POST["estado"] . '<br>'; */

// redirigir a la página de listado de partes de trabajo
$mysqli->close();
header("Location: listadoPartesDeTrabajo.php");

?>