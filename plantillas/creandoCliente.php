<?php

include 'comunes/db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // preparar la consulta
    $stmt = $mysqli->prepare("INSERT INTO cliente
    (codigo,
    nombre,
    NIF,
    direccion,
    codigoPostal,
    localizacion,
    provincia,
    email,
    telefono1,
    datosBanco,
    telefono2,
    nota)
    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $nif = $_POST["NIF"];
    $direccion = $_POST["direccion"];
    $codigoPostal = $_POST["codigoPostal"];
    $localizacion = $_POST["localizacion"];
    $provincia = $_POST["provincia"];
    $email = $_POST["email"];
    $telefono1 = $_POST["telefono1"];
    $datosBanco = $_POST["datosBanco"];
    $telefono2 = $_POST["telefono2"];
    $nota = $_POST["nota"];

    $stmt->bind_param("isssisssssss", $codigo, $nombre, $nif, $direccion, $codigoPostal, $localizacion, $provincia, $email, $telefono1, $datosBanco, $telefono2, $nota);
}

//echo mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";

// ejecutar la consulta
$stmt->execute();

// cerrar la conexión y la consulta
$stmt->close();

// redirigir a la página de listado de partes de trabajo
$mysqli->close();
header("Location: listadoClientes.php");

?>