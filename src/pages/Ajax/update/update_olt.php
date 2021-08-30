<?php
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
		if (empty($_POST['mnodo'])){
			$errors[] = "Ingresa nodo de la olt";
		} elseif (empty($_POST['mname'])){
			$errors[] = "Debes ingresar el nombre de la olt";
		} elseif (empty($_POST['molt_ip'])){
			$errors[] = "Debes ingresar una direccion IP o dns de la olt";
		} elseif (empty($_POST['molt_user'])){
			$errors[] = "Debes ingresar el usuario de la olt";
		} elseif (empty($_POST['mtelnet_port'])){
			$errors[] = "Debes elegir el puerto telnet de la olt";
		} elseif (empty($_POST['molt_password'])){
			$errors[] = "Debes ingresar la contraseña de la olt";
		} elseif (empty($_POST['molt_hardware_version'])){
			$errors[] = "Debes elegir olt hardware version";
		
        } elseif (
			!empty($_POST['mnodo'])
			&& !empty($_POST['mname'])
			&& !empty($_POST['molt_ip'])
			&& !empty($_POST['molt_user'])
			&& !empty($_POST['mtelnet_port'])
			&& !empty($_POST['molt_password'])
			&& !empty($_POST['molt_hardware_version'])
			)
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			$nodo = mysqli_real_escape_string($con,(strip_tags($_POST["mnodo"],ENT_QUOTES)));
		$modelo = mysqli_real_escape_string($con,(strip_tags($_POST["mname"],ENT_QUOTES)));
		$ip = mysqli_real_escape_string($con,(strip_tags($_POST["molt_ip"],ENT_QUOTES)));
		$usuario = mysqli_real_escape_string($con,(strip_tags($_POST["molt_user"],ENT_QUOTES)));
		$password = mysqli_real_escape_string($con,(strip_tags($_POST["molt_password"],ENT_QUOTES)));
		$hw = mysqli_real_escape_string($con,(strip_tags($_POST["molt_hardware_version"],ENT_QUOTES)));
		

		$puerto = intval($_POST["mtelnet_port"]);
			$id = intval($_POST["mod_id"]);
			

				
				
				
				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "Actualizó el Nodo de $nodo";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

					// write new user's data into database
 				

 					  $sql = "UPDATE olts SET  nodo='".$nodo."',name='".$modelo."', ip='".$ip."', username='".$usuario."', password='".$password."', telnetport='".$puerto."', hwversion='".$hw."' WHERE id='".$id."';";

							
                     $query_update = mysqli_query($con,$sql);
                   

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "El router ha sido modificado con éxito.....";
                    } else {
                        $errors[] = "Lo sentimos , la actualización falló. Por favor, regrese y vuelva a intentarlo.";
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