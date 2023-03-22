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
    }

    $sql = "SELECT cliente.nombre, partetrabajo.* FROM `partetrabajo` INNER JOIN cliente ON cliente.codigo = partetrabajo.cliente";
    $resultado = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de partes de trabajo</title>

    <link rel="stylesheet" href="css/generico.css">
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1 class="h1 text-center text-primary">SISTEMA DE INFORMACIÓN</h1>
    <div class="container">
    <div class="table-responsive container">
    <table class="table table-primary">       
    <?php 
    
    //listado de clientes para prueba
    if (mysqli_num_rows($resultado) > 0) {
       echo "<tr class='text-center'>";
       echo "<th>Nombre</th>";
       echo "<th>Dirección</th>";
       echo "<th>Codigo postal</th>";
       echo "<th>Localizacion</th>";
       echo "<th>Provincia</th>";
       echo "<th>E-mail</th>";
       echo "<th>Telefono 1</th>";
       echo "<th>Telefono 2</th>";
       echo "<th>Datos del Banco</th>";
       echo "<th>Nota</th>";
       echo "</tr>";
    while($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr class="text-center">';
        echo '<td>' . $fila["nombre"] . '</td>';
        echo "<td>" . $fila["direccion"]. '</td>';
        echo "<td>" . $fila["codigoPostal"] . "</td>";
        echo "<td>" . $fila["localizacion"] . "</td>";
        echo "<td>" . $fila["provincia"] . "</td>";
        echo "<td>" . $fila["email"] . "</td>";
        echo "<td>" . $fila["telefono1"] . "</td>";
        echo "<td>" . $fila["telefono2"] . "</td>";
        echo "<td>" . $fila["datosBanco"] . "</td>";
        echo "<td>" . $fila["nota"] . "</td>";
        echo '</tr>';
    }
    } else {
        echo "<tr><td>0 resultados</td></tr>";
    }
    ?>    
    </table>
        <a class="btn btn-dark" href="index.php">Volver</a>
    </div>
    </div>
</body>
</html>
<?php  mysqli_close($mysqli); ?>