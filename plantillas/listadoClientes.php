<?php
include 'comunes/db.php';
$pagina_actual = 'listadoClientes';

$sql = "SELECT * FROM cliente";

$resultado = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de clientes</title>

    <?php include('comunes/header.php') ?>
    
</head>

<body>
    <?php include('comunes/menuPrincipal.php') ?>
    <div class="container">
        <aside class="d-flex flex-column flex-shrink-0 p-3 menuLateral">
            <hr>
            <ul class="nav nav-pills flex-row mb-auto">
                <li class="nav-item">
                    <a class="btn btn-dark m-1" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="crearCliente.php" class="btn btn-primary m-1" aria-current="page">Añadir Cliente</a>
                </li>

            </ul>
            <hr>
        </aside>
        <div class="table">

            <table id="clientesTabla" class="display table table-primary table-bordered align-middle">
                <?php

                //listado de clientes para prueba
                if (mysqli_num_rows($resultado) > 0) {
                    echo "<thead>";
                    echo "<tr class='text-center'>";
                    echo "<th>Codigo</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Telefono</th>";
                    echo "<th>Direccion</th>";
                    echo "<th>localidad</th>";
                    echo "<th>Acciones</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<tr class="text-center">';
                        echo "<td>" . $fila["codigo"] . '</td>';
                        echo '<td>' . $fila["nombre"] . '</td>';
                        echo '<td>' . $fila["telefono1"] . '</td>';
                        echo '<td>' . $fila["direccion"] . '</td>';
                        echo '<td>' . $fila["localizacion"] . '</td>';
                        echo '<td style="display: inline-block block; justify-content: center">';
                        echo "<form action='modificarCliente.php' method='post'>";
                        echo "<input type='hidden' name='codigo' value='" . $fila["codigo"] . "'>";
                        echo "<button type='submit' class='btn btn-success m-1'><i class='bi bi-pencil'></i> Modificar</button>";
                        echo "</form>";
                        echo "<form action='borrandoCliente.php' method='post'>";
                        echo "<input type='hidden' name='codigo' value='" . $fila["codigo"] . "'>";
                        echo "<button type='submit' class='btn btn-danger m-1'><i class='bi bi-trash'></i>Borrar</button>";
                        echo "</form>";
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo "</tbody>";
                } else {
                    echo "<tr><td>0 resultados</td></tr>";
                }
                ?>
            </table>
            <a class="btn btn-dark" href="../index.php">Volver</a>
        </div>
    </div>
</body>
<?php include('comunes/botonSubir.php') ?>
</html>
<?php mysqli_close($mysqli); ?>