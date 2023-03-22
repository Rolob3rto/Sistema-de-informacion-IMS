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

    $sql = "SELECT cliente.nombre AS clienteNombre, partetrabajo.* FROM `partetrabajo` INNER JOIN cliente ON cliente.codigo = partetrabajo.cliente";
    $resultado = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de partes de trabajo</title>

    <link rel="stylesheet" href="../css/generico.css">
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1 class="h1 text-center text-primary">SISTEMA DE INFORMACIÓN</h1>
    <div class="table-responsive">
    <table class="table table-primary">
    <?php 
    
    //listado de clientes para prueba
    if (mysqli_num_rows($resultado) > 0) {
       echo "<tr class='text-center'>";
       echo "<th>Año</th>";
       echo "<th>Numero parte</th>";
       echo "<th>Cliente</th>";
       echo "<th>Tipo</th>";
       echo "<th>Fecha de entrada</th>";
       echo "<th>Fecha de salida</th>";
       echo "<th>Tecnico</th>";
       echo "<th>Intervencion</th>";
       echo "<th>Marca</th>";
       echo "<th>Modelo</th>";
       echo "<th>Numero de serie</th>";
       echo "<th>Horas</th>";
       echo "<th>Descripcion de averia</th>";
       echo "<th>Descripcion de reparacion</th>";
       echo "</tr>";
    while($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr class="text-center">';
        echo '<td>' . $fila["anio"] . '</td>';
        echo "<td>" . $fila["numeroParte"]. '</td>';
        echo "<td>" . $fila["clienteNombre"] . "</td>";
        echo "<td>" . $fila["tipo"] . "</td>";
        echo "<td>" . $fila["fechaEntrada"] . "</td>";
        echo "<td>" . $fila["fechaSalida"] . "</td>";
        echo "<td>" . $fila["tecnico"] . "</td>";
        echo "<td>" . $fila["intervencion"] . "</td>";
        echo "<td>" . $fila["marca"] . "</td>";
        echo "<td>" . $fila["modelo"] . "</td>";
        echo "<td>" . $fila["numeroSerie"] . "</td>";
        echo "<td>" . $fila["horas"] . "</td>";
        echo "<td>" . $fila["descAveria"] . "</td>";
        echo "<td>" . $fila["descReparacion"] . "</td>";
        echo '</tr>';
    }
    } else {
        echo "<tr><td>0 resultados</td></tr>";
    }
    ?>    
    </table>
        <a class="btn btn-dark" href="../index.php">Volver</a>
    </div>
</body>
</html>
<?php  mysqli_close($mysqli); ?>