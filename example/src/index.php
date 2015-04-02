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
    <div class="text-center">
      <h1>Ejemplo Básico</h1>
      <h3>Html, Css, Php y</h3>
      <h4>Bootstrap</h4>
	</div>

	<form class="col-xs-12 col-md-4 col-md-offset-4" method="post" action="cargar.archivo.php">
		<h1>Selecciona la tabla</h1>
		<p>
		    <label>Selecciona la tabla</label>
		    <select name="tabla" class="form-control">
		    	<option value="">Seleccione tabla</option>
<?php 
             $tablas=json_decode($ObjDrag->getTablas($ObjDrag));

             foreach ($tablas as $key => $value) {

 ?>           <option value="<?php echo $value  ?>"><?php echo $value; ?></option>
<?php 
             }
 ?>
          </select>
        </p>
        <p>
        	<input type="submit" class="btn btn-primary" value="Cargar Archivo">
        </p>
	</form>
</main>


</body>
</html>