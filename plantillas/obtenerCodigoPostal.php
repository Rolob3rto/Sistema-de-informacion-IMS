<?php
include 'db.php';

$provincia = $_POST['provincia'];

// se prepara la consulta SQL con una sentencia preparada para evitar la inyección de SQL
$stmt = $mysqli->prepare("SELECT codigoPostal FROM provincia WHERE provincia = ?");
$stmt->bind_param("s", $provincia);
$stmt->execute();

$resultado = $stmt->get_result();
$codigoPostal = $resultado->fetch_assoc()['codigoPostal'];

echo $codigoPostal;
?>
