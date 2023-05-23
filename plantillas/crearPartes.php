<?php
include 'comunes/db.php';

$sql = "SELECT IFNULL(MAX(numeroParte), 0) + 1 AS siguiente_numero
          FROM parteTrabajo
          WHERE anio = YEAR(NOW());";

$resultado = mysqli_query($mysqli, $sql);
$numero = mysqli_fetch_assoc($resultado);

$numeroString = $numero["siguiente_numero"];

$numeroInteger = intval($numeroString);

$sqlClientes = "SELECT * FROM cliente";

$resultadoClientes = mysqli_query($mysqli, $sqlClientes);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear parte</title>

  <?php include('comunes/header.php') ?>
  <!-- <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css"> -->

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
    <div class="text-center">
      <h2 class="h2 text-secondary mt-3" style="text-shadow: 1px 1px 2px black;">Crear parte</h2>
      <h4 class="h4" style="text-shadow: 2px 2px 3px gray;"><?= date('Y') . '/' . str_pad($numeroInteger, 8, '0', STR_PAD_LEFT) ?></h4>
    </div>
    <form id="formularioPrincipal" method="post" action="creandoPartes.php">


      <div class="row flex-wrap justify-content-center">
        <div class="elementoForm col-md-3">
          <div>
            <label class=" control-label" for="tipo">Tipo</label>
            <input id="tipo" name="tipo" type="text" class="form-control input-md" pattern="[a-zA-Z0-9]+" value="informatica">
          </div>
          <div>
            <label class="control-label" for="estado">Estado</label>
            <input id="estado-input" name="estado" type="hidden" placeholder="estado del parte" value="ENT" class="form-control input-md">
            <select id="estado" class="form-select">
              <option value="ENT" selected>ENT</option>
              <option value="SAL">SAL</option>
            </select>

            <script>
              var selectEstado = document.getElementById("estado");

              selectEstado.addEventListener("change", function() {
                var inputEstado = document.getElementById("estado-input");

                inputEstado.value = selectEstado.value;
              });
            </script>
          </div>
        </div>



        <div class="my-1 col-md-5">
          <label class="control-label" for="cliente">Cliente</label>
          <div>

            <input type="checkbox" id="contados" name="contados" hidden>
            <!-- <label for="cliente" class="placeholder">Nombre<br />calle / direccion<br />codigo postal, localidad y provincia<br />telefonos<br />(4 lineas max)</label> -->
            <textarea title="ingresa los campos como se especifica, cada uno en su linea. A no ser que este en seleccionar que entonces el id y nif no hacen falta" id="cliente" name="cliente" placeholder="Nombre&#13;&#10;calle / direccion&#13;&#10;codigo postal, localidad y provincia&#13;&#10;telefonos&#13;&#10;(4 lineas max)" rows="6" style="resize:none" class="form-control input-md"></textarea>

          </div>
          <div style="justify-content: center; text-align: center;">

            <select id="clienteSel" name="clienteSel" class="clienteSel">
              <option value="" selected default>Selecciona un cliente o escribe</option>
              <?php
              while ($cliente = mysqli_fetch_assoc($resultadoClientes)) {
                echo '<option value="' . str_pad($cliente["codigo"], 5, '0', STR_PAD_LEFT) . "\n" . $cliente['NIF'] . "\n" . $cliente['nombre'] . "\n" . $cliente['direccion'] . "\n" . $cliente['codigoPostal'] . ' ' . $cliente['localizacion'] .  ' (' . $cliente['provincia'] . ')' . "\n" . $cliente['telefono1'] . ' / ' . $cliente['telefono2'] . '">' . $cliente['nombre'] . '</option>';
              }

              ?>
            </select>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            $('.clienteSel').on('change', function() {
              var select = $('.clienteSel');
              var textarea = $('#cliente');

              var selectedOption = select.find('option:selected');
              var clienteCodigo = selectedOption.val();
              var clienteNombre = selectedOption.text();

              textarea.val(clienteCodigo);


            });

            $('.clienteSel').select2();
          });
        </script>

        <div class="elementoForm my-1 col-md-4">
          <div>
            <label class=" control-label" for="fechaEntrada">Fecha de entrada</label>
            <input id="fechaEntrada" name="fechaEntrada" type="datetime-local" value="<?= date('Y-m-d\TH:i:s') ?>" class="form-control input-md" require>
          </div>
          <div>
            <label class="control-label" for="fechaSalida">Fecha de salida</label>
            <input id="fechaSalida" name="fechaSalida" type="datetime-local" class="form-control input-md">
          </div>
        </div>

        <div class="elementoForm my-1 col-md-3">
          <div>
            <label for="tecnico">Tecnico</label>
            <input id="tecnico" name="tecnico" type="text" value="Arturo" placeholder="nombre del tecnico" class="form-control input-md">
          </div>
          <div>
            <label class="form-check-label" for="presupuesto">Presupuesto</label>
            <input type="checkbox" name="presupuesto" class="form-check-input input-md m-0" style="width: 1.5em; height: 1.5em;">
          </div>
        </div>

        <div class="my-1 col-md-6">
          <label class="control-label" for="intervencion">Intervención</label>
          <input type="text" id="intervencion" placeholder="Describir por que se hace la intervencion" name="intervencion" style="resize:none" class="form-control input-md"></input>
        </div>

        <div class="elementoForm my-1 col-md-6">
          <div>
            <label class="control-label" for="marca">Marca</label>
            <input id="marca" name="marca" type="text" placeholder="" value="" class="form-control input-md">

          </div>
          <div>
            <label class="control-label" for="modelo">Modelo</label>
            <input id="modelo" name="modelo" type="text" placeholder="" value="" class="form-control input-md">

          </div>
        </div>


        <div class="elementoForm my-1 col-md-4">
          <div>
            <label class="control-label" for="numeroSerie">Numero de serie</label>
            <input id="numeroSerie" name="numeroSerie" type="text" placeholder="" value="" class="form-control input-md">
          </div>
          <div class="my-1 col-md-6">
            <label class="control-label" for="horas">Horas</label>
            <input id="horas" title="horas trabajadas, si esta vacio es 0" name="horas" type="number" pattern="[0-9]+" placeholder="" class="form-control input-md">
          </div>
        </div>

        <div class="my-1 col-md-7">
          <label class="control-label" for="descAveria">Describir averia</label>
          <div>
            <textarea id="descAveria" name="descAveria" rows="4" style="resize:none" class="form-control input-md"></textarea>
          </div>
        </div>

        <div class="my-1 col-md-7">
          <label class="control-label" for="descReparacion">Describir reparacion</label>
          <div>
            <textarea id="descReparacion" name="descReparacion" rows="4" style="resize:none" class="form-control input-md"></textarea>
          </div>
        </div>

        <div class="my-1 col-md-7">
          <label class="control-label" for="notas">Notas</label>
          <div>
            <textarea id="notas" name="notas" rows="4" style="resize:none" class="form-control input-md"></textarea>
          </div>
        </div>
        <div class="container m-3 text-center">
          <a class="btn btn-dark mx-2" href="listadoPartesDeTrabajo.php">Volver</a>
          <button id="btnsubmit" type="submit" class="btn btn-primary mx-2">Crear</button>
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

    var inputContados = document.getElementById('contados');

    var clienteSel = document.getElementById('clienteSel');
    if (clienteSel.value == '' && form.checkValidity()) {
      event.preventDefault();
      inputContados.checked = true;

      this.submit();
    }
  });
</script>

</html>

<?php mysqli_close($mysqli) ?>