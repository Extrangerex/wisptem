<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    
}		
		if (empty($_POST['api'])){
			$errors[] = "Digite un api key";
		} elseif (empty($_POST['numero'])){
			$errors[] = "Ingrese un numero de whatsapp";
		
		
        } elseif (
			!empty($_POST['api'])
			&& !empty($_POST['numero'])
			
			)
        
{
            require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $api = mysqli_real_escape_string($con,(strip_tags($_POST["api"],ENT_QUOTES)));
                
			

			$numero = intval($_POST['numero']);
				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
                $sql = "SELECT * FROM sms_gateway";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {

                	

                		$sql = "update sms_gateway set api='".$api."',numero='".$numero."' where id = 1";

                		$update = mysqli_query($con,$sql);
                		if ($update) {
                        $messages[] = "El gateway ha sido actualizado con éxito.";
                    	} 
                    	 else {
                        $errors[] = "Lo sentimos , la actualizacion falló. Por favor, regrese y vuelva a intentarlo.";
                   		 }


                   
                } else {




					// write new user's data into database
                    $sql = "INSERT INTO sms_gateway (api,numero)
                            VALUES('".$api."',".$numero.");";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "La gateway ha sido creado con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo 2.";
                    }
                }
            
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