<?php
include 'comunes/db.php';

$provincia = $_POST['provincia'];

// se prepara la consulta SQL con una sentencia preparada para evitar la inyección de SQL
$stmt = $mysqli->prepare("SELECT codigoPostal FROM provincia WHERE provincia = ?");
$stmt->bind_param("s", $provincia);
$stmt->execute();

$resultado = $stmt->get_result();
$codigoPostal = '';
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $codigoPostal = $fila['codigoPostal'];
}

echo $codigoPostal;
?>
