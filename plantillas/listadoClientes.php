<?php
include 'db.php';

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

    <link rel="stylesheet" href="../css/generico.css">
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTableClientes.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>

</head>

<body>
    <?php include('comunes/menuPrincipal.php') ?>
    <div class="container">
        <aside class="d-flex flex-column flex-shrink-0 p-3 bg-light menuLateral">
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="crearCliente.php" class="btn btn-primary" aria-current="page">Añadir</a>
                </li>

            </ul>
            <hr>
        </aside>
        <div class=" table">

            <table id="clientesTabla" class="display table table-primary table-bordered">
                <?php

                //listado de clientes para prueba
                if (mysqli_num_rows($resultado) > 0) {
                    echo "<thead>";
                    echo "<tr class='text-center'>";
                    echo "<th>Codigo</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Acciones</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<tr class="text-center">';
                        echo "<td>" . $fila["codigo"] . '</td>';
                        echo '<td><a class="btn">' . $fila["nombre"] . '</a></td>';
                        echo '<td style="display: flex; justify-content: center">';
                        echo "<form action='modificarCliente.php' method='post'>";
                        echo "<input type='hidden' name='codigo' value='" . $fila["codigo"] . "'>";
                        echo "<button type='submit' class='btn btn-success m-1'>Modificar</button>";
                        echo "</form>";
                        echo "<form action='borrandoCliente.php' method='post'>";
                        echo "<input type='hidden' name='codigo' value='" . $fila["codigo"] . "'>";
                        echo "<button type='submit' class='btn btn-danger m-1'>Borrar</button>";
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

</html>
<?php mysqli_close($mysqli); ?>