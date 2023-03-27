<?php
    
    // Establecer las credenciales de conexión a la base de datos
    $host = 'localhost';
    $user = 'admin';
    $password = '1234';
    $database = 'sist_info';

    // Crear una instancia de la clase mysqli
    $mysqli = new mysqli($host, $user, $password, $database);

    // Verificar si se estableció correctamente la conexión
    if (!$mysqli) {
        die("Conexión fallida: " . mysqli_connect_error());
    } else {
        mysqli_set_charset($mysqli, 'utf8');
    }

?>