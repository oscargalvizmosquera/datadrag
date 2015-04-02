<?php 
  

  include_once 'datadrag/config.php';
  include_once 'datadrag/class.control.error.php';
  include_once 'datadrag/class.datadrag.php';
  
  $ObjDrag=new DataDrag('ejemplo');


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DataDrag</title>
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
<main class="container">
  <div class="col-xs-12 col-md-12 text-center">
      <div class="text-center">
      <h1>Ejemplo Básico</h1>
      <h3>Html, Css, Php y</h3>
      <h4>Bootstrap</h4>
    </div>
      <hr>
  </div>
  <div class="col-md-4">
    <h4>Primera Opción</h3>
    <p>
      Solo verificara que el archivo tenga el formato adecuado a la tabla seleccionada anteriormente y mostrara estado de la verificación:<br>
      Lineas caputuradas, cantidad de errores y las lineas donde se encontraron los errores.
    </p>
  </div>
  <div class="col-md-8">
  	<form class="text-center" action="verificar.archivo.php" method="post" enctype="multipart/form-data">
  		<h2 class="alert-warning">Seleccione un archivo del disco</h2>
      <h3>Solo Verificar formato del archivo</h3>
  		<p>
          <input type="file" accept="text/*" name="archivo" style="padding-bottom:40px;" class="form-control" required>
      </p>
          <p>
          	<input type="submit" class="btn btn-info" value="Verificar Archivo">
          </p>
        <hr>
  	</form>
  </div>
  <div class="col-md-4">
    <h4>Segunda Opción</h3>
    <p>
      Esta opcion ademas de verificar el archivo realizara el registro de los datos que encuentre con el formato adecuado en el archivo
      seleccionado
    </p>
  </div>
  <div class="col-md-8">
    <form class=" text-center" method="post" action="veificar.archivo.r.php" entype="multipart/form-data">
      <h2 class="alert-warning">Seleccione un archivo del disco</h2>
      <h3>Verificar y registrar</h3>
      <p>
          <input type="file" accept="text/*" name="archivo" style="padding-bottom:40px;" class="form-control" required>
      </p>
          <p>
            <input type="submit" class="btn btn-info" value="Verificar Archivo y registrar">
          </p>
    </form>
  </div>
</main>


</body>
</html>