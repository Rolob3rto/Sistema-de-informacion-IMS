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

    $sql = "SELECT * FROM `partetrabajo`";
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
    <link rel="stylesheet" href="cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">    
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTablePartes.js"></script>

</head>
<body>
    <?php include('comunes/menuPrincipal.php') ?>
    <div class="container">
    <table id="partesTabla" class="display table table-primary table-bordered">
    <?php 
    
    //listado de clientes para prueba
    if (mysqli_num_rows($resultado) > 0) {
        echo "<thead>";
        echo "<tr class='text-center'>";
        echo "<th>Numero parte</th>";
        echo "<th>Estado</th>";
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
        echo "</tr></thead>";
        echo "<tbody>";
    while($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr class="text-center">';
        echo '<td>IM' . $fila["anio"] . '/' . str_pad($fila["numeroParte"], 8, '0', STR_PAD_LEFT) .'</td>';        
        echo "<td>" . $fila["estado"] . "</td>";
        echo "<td>" . $fila["cliente"] . "</td>";
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
        echo"</tbody>";
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