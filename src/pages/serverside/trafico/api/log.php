<?php 
////////////////////////////////////////////////////////////////////
// ESTE EJEMPLO SE DESCARGO DE www.tech-nico.com ///////////////////
// Creado por: Nicolas Daitsch. Guatrache. La Pampa ////////////////
// Contacto: administracion@tech-nico.com //////////////////////////
// RouterOS API: Busco Usuario PPPoE activo y muestro Graph o Log //
////////////////////////////////////////////////////////////////////

session_start(); 
require_once('api_mt_include2.php');

$Server =$_SESSION['api_ip'];
$Username =$_SESSION['api_user'];
$Pass =$_SESSION['api_pass'];
$Port =$_SESSION['api_port'];

function ValidChar($cadena){// valida usuario pppoe
	if (preg_match("/([0-9a-zA-Z\@.]){1,36}$/", $cadena,$resultado)){
		return true;
	}else{
		return false;
	}
}

function searchString($texto,$cadena){
	if (preg_match("/".$cadena."/", $texto)){
		return true;
	}else{
		return false;
	}
}

function highlight($texto,$cadena){ //[A-G0-9 :]{18}  MAC
	$texto = preg_replace('#('.$cadena.')#', " <span style=\"color: #FF0000; background-color: #fff;\">$1</span> ", $texto);   
   return $texto;
}

$message = "";
if (ValidChar($_GET['name'])==1) {
	$message = $_GET['name'];
}

$API = new routeros_api();
$API->debug = false;
if ($API->connect($Server , $Username, $Pass, $Port)) {
   $API->write("/log/getall");
	$API->write('/cancel',false);
   $READ = $API->read(false);
   $ARRAY = $API->parse_response($READ);
   //print_r($ARRAY);
   echo "<br />";
   $paso = 0;
	if(count($ARRAY)>0){
		for($x=0;$x<=count($ARRAY);$x++){ //Clasifico errores del Log.
			if (preg_match("/".$message."/i", $ARRAY[$x]["message"])) {
				if(searchString($ARRAY[$x]["message"],"authentication failed")){
					echo "<div><strong>".$ARRAY[$x]["time"]. "</strong>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;" . 
					highlight($ARRAY[$x]["message"],"authentication failed")."</div>";		
				}elseif (searchString($ARRAY[$x]["message"],"called from")){
					echo "<div><strong>".$ARRAY[$x]["time"]. "</strong>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;" . 
					highlight(substr($ARRAY[$x]["message"],0,76),"called from")."...<span>&nbsp;<a href=\"javascript:void(0);\" onclick=\"sacarMac(usuario);\">reparar</a></span></div>";				
				}else{
					echo "<div><strong>".$ARRAY[$x]["time"]. "</strong>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp; <span style=\"color:#666;\">" . 
					$ARRAY[$x]["message"]."</span></div>";
				}
				$paso = 1;
			}else{
				//echo "No se encontró ninguna coincidencia.";
			}
		}
	    if($paso==0){
			echo "No hay datos en el log. (El servidor registra solo algunas horas de historial).";
		}	
	}else{  //el usuario esta of line
		echo "Ocurrio un error al conectar con el servidor, Intentelo de nuevo.";
	} 
   $API->disconnect();
}
?>