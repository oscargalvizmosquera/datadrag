<?php 
  

  include_once 'datadrag/config.php';
  include_once 'datadrag/class.control.error.php';
  include_once 'datadrag/class.datadrag.php';
  include_once 'printJson.php';
  
  $ObjDrag=new DataDrag('ejemplo');


    //Para este caso de ejemplo no se van ha tomar metodos de seguridad en carga de arhivos
    $archivo=$_FILES['archivo'];
    
    $resultadoVerificacion=$ObjDrag->verificarArchivo($ObjDrag,$archivo['tmp_name']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DataDrag</title>
  <link rel="stylesheet" type="text/css" href="../../js/bootstrap/css/bootstrap.css">
<style>
  body{
    padding-bottom: 13%;
  }
</style>

</head>
<body>
<main class="container-fluid">
	<div class="col-xs-12 col-md-12">
      <div class="text-center">
      <h1>Ejemplo Básico</h1>
      <h3>Html, Css y Php</h3>
      <h4>Bootstrap</h4>
      <h1>Resultados</h1>
    </div>
  <div class="col-xs-12 col-md-6">
     <h4>Respuesta recibida del metodo verificarArchivo($ObjDrap,[ruta])</h4>
     <pre>
<?php 
   
     $buscar=array("\\","\t","\n",'rn');
     $rempazar=array('','','','');
     echo htmlspecialchars(prettyPrint(  str_replace($buscar,$rempazar,$resultadoVerificacion )));

?> </pre>
  </div>
  <div class="col-xs-12 col-md-6">
     <h4>Respuesta pasada a Arreglo</h4>
<?php 
   
    var_dump(json_decode($resultadoVerificacion));

    $datos=json_decode($resultadoVerificacion)

?>
  </div> 
  <div class="col-xs-12 col-md-12 well">
    <h2>Resultados de archivo</h2>
    <div class="col-xs-12 col-md-12">
      <h4>Estado del archivo = <?php echo $datos->estado; ?> ( 0 Errores de formato, 1 Formato correcto ).</h4>
      <h4>Mensajes = <?php echo $datos->mensajes; ?>.</h4>
      <h4>Registros aprobados = <?php echo $datos->validos; ?>.</h4>
      <h4>Errores de formato = <?php echo $datos->errores->cantidad; ?>.</h4>
      <h4>Errores de formato numero(s) liena(s) = <?php echo $datos->errores->lineas; ?>.</h4>
      <h4>Numero de filas filas dectadas = <?php echo $datos->info_archivo->num_filas; ?>. </h4>
    </div>
  </div>
  <div class="col-xs-12 col-md-12">
    <h2>Respuesta Html</h2>
      <?php 
          echo $datos->html;
       ?>
  </div>
</main>



<script src="js/jquery-1.11.2.min.js"></script>
<script src="../../js/jquery-1.11.2.min.js"></script>
<script>
  $('#cont-tabla').addClass('table-responsive');
  $('#tabla-registros').addClass('table table-bordered');
  $('.encabezado-tabla').addClass('danger');
</script>
  
</body>
</html>










































