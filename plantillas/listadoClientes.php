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

    $sql = "SELECT * FROM cliente";
 
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $busqueda = $_POST["nombreCliente"];
    }
    

    if (!empty($busqueda)) {
        $busqueda = mysqli_real_escape_string($mysqli ,$busqueda);
        $sql .= " WHERE nombre LIKE '%" . $busqueda . "%'";
    }

    $resultado = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de clientes</title>

    <link rel="stylesheet" href="../css/generico.css">
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include('comunes/menuPrincipal.php') ?>
    <div class="container principal">
        <?php include('comunes/menuLateral.php') ?>
    <div class="m-0">
        <?php
            if (!empty($busqueda)) {
                $inputBusqueda = $busqueda;
            } else {
                $inputBusqueda = '';
            }
            echo "<form class='formBusqueda' action='listadoClientes.php' method='post'>";
            echo" <label class='form-label m-lg-2' for='nombreCliente'>Cliente: </label>";
            echo "<input type='text' name='nombreCliente' value='" . $inputBusqueda ."'>";           
            echo "<button class='btn btn-dark m-md-1' type='submit'>Buscar</button>";
            echo "</form>";
            ?>
            
    <table class="table table-primary">       
    <?php 
    
    //listado de clientes para prueba
    if (mysqli_num_rows($resultado) > 0) {
       echo "<tr class='text-center'>";
       echo "<th>Codigo</th>";
       echo "<th>Nombre</th>";
       echo "<th colspan='2'></th>";
       echo "</tr>";
    while($fila = mysqli_fetch_assoc($resultado)) {
        echo '<tr class="text-center">';
        echo "<td>" . $fila["codigo"]. '</td>';
        echo '<td><a>' . $fila["nombre"] . '</a></td>';        
        echo '<td><a class="btn" href="#">Modificar</a></td>';        
        echo '<td><a class="btn" href="#">Borrar</a></td>';        
        echo '</tr>';
    }
    } else {
        echo "<tr><td>0 resultados</td></tr>";
    }
    ?>    
    </table>
        <a class="btn btn-dark" href="../index.php">Volver</a>
    </div>
    </div>
</body>
</html>
<?php  mysqli_close($mysqli); ?>