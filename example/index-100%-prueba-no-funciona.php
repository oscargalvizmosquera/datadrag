
<?php 

  include_once 'config.php';
  include_once 'class.control.error.php';
  include_once 'class.datadrag.php';
  
  $ObjDrag=new DataDrag('ejemplo');





  //Obtiene dos datos de configuracion host,usuario,db,clave..
  $DatasConfig=$ObjDrag->getDatasConfig();
  

  //Obtiene JSON de tablas que existen en la base de datos
  $tablas = $ObjDrag->getTablas($ObjDrag);

  //Obtiene los campos de la tabla
  $ObjDrag->getCamposTabla($ObjDrag);

  //Captura el archivo y verifica si el formato es correcto de acuerdo a los campos de la tabla
  $estadoArchivo = $ObjDrag->verficarArchivo($ObjDrag,'prueba.txt');
  
/*********************************************************
    Formato de retorno de la funcion VerificarArchivo
**********************************************************
 	 $arrayRespuesta=array(

   	 	'estado'           => 0 ó 1,
   	 	'mensajes'         => 'Mensajes de lienas afectadas o estado del proceso de verificación',
   	 	'validos'          => 'Numero de lineas que se encontraron con el formato correcto',
   	 	'errores'          => array(
   	 		                    'cantidad' => '[int] = Cantidad de lineas que no contaban con el formato correcto',
   	 		                    'lineas'   => '[String] = Lineas que no contaban con el formato ejemplo : L:1,l:2..' = error en la Linea 1, erro en la linea 2..
   	 		                  ),
   	 	'info_archivo'     => array(
   	 	                         'num_filas' => '[int] = Numero de lineas que se dedectaron en el archivo'
   	 	                      ), 
   	 	'html'             => '<div id="cont-tabla"><table id="tabla-registros">'  '[HTML] = Registros con que se detectaron en formtato de tabla html con atributos id para darle estilo Css'

   	 );
***********************************************************/
   
   $arrayResultadoEvaluacion=json_decode($estadoArchivo);

   if($arrayResultadoEvaluacion->estado){





   }else{
   	  echo "<h4>Candidad de lineas evaluadas ".$arrayResultadoEvaluacion->info_archivo->num_filas."</h4>";
   	  echo "<h2>Numero de lineas correctas ".$arrayResultadoEvaluacion->validos."</h2>";
   	  echo "<h3>Numero de errores ".$arrayResultadoEvaluacion->errores->cantidad."</h3>";
   	  echo "<h3>Errores en la(s) liena(s) :".$arrayResultadoEvaluacion->errores->lineas."</h3>";
   	  echo '<h1>El archivo se encuentra en buen estado</h1>';
   	  echo "<hr>";
   	  echo "<h2>Html</h2>";
   	  echo $arrayResultadoEvaluacion->html;	
   }








  //Obtener un array del archivon
 // var_dump($ObjDrag->archivo);

  
  

 ?>