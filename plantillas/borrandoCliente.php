<?php

include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $stmt = $mysqli->prepare("DELETE FROM cliente
    WHERE codigo = ?;
    ");
    
    $stmt->bind_param("i", $_POST["codigo"]);
    
    $stmt->execute();
    
    $stmt->close();
}

$mysqli->close();
header("Location: listadoClientes.php");

?>