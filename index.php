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
 


 //Ejemplo 

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
***********************************************************/

   //Registrar datos 
  // $arrayRegusltadoRegistro=$ObjDrag->registrar($ObjDrag,'prueba.txt');

/***********************************************************
           Formato de retorno de la funcion registrar
************************************************************

   	 $arrayRespuesta=array(
   	 	'estado'           => 0,                                                   *
   	 	'mensajes'         => '',                                                  *
   	 	'validos'          => 0,                                                   *   
   	 	'errores'          => array(                                               *  
   	 		                    'cantidad' => 0,                                   *   Los mismos resultados que en el formato veificar archivo
   	 		                    'lineas'   => ''                                   *
   	 		                  ),                                                   *
   	 	'info_archivo'     => array(),                                             *
   	 	'html'             => '<div id="cont-tabla"><table id="tabla-registros">'  *
   	 	'registros'       => 0  '[entero] = Cantidad de registros existosos',                         
   	 	'no_registros'    => 0  '[entero] = Cantidad de registros no exitosos', 
   	 	'para_actualizar' => 0  '[entero] = Cantidad de registros encontrados osea para actualizar',
   	    
   	 );
     
     //Estos datos no se retornan se pueden editar para cambiar el valor de estado pueden ser iconos bootstrap.... 
   	 $estados=array(
   	 	'registrado'   => 'registrado',
   	 	'editado'      => 'actualizado',
   	 	'eliminado'    => 'eliminado',
   	 	'encontrado'   => 'Ya registrado',
   	 	'error'        => ''
   	 );

*************************************************************/

/*
   $arrayRegusltadoRegistro=json_decode($arrayRegusltadoRegistro);
  // var_dump($arrayRegusltadoRegistro);
  
  if($arrayRegusltadoRegistro->estado){

?>
             <p>Registrados <?php  echo $arrayRegusltadoRegistro->registros; ?><br>
                 Encontrados <?php  echo $arrayRegusltadoRegistro->para_actualizar; ?></br>
                 Erorres de registro <?php  echo $arrayRegusltadoRegistro->no_registros; ?>
             </p>
             <div>
             	<?php echo $arrayRegusltadoRegistro->html; ?>
             </div>

<?php
  }
  else{
  	echo "Se dectectaron algunos errores";
  }
  
*/

   //Registrar datos 
   $arrayRegusltadoRegistro=$ObjDrag->actualizar($ObjDrag,'prueba.txt');

  //Obtener un array del archivo
 // var_dump($ObjDrag->archivo);

  
  

 ?>