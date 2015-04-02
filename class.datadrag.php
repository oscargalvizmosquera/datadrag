<?php 

class DataDrag extends ControlError {

	//Atributos

	private static $_driver=DRIVER;
	
	private static $_host=HOST;
	
	private static $_dbname=DBNAME;
	
	private static $_usuario=USER;
	
	private static $_clave=PASSWORD;
	
	private static $_conexion;
	
	private $tabla=null;
	
	public $archivo=null;

	
   
    //Metodos

	public function __construct($tabla=0){
	
		if($tabla){

			$this->tabla=$tabla;
		
		}

		$dsn=self::$_driver.":host=".self::$_host.";dbname=".self::$_dbname;
		
		if(!isset(self::$_conexion)){
		
		  self::$_conexion=new PDO($dsn,self::$_usuario,self::$_clave,array(PDO::ATTR_PERSISTENT=>false,PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));
		
		  self::$_conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
		}
		
		return self::$_conexion;
	
	}
	
	public function Exec($sql){

		try {

			return self::$_conexion->exec($sql);
		
		} catch (PDOException $e) {
		
			echo 'Error tratando en funcion Exec de clase DataDrag';
		
		}
		
	}

	public function Query($sql){
	
		try{

			return self::$_conexion->query($sql);

		} catch (PDOException $e){
			
			if($e->getCode()=='42S02'){
	
				echo "La tabla definida no existe. Error:<br>".$e->getMessage();
	
			}
			elseif($e->getCode()=='42000'){
	
				echo "Error de Syntax verifica tu Query o investiga como hacer consultas SQL";

				var_dump($e);
	
			}else{

				var_dump($e);

			}

		}
		
	}
	public function _clone(){

		trigger_error("Este objeto no se puede clonar",E_USER_ERROR);

	}

   public function getDatasConfig(){

   	  return $atributos=array(

   	  	'driver'    => DRIVER,

   	  	'host'      => HOST,

   	  	'baseDatos' => DBNAME,

   	  	'usuario'   => USER,

   	  	'contrasena'     => PASSWORD
   	  );

   }

   public function getTablas($ObjDrag){

      $tablas=array();

      $incremental=0;

	  $consulta = "SHOW FULL TABLES FROM " .DBNAME;

	  $respuesta = $ObjDrag -> Query( $consulta );
	  
	  try {

	  	 ControlError::existenTablas($respuesta);

         while ( $datos = $respuesta -> fetch() ){
		 
		    $atributo='Tables_in_'.DBNAME;

		    array_push( $tablas , $datos[ $atributo ] );

		  }

		  return json_encode( $tablas );
	  	
	  } catch ( Exception $e ) {

	  	  echo $e->getMessage();

	  }

   }

   public function getCamposTabla($ObjDrag,$nombreTabla=0){

   	  if(!$nombreTabla){
   	  	try{
   	  		$nombreTabla=ControlError::verificaTabla($this->tabla);
   	  	}catch(Exception $e){
   	  		echo $e->getMessage();
   	  	}
   	  
   	  }
   	  else{
   	  	  $this->tabla=$nombreTabla;
   	  }

   	  $nombsColumnas=array();

   	  $i = 0;
   	  
   	  $consulta = "select * from " . $nombreTabla;

   	  $respuesta = $ObjDrag ->Query($consulta);

   	  try {

   	  	if($respuesta){

	   	      $numColumnas=ControlError::existenColumnas($respuesta);
	   	      
	   	      if(!__ID__){
	   	
				$numColumnas-=1;

	   	      	$inicio=1;

			   	for( $i = $inicio ; $i <= $numColumnas ; $i++ ){

			   	  $meta = $respuesta->getColumnMeta($i);

			   	  array_push($nombsColumnas,$meta['name']);

			   	}	
   	      
	   	      }
	   	      else{

	   	      	$inicio=0;
			   	
			   	for( $i = $inicio ; $i < $numColumnas ; $i++ ){

			   	  $meta = $respuesta->getColumnMeta($i);

			   	  array_push($nombsColumnas,$meta['name']);

			   	} 	
   	      
	   	      }

  
		   	return json_encode($nombsColumnas);	 
		} 	

   	  } catch (Exception $e) {

   	  	echo $e->getMessage();

   	  }


   }

   public function verficarArchivo($ObjDrag,$archivo){


   	 $arrayRespuesta=array(

   	 	'estado'           => 0,
   	 	'mensajes'         => '',
   	 	'validos'          => 0,
   	 	'errores'          => array(
   	 		                    'cantidad' => 0,
   	 		                    'lineas'   => ''
   	 		                  ),
   	 	'info_archivo'     => array(),
   	 	'html'             => '<div id="cont-tabla"><table id="tabla-registros">'

   	 );

     $campos=$ObjDrag->getCamposTabla($ObjDrag);

     $campos=json_decode($campos); 

      $arrayRespuesta['html'].='<tr class="encabezado-tabla">';

	     foreach ($campos as $key => $value) {
	  
	     	$arrayRespuesta['html'].='<th>'.$value.'</th>';
	  
	     }
	  
	  $arrayRespuesta['html'].='</tr>';

	  try {

	  	$archivo = ControlError::recibirArchivo($archivo);

	  	$this->archivo=$archivo;

	  	$arrayRespuesta['info_archivo']['num_filas']=count($archivo);

	   	$consulta = "select * from " . $this->tabla;

	   	$respuesta = $ObjDrag -> Query($consulta);

	   	$numColumnas=ControlError::existenColumnas($respuesta);
        
        $htmlAuto='';

        if(!__ID__){

        	$numColumnas-=1;

        }

  		foreach ($archivo as $linea => $registro) {

  			$arrayRegistro=explode('	',$registro);

  			if( count( $arrayRegistro ) == $numColumnas ){

  				$arrayRespuesta['validos']++;

  				$arrayRespuesta['html'].='<tr>'.$htmlAuto;

  				foreach ($arrayRegistro as $key => $value) {

  					$arrayRespuesta['html'].='<td>'.$value.'</td>';

  				}

  				$arrayRespuesta['html'].='</tr>';
  			}
  			else{

  				$arrayRespuesta['errores']['cantidad']++;

  				$arrayRespuesta['errores']['lineas'].='L:'.($linea+1).', ';

  			}
		   
		   //var_dump($arrayRegistro);
		   
  		}
  		$arrayRespuesta['html'].='</table></div>';

  		if(!$arrayRespuesta['errores']['cantidad']){
  			$arrayRespuesta['estado']=1;
  		}
  		
  		return json_encode($arrayRespuesta);

	  } catch (Exception $e) {
	  
	    echo $e->getMessage();	
	  
	  }

   }

}



?>