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
		if (empty($_POST['nodomk'])){
			$errors[] = "Ingresa nodo del mikrotik";
		} elseif (empty($_POST['modelomk'])){
			$errors[] = "Debes ingresar el modelo del mikrotik";
		} elseif (empty($_POST['ipmk'])){
			$errors[] = "Debes ingresar una direccion IP o dns del mikrotik";
		} elseif (empty($_POST['usuariomk'])){
			$errors[] = "Debes elegir el tipo de conexion del mikrotik";
		} elseif (empty($_POST['tipocon'])){
			$errors[] = "Debes elegir el tipo de conexion del mikrotik";
		} elseif (empty($_POST['passwordmk'])){
			$errors[] = "Debes ingresar la contraseña del mikrotik";
		} elseif (empty($_POST['interfacemk'])){
			$errors[] = "Debes ingresar el interface Wan del mikrotik";
		} elseif (empty($_POST['api'])){
			$errors[] = "Debes ingresar el puerto del Api";
		} elseif (empty($_POST['puertoweb'])){
			$errors[] = "Debes ingresar el puerto web";
        } elseif (
			!empty($_POST['nodomk'])
			&& !empty($_POST['ipmk'])
			&& !empty($_POST['usuariomk'])
			&& !empty($_POST['passwordmk'])
			&& !empty($_POST['interfacemk'])
			&& !empty($_POST['puertoweb'])
			&& !empty($_POST['api'])
			)
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			
		$nodo = mysqli_real_escape_string($con,(strip_tags($_POST["nodomk"],ENT_QUOTES)));
		$modelo = mysqli_real_escape_string($con,(strip_tags($_POST["modelomk"],ENT_QUOTES)));
		$ip = mysqli_real_escape_string($con,(strip_tags($_POST["ipmk"],ENT_QUOTES)));
		$usuario = mysqli_real_escape_string($con,(strip_tags($_POST["usuariomk"],ENT_QUOTES)));
		$password = mysqli_real_escape_string($con,(strip_tags($_POST["passwordmk"],ENT_QUOTES)));
		$interface = mysqli_real_escape_string($con,(strip_tags($_POST["interfacemk"],ENT_QUOTES)));
		

		$puerto = intval($_POST["puertoweb"]);
			$api = intval($_POST["api"]);
		$tipocon = intval($_POST["tipocon"]);

				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
             $ssl = "select * from mikrotik where ip='$ip'";
				$resultado = mysqli_query($con,$ssl);
				$numrow =  mysqli_num_rows($resultado);
				if ($numrow == 1 ) {
					$errors[] = "Lo sentimos , ese nodo ya existe.";
	
                } else {

				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "agregó el Nodo de $nodo";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

					// write new user's data into database
 $sql = "INSERT INTO mikrotik (nodo,modelo,ip,mk_usuario,mk_password,interface,puertoweb,api,tipocon) VALUES('$nodo','$modelo','$ip','$usuario','$password','$interface',$puerto,$api,$tipocon)";

							
			


                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "La cuenta ha sido creada con éxito.";
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