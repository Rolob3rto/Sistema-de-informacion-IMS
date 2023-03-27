<?php
include 'db.php';

function validar_identificador_fiscal($identificador_fiscal) {
  // Expresión regular para DNI, NIE y CIF
  $patron = '/^(\d{8}[A-Z]|[XYZ]\d{7,8}[A-Z]|[ABCDEFGHJPQRSUVNW]\d{7}[0-9A-J])$/i';
  
  if (preg_match($patron, $identificador_fiscal)) {
      // El identificador fiscal es válido
      return true;
  } else {
      // El identificador fiscal no es válido
      return false;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar cliente</title>

  <link rel="stylesheet" href="../css/generico.css">
  <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
  <script src="../js/bootstrap/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php include('comunes/menuPrincipal.php') ?>
  <div class="container formulario">


    <form class="form-table">
      <fieldset>

        <!-- Form Name -->
        <h2 class="h2Modificar h2">Modificar Cliente</h2>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre</label>
          <div class="col-md-4">
            <input id="nombre" name="nombre" type="text" size="100" class="form-control input-md" require>

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="identificador">NIF/CIF</label>
          <div class="col-md-4">
            <input id="indentificador" name="identificador" type="text" placeholder="" class="form-control input-md" pattern="^(\d{8}[A-Z]|[XYZ]\d{7,8}[A-Z]|[ABCDEFGHJPQRSUVNW]\d{7}[0-9A-J])$" require>

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="direccion">Dirección</label>
          <div class="col-md-4">
            <textarea id="direccion" name="direccion" rows="4" style="resize:none" class="form-control input-md"></textarea>

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="telefono1">Telefono 1</label>
          <div class="col-md-4">
            <input id="telefono1" name="telefono1" type="tel" placeholder="" class="form-control input-md">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="telefono2">Telefono 2</label>
          <div class="col-md-4">
            <input id="telefono2" name="telefono2" type="tel" placeholder="" class="form-control input-md">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="email">E-mail</label>
          <div class="col-md-4">
            <input id="email" name="email" type="email" placeholder="" class="form-control input-md">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="datosBanco">Datos de Banco</label>
          <div class="col-md-4">
            <input id="datosBanco" name="datosBanco" type="text" placeholder="" class="form-control input-md">

          </div>
        </div>

        <!-- <div class="form-group">
          <label class="col-md-4 control-label" for="codigoPostal">Codigo Postal</label>
          <div class="col-md-4">
            <input id="codigoPostal" name="codigoPostal" type="" placeholder="" class="form-control input-md">

          </div>
        </div> -->
        <div class="form-group">
            <label class="col-md-4 control-label">Provincia</label>
            <div class="col-md-4">
                <input class="form-control" list="dl" name="provincia">
                <datalist id="dl">
                  <?php
                    $sql = mysqli_query($mysqli, "SELECT provincia FROM provincia");                    
                    while($fila = mysqli_fetch_assoc($sql)){
                      $valor = $fila['provincia'];
                      echo "<option value='". $valor ."'>". $valor ."</option>";
                    }
                  ?>
                </datalist>
            </div>
            
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="localizacion">Localización</label>
          <div class="col-md-4">
            <input id="localizacion" name="localizacion" type="text" placeholder="" class="form-control input-md">

          </div>
        </div>

        <button type="submit" class="btn btn-primary">Modificar</button>
      </fieldset>

    </form>
  </div>

</body>

</html>