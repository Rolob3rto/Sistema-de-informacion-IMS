<?php

    include 'db.php';

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
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">    
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTablePartes.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>    

</head>
<body>
    <?php include('comunes/menuPrincipal.php') ?>
    <aside class="d-flex flex-column flex-shrink-0 p-3 bg-light menuLateral container">    
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">              
        <a class='btn btn-primary m-1' href="crearPartes.php">Añadir parte</a>
      </li>
       
    </ul>
    <hr>
</aside>
    <div class="m-3 table-responsive">
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
        echo "<th></th>";
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
        echo "<td>";
        echo "<form action='modificarParte.php' method='post'>";
        echo "<input type='hidden' name='idParteTrabajo' value='". $fila["idParteTrabajo"] ."'>";
        echo "<button type='submit' class='btn btn-success m-1'>Modificar</button>";
        echo "</form>";
        echo "<form action='borrandoParte.php' method='post'>";
        echo "<input type='hidden' name='idParteTrabajo' value='". $fila["idParteTrabajo"] ."'>";
        echo "<button type='submit' class='btn btn-danger m-1'>Modificar</button>";
        echo "</form>";
        echo '</td>';
      
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
<?php  mysqli_close($mysqli);?>