<?php
include 'db.php';

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


    <form class="form-table" id="formularioPrincipal" method="post" action="modificandoParte.php">
      <fieldset>

        
        <h2  class="h2Modificar h2 text-secondary mt-3" style="text-shadow: 1px 1px 2px black;">Modificar Parte</h2>
        <h4 class="h4" style="text-shadow: 2px 2px 3px gray;"><?= $parte["anio"] . '/' . str_pad($parte["numeroParte"], 8, '0', STR_PAD_LEFT) ?></h4>

        <input type="hidden" id="idParteTrabajo" name="idParteTrabajo" type="number" value="<?= $_POST["idParteTrabajo"] ?>">
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="tipo">Tipo</label>
          <div class="col-md-4">
            <input id="tipo" name="tipo" type="text" class="form-control input-md" pattern="[a-zA-Z0-9]+" value="<?= $parte['tipo'] ?>">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="estado">Estado</label>
          <div class="col-md-4">
            <input id="estado" title="escribe 3 caracteres que definen el estado" name="estado" type="text" placeholder="estado del parte" value="<?= $parte['estado'] ?>" pattern="^[a-zA-Z]{0,3}$|^$" class="form-control input-md">

          </div>
        </div>
   
        <div class="form-group">
          <label class="col-md-4 control-label" for="cliente">Cliente</label>
          <div class="col-md-4">
            <label for="cliente" class="placeholder">00000 - id<br />NIF o CIF<br />Nombre<br />calle / direccion<br />codigo postal, localidad y provincia<br />telefonos</label>
            <textarea title="ingresa los campos como se especifica, cada uno en su linea" id="cliente" name="cliente" placeholder="00000 - id&#13;&#10;NIF o CIF&#13;&#10;Nombre&#13;&#10;calle / direccion&#13;&#10;codigo postal, localidad y provincia&#13;&#10;telefonos" rows="6" style="resize:none" class="form-control input-md"><?= $parte['cliente'] ?></textarea>

          </div>
          <div class="container">
            <select name="clienteSel" class="clienteSel">
              <option value='' selected>Selecciona un cliente o escribe</option>
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

       
        <div class="form-group">
          <label class="col-md-4 control-label" for="fechaEntrada">Fecha de entrada</label>
          <div class="col-md-4">
            <input id="fechaEntrada" name="fechaEntrada" type="datetime-local" value="<?= $parte['fechaEntrada'] ?>" class="form-control input-md">

          </div>
        </div>


        <div class="form-group">
          <label class="col-md-4 control-label" for="fechaSalida">Fecha de Salida</label>
          <div class="col-md-4">
            <input id="fechaSalida" name="fechaSalida" type="datetime-local" value="<?= $parte['fechaSalida'] ?>" class="form-control input-md">

          </div>
        </div>
        
               <div class="form-group">
                 <label class="col-md-4 control-label" for="tecnico">Tecnico</label>
                 <div class="col-md-4">
                   <input id="tecnico" name="tecnico" type="text" value="<?= $parte['tecnico'] ?>" placeholder="nombre del tecnico" class="form-control input-md">
       
                 </div>
               </div>

               
               <div class="form-group">
          <label class="col-md-4 control-label" for="intervencion">Intervencion</label>
          <div class="col-md-4">
            <textarea id="intervencion" name="intervencion" rows="4" style="resize:none" class="form-control input-md"><?= $parte['intervencion'] ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="marca">Marca</label>
          <div class="col-md-4">
            <input id="marca" name="marca" type="text" placeholder="" value="<?= $parte['marca'] ?>" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="modelo">Modelo</label>
          <div class="col-md-4">
            <input id="modelo" name="modelo" type="text" placeholder="" value="<?= $parte['modelo'] ?>" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="numeroSerie">Numero de Serie</label>
          <div class="col-md-4">
            <input id="numeroSerie" name="numeroSerie" type="text" placeholder="" value="<?= $parte['numeroSerie'] ?>" class="form-control input-md">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="horas">Horas</label>
          <div class="col-md-4">
            <input id="horas" title="horas trabajadas, si esta vacio es 0" name="horas" type="number" value="<?= $parte['horas'] ?>" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="descAveria">Describir Averia</label>
          <div class="col-md-4">
            <textarea id="descAveria" name="descAveria" rows="4" style="resize:none" class="form-control input-md"><?= $parte['descAveria'] ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="descReparacion">Describir Reparacion</label>
          <div class="col-md-4">
            <textarea id="descReparacion" name="descReparacion" rows="4" style="resize:none" class="form-control input-md"><?= $parte['descReparacion'] ?></textarea>
          </div>
        </div>


        <div class="form-group">
          <label class="col-md-4 control-label" for="notas">Notas</label>
          <div class="col-md-4">
            <textarea id="notas" name="notas" rows="4" style="resize:none" class="form-control input-md"><?= $parte['notas'] ?></textarea>
          </div>
        </div>


        <button type="submit" class="btn btn-primary">Modificar</button>
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