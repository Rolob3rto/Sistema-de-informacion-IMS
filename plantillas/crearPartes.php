<?php
include 'db.php';

// Esto es lo que voy a implementar para dar el alta con un nuevo numero de parte

  $sql = "SELECT IFNULL(MAX(numeroParte), 0) + 1 AS siguiente_numero
          FROM parteTrabajo
          WHERE anio = YEAR(NOW());";

  $resultado = mysqli_query($mysqli, $sql);
  $numero = mysqli_fetch_assoc($resultado);
  
  $numeroString = $numero["siguiente_numero"];
  
  $numeroInteger = intval($numeroString);
 
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear parte</title>

  <link rel="stylesheet" href="../css/generico.css">
  <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php include('comunes/menuPrincipal.php') ?>
  <div class="container formulario">


    <form class="form-table" method="post" action="creandoPartes.php">
      <fieldset>

        <!-- Form Name -->
        <h2 class="h2Modificar h2">Crear Parte</h2>
        <h4 class="h4"><?= date('Y') . '/' . str_pad($numeroInteger, 8, '0', STR_PAD_LEFT) ?></h4>        

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="tipo">Tipo</label>
          <div class="col-md-4">
            <input id="tipo" name="tipo" type="text"  class="form-control input-md" value="" require>

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="cliente">Cliente</label>
          <div class="col-md-4">
            <textarea id="cliente" name="cliente" rows="4" style="resize:none" class="form-control input-md"></textarea>

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="fechaEntrada">Fecha de entrada</label>
          <div class="col-md-4">
            <input id="fechaEntrada" name="fechaEntrada" type="datetime-local"  value="<?= date('Y-m-d\TH:i:s') ?>" class="form-control input-md">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="fechaSalida">Fecha de Salida</label>
          <div class="col-md-4">
            <input id="fechaSalida" name="fechaSalida" type="datetime-local" class="form-control input-md">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="tecnico">Tecnico</label>
          <div class="col-md-4">
            <input id="tecnico" name="tecnico" type="text" value="" placeholder="nombre del tecnico" class="form-control input-md">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="intervencion">Intervencion</label>
          <div class="col-md-4">            
            <textarea id="intervencion" name="intervencion" rows="4" style="resize:none" class="form-control input-md"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="modelo">Modelo</label>
          <div class="col-md-4">
            <input id="modelo" name="modelo" type="text" placeholder="" value="" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="marca">Marca</label>
          <div class="col-md-4">
            <input id="marca" name="marca" type="text" placeholder="" value="" class="form-control input-md">

          </div>
        </div>

        <div class="form-group">
        <label class="col-md-4 control-label" for="numeroSerie">Numero de Serie</label>
          <div class="col-md-4">
          <input id="numeroSerie" name="numeroSerie" type="text" placeholder="" value="" class="form-control input-md">
          </div>
        </div>

        <div class="form-group">
        <label class="col-md-4 control-label" for="horas">Horas</label>
          <div class="col-md-4">
          <input id="horas" name="horas" type="text" placeholder="" value="" class="form-control input-md">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="descReparacion">Describir Reparacion</label>
          <div class="col-md-4">            
            <textarea id="descReparacion" name="descReparacion" rows="4" style="resize:none" class="form-control input-md"></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-md-4 control-label" for="descAveria">Describir Averia</label>
          <div class="col-md-4">            
            <textarea id="descAveria" name="descAveria" rows="4" style="resize:none" class="form-control input-md"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="notas">Notas</label>
          <div class="col-md-4">            
            <textarea id="notas" name="notas" rows="4" style="resize:none" class="form-control input-md"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="estado">Estado</label>
          <div class="col-md-4">
            <input id="estado" name="estado" type="text" placeholder="estado del parte" value="" pattern="^[a-zA-Z]{3}$" class="form-control input-md">

          </div>
        </div>    

        

        <button type="submit" class="btn btn-primary">Crear</button>
      </fieldset>

    </form>
  </div>

</body>

</html>

<?php mysqli_close($mysqli) ?>