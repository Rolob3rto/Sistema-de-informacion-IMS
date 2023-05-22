<?php
include 'comunes/db.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear cliente</title>

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

    <h2 class="h2Modificar h2 text-secondary mt-3 text-center" style="text-shadow: 1px 1px 2px black;">Crear cliente</h2>
    <form class="form-table" id="formularioPrincipal" action="creandoCliente.php" method="post">


      <div class="row flex-wrap justify-content-evenly">
        <div class="m-2 col-md-2">
        <label class=" control-label" for="codigo">Id del cliente</label>
          <input type="text" id="codigo" name="codigo" class="form-control input-md">
        </div>
        <div class="elementoForm m-2 col-md-4">
          <div>
            <label class=" control-label" for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control input-md" require>
          </div>

          <div style="margin-top: 1em;">
            <label class=" control-label" for="NIF">NIF/CIF</label>
            <input id="NIF" name="NIF" type="text" class="form-control input-md" pattern="^(\d{8}[A-Z]|[XYZ]\d{7,8}[A-Z]|[ABCDEFGHJPQRSUVNW]\d{7}[0-9A-J])$">

          </div>
        </div>

        <div class="m-2 col-md-5 elementoForm">
          <div>
            <label class=" control-label" for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control input-md"></input>

          </div>
          <div style="margin-top: 1em;">
            <label class=" control-label" for="email">E-mail</label>

            <input id="email" name="email" type="email" class="form-control input-md">
          </div>
        </div>

        <div class="m-2 col-md-4 elementoForm">
          <div>
            <label class=" control-label" for="telefono1">Telefono 1</label>
            <input id="telefono1" name="telefono1" type="tel" pattern="[0-9]{9}" class="form-control input-md">

          </div>

          <div style="margin-top: 1em;">
            <label class=" control-label" for="telefono2">Telefono 2</label>

            <input id="telefono2" name="telefono2" type="tel" pattern="[0-9]{9}" class="form-control input-md">
          </div>
        </div>


        <div class="m-2 col-md-4 elementoForm">
          <div>
          <label class=" control-label" for="datosBanco">Datos de banco</label>
            <input id="datosBanco" name="datosBanco" type="text" class="form-control input-md">

          </div>
          <div style="margin-top: 1em;">
          <label class=" control-label" for="nota">Nota</label>          
            <textarea id="nota" name="nota" rows="4" style="resize:none" class="form-control input-md"></textarea>
          
        </div>
        </div>

        <div class="m-2 col-md-3 elementoForm">
          <div>
            <label class=" control-label">Provincia</label>
            <div>
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

          <div style="margin-top: 1em;">
            <label class=" control-label" for="codigoPostal">Codigo postal</label>
            <input id="codigoPostal" name="codigoPostal" type="text" pattern="[0-9]{5}" class="form-control input-md">

          </div style="margin-top: 1em;">
          <div>
            <label class=" control-label" for="localizacion">Localización</label>          
              <input id="localizacion" name="localizacion" type="text" class="form-control input-md">
            
          </div>
        </div>

        
        <div class="container mb-3 text-center my-1">
          <a class="btn btn-dark mx-2" href="listadoClientes.php">Volver</a>
          <button type="submit" class="btn btn-primary mx-2">Crear</button>
        </div>
      </div>
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