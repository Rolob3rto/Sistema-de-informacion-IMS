<?php
include 'comunes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST["idParteTrabajo"];

  $sql = "SELECT * FROM parteTrabajo WHERE idParteTrabajo = " . $id;
}

$resultado = mysqli_query($mysqli, $sql);
$parte = mysqli_fetch_assoc($resultado);

$sqlClientes = "SELECT * FROM cliente";

$resultadoClientes = mysqli_query($mysqli, $sqlClientes);
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar parte</title>

  <?php include('comunes/header.php') ?>

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
      <h2 class="h2Modificar h2 text-secondary mt-3" style="text-shadow: 1px 1px 2px black;">Modificar Parte</h2>
      <h4 class="h4" style="text-shadow: 2px 2px 3px gray;"><?= $parte["anio"] . '/' . str_pad($parte["numeroParte"], 8, '0', STR_PAD_LEFT) ?></h4>
    </div>
    <form id="formularioPrincipal" method="post" action="modificandoParte.php">
      <div class="row flex-wrap justify-content-center">

        <input type="hidden" id="idParteTrabajo" name="idParteTrabajo" type="number" value="<?= $_POST["idParteTrabajo"] ?>">

        <div class="elementoForm col-md-3">
          <div>
            <label class=" control-label" for="tipo">Tipo</label>
            <div>
              <input id="tipo" name="tipo" type="text" class="form-control input-md" pattern="[a-zA-Z0-9]+" value="<?= $parte['tipo'] ?>">

            </div>
          </div>

          <div>
            <label class="control-label" for="estado">Estado</label>
            <input id="estado-input" name="estado" type="hidden" placeholder="estado del parte" value="<?= $parte['estado'] ?>" class="form-control input-md">
            <select id="estado" class="form-select">
              <option value="ENT" <?= ($parte['estado'] === 'ENT') ? 'selected' : ''; ?>>ENT</option>
              <option value="SAL" <?= ($parte['estado'] === 'SAL') ? 'selected' : ''; ?>>SAL</option>
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
          <label class=" control-label" for="cliente">Cliente</label>  
          <textarea title="si esta en seleccionar/escribir escribe max 4 lineas sino 6 (id y nif primero)" id="cliente" name="cliente" placeholder="Nombre&#13;&#10;calle / direccion&#13;&#10;codigo postal, localidad y provincia&#13;&#10;telefonos" rows="6" style="resize:none" class="form-control input-md"><?= preg_replace('/^[ ]+/m', '', $parte['cliente']) ?></textarea>

          <div style="justify-content: center; text-align: center;">
            <select name="clienteSel" class="clienteSel">
              <option value="<?= $parte['cliente'] ?>" selected default>cliente actual</option>
              <option value="">Selecciona un cliente o escribe</option>
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
            <input id="fechaEntrada" name="fechaEntrada" type="datetime-local" value="<?= $parte['fechaEntrada'] ?>" class="form-control input-md">
          </div>

          <div>
            <label class=" control-label" for="fechaSalida">Fecha de salida</label>
            <input id="fechaSalida" name="fechaSalida" type="datetime-local" value="<?= $parte['fechaSalida'] ?>" class="form-control input-md">
          </div>
        </div>      

        <div class="elementoForm my-1 col-md-3">
          <div>
            <label for="tecnico">Tecnico</label>
            <input id="tecnico" name="tecnico" type="text" value="<?= $parte['tecnico'] ?>" placeholder="nombre del tecnico" class="form-control input-md">
          </div>
          <div style="margin-top: 1em;">
            <label class="form-check-label" for="presupuesto">Presupuesto</label>
            <input type="checkbox" name="presupuesto" class="form-check-input input-md m-0" style="width: 1.5em; height: 1.5em;" <?php if ($parte['presupuesto'] == 1) echo 'checked'; ?>>
          </div>
        </div>


        <div class="my-1 col-md-6">
          <label class=" control-label" for="intervencion">Intervención</label>
          <div>
            <input type="text" id="intervencion" name="intervencion" rows="4" style="resize:none" class="form-control input-md" value="<?= $parte['intervencion'] ?>"></input>
          </div>
        </div>

        <div class="elementoForm my-1 col-md-4">
          <div>
            <label class=" control-label" for="marca">Marca</label>
            <input id="marca" name="marca" type="text" placeholder="" value="<?= $parte['marca'] ?>" class="form-control input-md">

          </div>

          <div>
            <label class="control-label" for="modelo">Modelo</label>

            <input id="modelo" name="modelo" type="text" placeholder="" value="<?= $parte['modelo'] ?>" class="form-control input-md">
          </div>
        </div>
        <div class="elementoForm my-1 col-md-4">
          <div>
            <label class="control-label" for="numeroSerie">Numero de serie</label>
            <input id="numeroSerie" name="numeroSerie" type="text" placeholder="" value="<?= $parte['numeroSerie'] ?>" class="form-control input-md">
          </div>
          <div class="my-1 col-md-6">
            <label class="control-label" for="horas">Horas</label>
            <input id="horas" title="horas trabajadas, si esta vacio es 0" name="horas" type="number" pattern="[0-9]+" value="<?= $parte['horas'] ?>" class="form-control input-md">
          </div>
        </div>

        <div class="my-1 col-md-7">
          <label class=" control-label" for="descAveria">Describir averia</label>
          <div>
            <textarea id="descAveria" name="descAveria" rows="4" style="resize:none" class="form-control input-md"><?= $parte['descAveria'] ?></textarea>
          </div>
        </div>

        <div class="my-1 col-md-7">
          <label class=" control-label" for="descReparacion">Describir reparacion</label>
          <div>
            <textarea id="descReparacion" name="descReparacion" rows="4" style="resize:none" class="form-control input-md"><?= $parte['descReparacion'] ?></textarea>
          </div>
        </div>


        <div class="my-1 col-md-7">
          <label class=" control-label" for="notas">Notas</label>
          <div>
            <textarea id="notas" name="notas" rows="4" style="resize:none" class="form-control input-md"><?= $parte['notas'] ?></textarea>
          </div>
        </div>
        
        <div class="container m-3 text-center">
          <a class="btn btn-dark mx-2" href="listadoPartesDeTrabajo.php">Volver</a>
          <button id="btnsubmit" type="submit" class="btn btn-primary mx-2">Modificar</button>
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

  $(document).ready(function() {
    $('#formularioPrincipal').on('submit', function() {

      var textarea = $('#cliente');
      var currentValue = textarea.val();

      if ($('#opcionBase').val() === '') {
        var newValue = '<?= str_pad(1, 5, '0', STR_PAD_LEFT) . "\n" . '' . "\n" ?>' + currentValue;
        textarea.val(newValue);
      }
    });
  });
</script>

</html>

<?php mysqli_close($mysqli) ?>