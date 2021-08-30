<?php
require_once ("../../../config/db.php");

require '../../../sms/autoload.php';
$res = mysqli_query($con,"select * from sms_gateway where id=1");
$gateway = mysqli_fetch_array($res);
$apikey = $gateway['apikey'];
$idcell= $gateway['idcell'];

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;



$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', $apikey);









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
	if (empty($_POST['cliente'])){
			$errors[] = "Debes seleccionar un cliente";
		} elseif (empty($_POST['numero'])){
			$errors[] = "Debes ingresar un numero ";
		} elseif (empty($_POST['mensaje'])){
			$errors[] = "No se permite enviar mensaje vacio";
        } elseif (
			!empty($_POST['cliente'])
			&& !empty($_POST['numero'])
			&& !empty($_POST['mensaje'])
			)
{
           
		$cliente = mysqli_real_escape_string($con,(strip_tags($_POST["cliente"],ENT_QUOTES)));
		$mensaje = mysqli_real_escape_string($con,(strip_tags($_POST["mensaje"],ENT_QUOTES)));
		$cell = mysqli_real_escape_string($con,(strip_tags($_POST["numero"],ENT_QUOTES)));
		 $idcliente = intval($_POST['idcli']);

		

				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
           
				
				$fec = date("Y-m-d H:i:s");

				
				
				
				
            

            		$apiClient = new ApiClient($config);
					$messageClient = new MessageApi($apiClient);


            	
					            		$sendMessageRequest = new SendMessageRequest([
					    'phoneNumber' => $cell,
					    'message' => $mensaje,
					    'deviceId' => $idcell
					]);

					$sendMessages = $messageClient->sendMessages([
					    $sendMessageRequest
					]);
					$id_message = $sendMessages[0]["id"];

            	  	$sql = "INSERT INTO mensajes (id_mensaje,id_cliente,fecha,mensaje,numero)  VALUES(".$id_message.",".$idcliente.",'".$fec."','".$mensaje."','".$cell."');";

            	  

            	  	

              		$insert = mysqli_query($con,$sql);
              		



							
			


                
            
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