<?php

include 'db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // preparar la consulta
    $stmt = $mysqli->prepare("UPDATE cliente
    SET      
      codigo = ?,
      nombre = ?,
      NIF = ?,
      direccion = ?,
      codigoPostal = ?,
      localizacion = ?,
      provincia = ?,
      email = ?,
      telefono1 = ?,
      datosBanco = ?,
      telefono2 = ?,
      nota = ?
    WHERE codigo = ?");

    // enlazar parámetros
    $stmt->bind_param("ssssisssssssi",
    $_POST['codigo'],
    $_POST["nombre"],
    $_POST["NIF"],
    $_POST["direccion"],
    $_POST["codigoPostal"],
    $_POST["localizacion"],
    $_POST["provincia"],
    $_POST["email"],
    $_POST["telefono1"],
    $_POST["datosBanco"],
    $_POST["telefono2"],
    $_POST["nota"],
    $_POST["codigoAntiguo"]
    );


    // ejecutar la consulta
    $stmt->execute();
    
    // cerrar la consulta
    $stmt->close();
}

// redirigir a la página de listado de partes de trabajo
/* echo mysqli_errno($mysqli) . ": " . mysqli_error($mysqli) . "\n";

echo $_POST["codigo"] . "\n";
echo $_POST["nombre"] . "\n";
echo $_POST["NIF"] . "\n";
echo $_POST["direccion"] . "\n";
echo $_POST["codigoPostal"] . "\n";
echo $_POST["localizacion"] . "\n";
echo $_POST["provincia"] . "\n";
echo $_POST["email"] . "\n";
echo $_POST["telefono1"] . "\n";
echo $_POST["datosBanco"] . "\n";
echo $_POST["telefono2"] . "\n";
echo $_POST["nota"] . "\n"; */
header("Location: listadoClientes.php");
$mysqli->close();
