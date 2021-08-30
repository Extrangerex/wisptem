<?php
date_default_timezone_set("America/Santo_Domingo");
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['name'])){
			$errors[] = "Onu type Vacio";
		} elseif (
			!empty($_POST['name'])
			
			)
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $name = mysqli_real_escape_string($con,(strip_tags($_POST["name"],ENT_QUOTES)));
				$capability = mysqli_real_escape_string($con,(strip_tags($_POST["capability"],ENT_QUOTES)));
                    $pon_type = mysqli_real_escape_string($con,(strip_tags($_POST["pon_type"],ENT_QUOTES)));
                     $catv = mysqli_real_escape_string($con,(strip_tags($_POST["catv"],ENT_QUOTES)));
                
				

                $network_ports = intval($_POST["network_ports"]);
                 $network_ports = intval($_POST["network_ports"]);
                  $wifi_ports = intval($_POST["wifi_ports"]);
                    $voip_ports = intval($_POST["voip_ports"]);
                      $wifi_ports = intval($_POST["wifi_ports"]);


				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
                $sql = "SELECT * FROM planes WHERE valor = '".$plan."'";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , este plan ya está agregado.";
                } else {

				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "agrego el plan de $plan";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

					// write new user's data into database
                    $sql = "INSERT INTO planes (nombre, plan, precio)
                            VALUES('".$nombre."','".$plan."','".$precio."');";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "Guardado con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
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