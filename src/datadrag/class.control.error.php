<?php 

class ControlError{

	public static function existenTablas($respuesta){
		if(!$respuesta->rowCounT()){
			 throw new Exception(' - La base de datos no tiene tablas en las que se pueda trabajar. - ');
		}
	}
	public static function existenColumnas($respuesta){
		$numero = $respuesta->columnCount();
		if(!$numero){
			throw new Exception(' - La tabla no cuenta con columnas para trabajar - ');
		}
		else{
		    return $numero;
		}
	}
	public static function verificaTabla($string=0){	
		if(!$string){
			throw new Exception(' - No se ha obtenido nombre de tabla para consultar - ');
		}
		else{
			return $string;
		}
	}
	public static function recibirArchivo($archivo){
	   	if(!is_file($archivo)){
	   		throw new Exception(' - No se encuentra el archivo en la ruta = '.$archivo.' - ');
	   	}
	   	else{
	   		return file($archivo);
	   	}
	}
}

?>