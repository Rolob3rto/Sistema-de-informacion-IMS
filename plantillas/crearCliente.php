<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear cliente</title>

  <link rel="stylesheet" href="../css/generico.css">
  <!-- <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="../css/custom.css">
  <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../js/jquery-3.5.1.js"></script>
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

<style>
    input:invalid {
      background-color: #FFC0CB;
    }

    input:invalid:focus {
      background-color: #FFC0CB;
    }
  </style>
</head>

<body>
  <?php include('comunes/menuPrincipal.php') ?>
  <div class="container formulario">


    <form class="form-table" id="formularioPrincipal" action="creandoCliente.php" method="post">
      <fieldset>

        <h2 class="h2Modificar h2 text-secondary mt-3" style="text-shadow: 1px 1px 2px black;">Crear Cliente</h2>

        <input type="hidden" id="codigo" name="codigo">

        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre</label>
          <div class="col-md-4">
            <input id="nombre" name="nombre" type="text" size="100" class="form-control input-md" require>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="NIF">NIF/CIF</label>
          <div class="col-md-4">
            <input id="NIF" name="NIF" type="text" placeholder="" class="form-control input-md" pattern="^(\d{8}[A-Z]|[XYZ]\d{7,8}[A-Z]|[ABCDEFGHJPQRSUVNW]\d{7}[0-9A-J])$" require>

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="direccion">Dirección</label>
          <div class="col-md-4">
            <textarea id="direccion" name="direccion" rows="4" style="resize:none" class="form-control input-md"></textarea>

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="telefono1">Telefono 1</label>
          <div class="col-md-4">
            <input id="telefono1" name="telefono1" type="tel" pattern="[0-9]{9}" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="telefono2">Telefono 2</label>
          <div class="col-md-4">
            <input id="telefono2" name="telefono2" type="tel" pattern="[0-9]{9}" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="email">E-mail</label>
          <div class="col-md-4">
            <input id="email" name="email" type="email" placeholder="" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="datosBanco">Datos de Banco</label>
          <div class="col-md-4">
            <input id="datosBanco" name="datosBanco" type="text" placeholder="" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Provincia</label>
          <div class="col-md-4">
            <input class="form-control" list="dl" id="provincia" name="provincia" autocomplete="off">
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

        <div class="form-group">
          <label class="col-md-4 control-label" for="codigoPostal">Codigo Postal</label>
          <div class="col-md-4">
            <input id="codigoPostal" name="codigoPostal" type="text" pattern="[0-9]{5}" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="localizacion">Localización</label>
          <div class="col-md-4">
            <input id="localizacion" name="localizacion" type="text" placeholder="" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="nota">Nota</label>
          <div class="col-md-4">
            <textarea id="nota" name="nota" rows="4" style="resize:none" class="form-control input-md"></textarea>

          </div>
        </div>
        <div class="container mb-3">
          <a class="btn btn-dark mx-2" href="listadoClientes.php">volver</a>
          <button type="submit" class="btn btn-primary mx-2">Crear</button>
        </div>
      </fieldset>

    </form>
  </div>



</body>

<script>
  var form = document.getElementById('formularioPrincipal');

  form.addEventListener('submit', function(event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      alert('Ajustese al formato solicitado');
      var invalidInputs = document.querySelectorAll(':invalid');
      var invalidInputsFocus = document.querySelectorAll(':invalid:focus');
      for (var input of invalidInputs) {
        input.style.backgroundColor = '#FFC0CB';
      }
      for (var input of invalidInputsFocus) {
        input.style.backgroundColor = '#FFC0CB';
      }
    }
  });
</script>

</html>
<?php mysqli_close($mysqli) ?>