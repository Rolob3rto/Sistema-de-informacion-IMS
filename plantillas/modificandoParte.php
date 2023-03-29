<?php

include 'db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // preparar la consulta
    $stmt = $mysqli->prepare("UPDATE partetrabajo 
        SET 
            cliente = ?,
            tipo = ?,
            fechaEntrada = ?,
            tecnico = ?,
            intervencion = ?,
            marca = ?,
            modelo = ?,
            numeroSerie = ?,
            horas = ?,
            estado = ?
        WHERE 
            idParteTrabajo = ?
    ");

    // enlazar parámetros
    $stmt->bind_param("ssssssssssi",
        $_POST["cliente"],
        $_POST["tipo"],
        $_POST["fechaEntrada"],
        $_POST["tecnico"],
        $_POST["intervencion"],
        $_POST["marca"],
        $_POST["modelo"],
        $_POST["numeroSerie"],
        $_POST["horas"],
        $_POST["estado"],
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