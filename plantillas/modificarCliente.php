<?php
include 'comunes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $codigo = $_POST["codigo"];

  // se prepara la consulta SQL con una sentencia preparada para evitar la inyección de SQL
  $stmt = $mysqli->prepare("SELECT * FROM cliente WHERE codigo = ?");
  $stmt->bind_param("i", $codigo);
  $stmt->execute();

  $resultado = $stmt->get_result();
  $cliente = $resultado->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar cliente</title>

  <?php include('comunes/header.php') ?>

  <script>
    $(document).ready(function() {

      // cuando se selecciona una provincia
      $('#provincia').change(function() {
        var provincia = $(this).val();
        $.ajax({
          url: 'obtenerCodigoPostal.php', // ruta al archivo PHP que devuelve el código postal
          method: 'POST',
          data: {
            provincia: provincia
          },
          success: function(response) {
            $('#codigoPostal').val(response); // actualiza el valor del input con el código postal devuelto
          },
          error: function() {
            alert('Error al obtener el código postal');
          }
        });
      });
    });
  </script>
</head>

<body>
  <?php include('comunes/menuPrincipal.php') ?>
  <div class="container formulario">


    <h2 class="h2Modificar h2 text-secondary mt-3 text-center" style="text-shadow: 1px 1px 2px black;">Modificar cliente</h2>
    <form class="form-table" action="modificandoCliente.php" method="post">


      <div class="row flex-wrap justify-content-around">
        <div class="m-2 col-md-2">
          <label class=" control-label" for="nombre">id cliente</label>
          <div>
            <input type="hidden" id="codigoAntiguo" name="codigoAntiguo" value="<?= $cliente['codigo'] ?>">
            <input class="form-control input-md" type="text" id="codigo" name="codigo" value="<?= $cliente['codigo'] ?>" require>

          </div>
        </div>

        <div class="m-2 col-md-4 elementoForm">
          <div>
            <label class=" control-label" for="nombre">Nombre</label>
            <input id="nombre" name="nombre" value="<?= $cliente['nombre'] ?>" type="text" size="100" class="form-control input-md" require>
          </div>

          <div style="margin-top: 1em;">
            <label class=" control-label" for="NIF">NIF/CIF</label>
            <input id="NIF" name="NIF" value="<?= $cliente['NIF'] ?>" type="text" placeholder="" class="form-control input-md" pattern="^(\d{8}[A-Z]|[XYZ]\d{7,8}[A-Z]|[ABCDEFGHJPQRSUVNW]\d{7}[0-9A-J])$">

          </div>
        </div>

        <div class="m-2 col-md-5 elementoForm">
          <div>
            <label class=" control-label" for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" rows="4" style="resize:none" class="form-control input-md" value="<?= $cliente['direccion'] ?>"></input>

          </div>
          <div style="margin-top: 1em;">
            <label class=" control-label" for="email">E-mail</label>
            <input id="email" name="email" value="<?= $cliente['email'] ?>" type="email" placeholder="" class="form-control input-md">
          </div>
        </div>

        <div class="m-2 col-md-4 elementoForm">
          <div>
            <label class=" control-label" for="telefono1">Telefono 1</label>
            <input id="telefono1" name="telefono1" value="<?= $cliente['telefono1'] ?>" type="tel" placeholder="" class="form-control input-md">
          </div>

          <div style="margin-top: 1em;">
            <label class=" control-label" for="telefono2">Telefono 2</label>
            <input id="telefono2" name="telefono2" value="<?= $cliente['telefono2'] ?>" type="tel" placeholder="" class="form-control input-md">

          </div>
        </div>

        <div class="m-2 col-md-4 elementoForm">
          <div>
            <label class=" control-label" for="datosBanco">Datos de banco</label>
            <input id="datosBanco" name="datosBanco" value="<?= $cliente['datosBanco'] ?>" type="text" placeholder="" class="form-control input-md">
          </div>
          <div style="margin-top: 1em;">
            <label class=" control-label" for="nota">Nota</label>
            <textarea id="nota" name="nota" rows="4" style="resize:none" class="form-control input-md"><?= $cliente['nota'] ?></textarea>

          </div>
        </div>

        <div class="m-2 col-md-3 elementoForm">
          <div>
            <label class=" control-label">Provincia</label>
            <div>
              <input class="form-control" value="<?= $cliente['provincia'] ?>" list="dl" id="provincia" name="provincia" autocomplete="off">
              <datalist id="dl">
                <?php
                $sql = mysqli_query($mysqli, "SELECT provincia FROM provincia");
                while ($fila = mysqli_fetch_assoc($sql)) {
                  $valor = $fila['provincia'];
                  $valor_sin_tilde = str_replace(array("á", "é", "í", "ó", "ú"), array("a", "e", "i", "o", "u"), $valor);
                  if ($valor == $valor_sin_tilde) {
                    echo "<option value='" . $valor . "'data-cp='" . $cp . "'>" . $valor . "</option>";
                  } else {
                    echo "<option value='" . $valor . "'data-cp='" . $cp . "'>" . $valor . "</option>";
                    echo "<option value='" . $valor . "'data-cp='" . $cp . "'>" . $valor_sin_tilde . "</option>";
                  }
                }
                ?>
              </datalist>
            </div>
          </div>

          <div style="margin-top: 1em;">
            <label class=" control-label" for="codigoPostal">Codigo postal</label>            
              <input id="codigoPostal" name="codigoPostal" value="<?= $cliente['codigoPostal'] ?>" type="text" placeholder="" class="form-control input-md">
            
          </div>
          <div style="margin-top: 1em;">
            <label class=" control-label" for="localizacion">Localidad</label>          
              <input id="localizacion" name="localizacion" value="<?= $cliente['localizacion'] ?>" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>


        <div class="container m-2 mb-3 text-center">
          <a class="btn btn-dark mx-2" href="listadoClientes.php">Volver</a>
          <button type="submit" class="btn btn-primary mx-2">Modificar</button>
        </div>
      </div>

    </form>
  </div>



</body>

</html>
<?php mysqli_close($mysqli) ?>