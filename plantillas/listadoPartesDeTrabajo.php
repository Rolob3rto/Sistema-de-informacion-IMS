<?php
include 'db.php';
$pagina_actual = 'listadoPartesDeTrabajo';

try {
    $sql = "SELECT * FROM `partetrabajo`";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if ($_POST['cerrados'] == true) {
            $sql = "SELECT * FROM `partetrabajo` WHERE `fechaSalida` IS NOT NULL AND `fechaSalida` != '0000-00-00 00:00:00'";
        }
    }
    $resultado = mysqli_query($mysqli, $sql);
} catch (\Throwable $th) {
    echo 'error:' . $th;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de partes de trabajo</title>

    <?php include('comunes/header.php') ?>

</head>

<body>
    <?php include('comunes/menuPrincipal.php') ?>
    <div class="container">
        <aside class="d-flex flex-column flex-shrink-0 p-3 menuLateral container">
            <hr>
            <ul class="nav nav-pills flex-row mb-auto">
                <li class="nav-item">
                    <a class="btn btn-dark m-1" href="../index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class='btn btn-primary m-1' href="crearPartes.php"><b>Añadir parte</b></a>
                </li>
                <li class="nav-item m-1">
                    <form action="listadoPartesDeTrabajo.php" method="post"><input name="cerrados" type="checkbox" checked hidden></input><button class='btn btn-primary' type="submit">partes cerrados</button></form>
                </li>

            </ul>
            <hr>
        </aside>
        <div class="m-3 table">
            <div class="d-flex justify-content-center m-5">
                <div class="spinner-border"  role="status">
                    <span class="sr-only"></span>
                </div>
               
            </div>
            <!-- <div class="d-flex justify-content-center m-5 cargando" role="status">
                <h2>Cargando</h2>
            </div> -->

            <table id="partesTabla" class="display table table-primary table-bordered table-responsive align-middle">
                <?php
                $cadena = "onclick='this.form.target = \"_blank\"'";
                if (mysqli_num_rows($resultado) > 0) {
                    echo "<thead>";
                    echo "<tr class='text-center'>";
                    echo "<th>Numero parte</th>";
                    echo "<th>Estado</th>";
                    echo "<th>Intervencion</th>";
                    echo "<th>Cliente</th>";
                    echo "<th>Fecha de entrada</th>";
                    echo "<th>Fecha de salida</th>";
                    echo "<th>Descripcion de averia</th>";
                    echo "<th></th>";
                    echo "</tr></thead>";
                    echo "<tbody>";
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo '<tr class="text-center">';
                        echo '<td>IM' . $fila["anio"] . '/' . str_pad($fila["numeroParte"], 8, '0', STR_PAD_LEFT) . '</td>';
                        echo "<td>" . $fila["estado"] . "</td>";
                        echo "<td>" . $fila["intervencion"] . "</td>";
                        echo "<td>" . nl2br($fila["cliente"]) . "</td>";
                        echo "<td>" . $fila["fechaEntrada"] . "</td>";
                        echo "<td class='cSalida'>" . $fila["fechaSalida"] . "</td>";
                        echo "<td>" . $fila["descAveria"] . "</td>";
                        echo "<td style='display: inline-block block; justify-content: center;'>";
                        echo "<div>";
                        echo "<form action='modificarParte.php' method='post'>";
                        echo "<input type='hidden' name='idParteTrabajo' value='" . $fila["idParteTrabajo"] . "'>";
                        echo "<button type='submit' class='btn btn-success m-1'> <i class='bi bi-pencil'></i> Modificar</button>";
                        echo "</form>";
                        echo "<form action='borrandoParte.php' method='post'>";
                        echo "<input type='hidden' name='idParteTrabajo' value='" . $fila["idParteTrabajo"] . "'>";
                        echo "<button type='submit' class='btn btn-danger m-1'><i class='bi bi-trash'></i> Borrar</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "<form action='ImprimirParte.php' method='post'>";
                        echo "<input type='hidden' name='idParteTrabajo' value='" . $fila["idParteTrabajo"] . "'>";
                        echo "<button type='submit' class='btn btn-info m-1' " . $cadena . "><i class='bi bi-printer'></i> Imprimir</button>";
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

    <style>
        .spinner-border {
            display: none;                    
        }
    </style>
    <script>
        $('#partesTabla').on('processing.dt', function(e, settings, processing) {
            if (processing) {
                $('.spinner-border').show();
                $('.cargando').show();
            } else {
                $('.spinner-border').hide();
                $('.cargando').hide();
            }
        });
    </script>

</body>
<?php include('comunes/botonSubir.php') ?>

</html>
<?php mysqli_close($mysqli); ?>