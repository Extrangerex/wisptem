<?php
include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../../../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['nombre'])){
			$errors[] = "Debe ingresar un nombre";
		} elseif (empty($_POST['apellido'])){
			$errors[] = "Debe ingresar un apellido";
        } elseif (empty($_POST['cell'])){
            $errors[] = "Debe ingresar un numero de celular";
        } elseif (empty($_POST['cargo'])){
            $errors[] = "Debe ingresar el cargo del empleado";
            } elseif (empty($_POST['correo'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['correo']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        }  elseif (empty($_POST['usuario'])) {
            $errors[] = "Nombre de usuario no puede estar vacío";
       
        
        } elseif (empty($_POST['password']) || empty($_POST['password-repeat'])) {
            $errors[] = "Contraseña vacía";
        } elseif (empty($_POST['nivel'])){
            $errors[] = "Debe indicar que nivel de seguridad tendra el empleado";
        } elseif ($_POST['password'] !== $_POST['password-repeat']) {
            $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";

        } elseif (strlen($_POST['password']) < 6) {
            $errors[] = "La contraseña debe tener como mínimo 6 caracteres";

        
        } elseif (strlen($_POST['usuario']) > 64 || strlen($_POST['usuario']) < 2) {
            $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['usuario'])) {
            $errors[] = "Nombre de usuario no encaja en el esquema de nombre: Sólo aZ y los números están permitidos , de 2 a 64 caracteres";
        
        } elseif (
			!empty($_POST['usuario'])
			&& !empty($_POST['nombre'])
			&& !empty($_POST['apellido'])
            && strlen($_POST['usuario']) <= 64
            && strlen($_POST['usuario']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['usuario'])
            && !empty($_POST['correo'])
            && strlen($_POST['correo']) <= 64
            && filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['password'])
            && !empty($_POST['password-repeat'])
            && ($_POST['password'] === $_POST['password-repeat'])
        ) {
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

			
				// escaping, additionally removing everything that could be (html/javascript-) code
                $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
				$apellido = mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
				$usuario = mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
                $correo = mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));
                $cargo = mysqli_real_escape_string($con,(strip_tags($_POST["cargo"],ENT_QUOTES)));

                $password = mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));

                $cel = mysqli_real_escape_string($con,(strip_tags($_POST["cell"],ENT_QUOTES)));
				
                $nivel = intval($_POST['nivel']);
                $chk_act = mysqli_real_escape_string($con,(strip_tags($_POST["chk_act"],ENT_QUOTES)));
                $chk_fec =mysqli_real_escape_string($con,(strip_tags($_POST["chk_fec"],ENT_QUOTES)));
                $chk_plan = mysqli_real_escape_string($con,(strip_tags($_POST["chk_plan"],ENT_QUOTES)));
                 $chk_mac = mysqli_real_escape_string($con,(strip_tags($_POST["chk_mac"],ENT_QUOTES)));
                $estado = "si";

				$date_added=date("Y-m-d H:i:s");
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				$user_password_hash = password_hash($password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
                $sql = "SELECT * FROM users WHERE user_name = '" . $usuario . "' OR user_email = '" . $correo . "';";
                $query_check_usuario = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_usuario);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , el nombre de usuario ó la dirección de correo electrónico ya está en uso.";
                } else {
					// write new user's data into database
                 $sql = "INSERT INTO users (firstname, lastname,cargo,cell, user_name, user_password_hash, user_email, date_added, nivel,estado,chk_act,chk_fec,chk_plan,chk_mac)
                         VALUES('".$nombre."','".$apellido."','".$cargo."','".$cel."','" . $usuario . "', '" . $user_password_hash . "', '" . $correo . "','".$date_added."','".$nivel."','".$estado."','".$chk_act."','".$chk_fec."','".$chk_plan."','".$chk_mac."');";
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