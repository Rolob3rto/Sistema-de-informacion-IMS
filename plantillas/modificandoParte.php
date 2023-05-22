<?php

include 'comunes/db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // preparar la consulta
    $stmt = $mysqli->prepare("UPDATE partetrabajo 
        SET 
            cliente = ?,
            tipo = ?,
            fechaEntrada = ?,
            fechaSalida = ?,
            tecnico = ?,
            intervencion = ?,
            marca = ?,
            modelo = ?,
            numeroSerie = ?,
            estado = ?,
            horas = ?,
            notas = ?,
            descReparacion = ?,
            descAveria = ?,
            presupuesto = ?
        WHERE 
            idParteTrabajo = ?
    ");

    $presupuesto = isset($_POST["presupuesto"]) ? 1 : 0;
    // enlazar parámetros
    $stmt->bind_param("ssssssssssisssii",
        $_POST["cliente"],
        $_POST["tipo"],
        $_POST["fechaEntrada"],
        $_POST["fechaSalida"],
        $_POST["tecnico"],
        $_POST["intervencion"],
        $_POST["marca"],
        $_POST["modelo"],
        $_POST["numeroSerie"],
        $_POST["estado"],
        $_POST["horas"],
        $_POST["notas"],
        $_POST["descReparacion"],
        $_POST["descAveria"],
        $presupuesto,
        $_POST["idParteTrabajo"]
    );

    // ejecutar la consulta
    $stmt->execute();
    
    // cerrar la consulta
    $stmt->close();
}

/*echo mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";
echo date('Y-m-d H:i:s', strtotime($_POST["fechaEntrada"]));
echo $_POST["cliente"];
echo $_POST["tipo"];
echo $_POST["fechaEntrada"];
echo $_POST["tecnico"];
echo $_POST["intervencion"];
echo $_POST["marca"];
echo $_POST["modelo"];
echo $_POST["numeroSerie"];
echo $_POST["horas"];
echo $_POST["estado"];
echo $_POST["idParteTrabajo"]; */

// redirigir a la página de listado de partes de trabajo
$mysqli->close();
header("Location: listadoPartesDeTrabajo.php");

?>