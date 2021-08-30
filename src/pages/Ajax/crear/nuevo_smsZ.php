<?php
require_once ("../../../config/db.php");
require_once ("../../../config/functions.php");



$res = mysqli_query($con,"select * from sms_gateway where id=1");
$gateway = mysqli_fetch_array($res);
$api = $gateway['api'];
$numero= $gateway['numero'];

date_default_timezone_set("America/Santo_Domingo");
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
	if (empty($_POST['sector'])){
			$errors[] = "Debes seleccionar el sector";
		} elseif (empty($_POST['mensajeZ'])){
			$errors[] = "No se permite enviar mensaje vacio";
        } elseif (
			!empty($_POST['sector'])
			&& !empty($_POST['mensajeZ'])
			
			)
{
           
		$sector = mysqli_real_escape_string($con,(strip_tags($_POST["sector"],ENT_QUOTES)));
		$mensaje = mysqli_real_escape_string($con,(strip_tags($_POST["mensajeZ"],ENT_QUOTES)));
		

		

				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
           
				
				$fec = date("Y-m-d H:i:s");

			/*	if ($estado == 'todo' && $nodo == 'todo') {
					$cmd = "select * from clientesp";
				}elseif ($estado == 'todo' && $nodo != 'todo'){
					$cmd = "select * from clientesp where nodo='$nodo'";
				}elseif ($nodo == 'todo' && $estado != 'todo'){
					$cmd = "select * from clientesp where disable='$estado'";
				}elseif ($nodo != 'todo' && $estado != 'todo'){
					$cmd = "select * from clientesp where disable='$estado' and nodo=$nodo";

				}*/
				
				$cmd = "select * from clientesp where sector='$sector'";

			

define('WB_TOKEN', $api);
define('WB_FROM',$numero);



function sendMessage ($to, $msg) {


    $to =  filter_var($to, FILTER_SANITIZE_NUMBER_INT);
    if (empty($to)) return false;
    $msg = urlencode($msg);
    $custom_uid = "msg-" . time() ;
    $url = "https://www.waboxapp.com/api/send/chat?token=" . WB_TOKEN . "&uid=" . WB_FROM . "&custom_uid=". $custom_uid ."&to=" . $to ."&text=" .$msg;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    if ($result) {
        return json_decode($result);
    }
    return false;

}
            	$result = mysqli_query($con,$cmd);

            	while ($row = mysqli_fetch_array($result)) {

            		$id_message = "msg-" . time();
            		$cell = limpiar_numero($row['cell']);
            		$cel ="1$cell";
            		$idcliente = $row['id'];

            		
            		$resul = sendMessage($cel,$mensaje);
					print_r($resul);
            		

            	  	$sql = "INSERT INTO mensajes (id_mensaje,id_cliente,fecha,mensaje)  VALUES('".$id_message."',".$idcliente.",'".$fec."','".$mensaje."');";

            	  

            	  	

              		$insert = mysqli_query($con,$sql);
              		
            	}




	mysqli_close($con);						
			


                
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
		  if (isset($errors)){
            
            
                        foreach ($errors as $error) {


                                echo '<script>msgbox("danger","'.$error.'",3);</script>';

                            }
                       
            }
            if (isset($messages)){
                
                
                            foreach ($messages as $message) {
                                    
                                echo '<script>msgbox("success","'.$message.'",3);</script>';
                                }
                          

                
            }
            mysqli_close($con);

?>