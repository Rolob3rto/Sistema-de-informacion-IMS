<?php

include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $stmt = $mysqli->prepare("DELETE FROM partetrabajo WHERE (idParteTrabajo = ?)");
    
    $stmt->bind_param("i", $_POST["idParteTrabajo"]);
    
    $stmt->execute();
    
    $stmt->close();
}
//DELETE FROM 'sist_info'.'partetrabajo' WHERE ('idParteTrabajo' = '7');

$mysqli->close();
header("Location: listadoPartesDeTrabajo.php");

?>