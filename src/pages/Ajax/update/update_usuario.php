<?php
include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
  
}       
        if (empty($_POST['mod_nombre'])){
            $errors[] = "Nombres vacíos";
        } elseif (empty($_POST['mod_apellido'])){
            $errors[] = "Apellidos vacíos";
        }  elseif (empty($_POST['mod_usuario'])) {
            $errors[] = "Nombre de usuario vacío";
             } elseif (empty($_POST['mod_cell'])){
            $errors[] = "Debe ingresar un numero de celular";
        } elseif (empty($_POST['mod_cargo'])){
            $errors[] = "Debe ingresar el cargo del empleado";
        }  elseif (strlen($_POST['mod_usuario']) > 64 || strlen($_POST['mod_usuario']) < 2) {
            $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['mod_usuario'])) {
            $errors[] = "Nombre de usuario no encaja en el esquema de nombre: Sólo aZ y los números están permitidos , de 2 a 64 caracteres";
        } elseif (empty($_POST['mod_correo'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (empty($_POST['mod_nivel'])) {
            $errors[] = "El nivel de seguridad no puede estar vacio";
        } elseif (strlen($_POST['mod_correo']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['mod_correo'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
            !empty($_POST['mod_usuario'])
            && !empty($_POST['mod_nombre'])
            && !empty($_POST['mod_apellido'])
            && strlen($_POST['mod_usuario']) <= 64
            && strlen($_POST['mod_usuario']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['mod_usuario'])
            && !empty($_POST['mod_correo'])
            && strlen($_POST['mod_correo']) <= 64
            && filter_var($_POST['mod_correo'], FILTER_VALIDATE_EMAIL)
          )
         {
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

            
                // escaping, additionally removing everything that could be (html/javascript-) code
                $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
                $apellido = mysqli_real_escape_string($con,(strip_tags($_POST["mod_apellido"],ENT_QUOTES)));
                $usuario = mysqli_real_escape_string($con,(strip_tags($_POST["mod_usuario"],ENT_QUOTES)));
                $correo = mysqli_real_escape_string($con,(strip_tags($_POST["mod_correo"],ENT_QUOTES)));
                $cargo = mysqli_real_escape_string($con,(strip_tags($_POST["mod_cargo"],ENT_QUOTES)));

                $estado = mysqli_real_escape_string($con,(strip_tags($_POST["mod_estado"],ENT_QUOTES)));

                $cel = mysqli_real_escape_string($con,(strip_tags($_POST["mod_cell"],ENT_QUOTES)));
                $mchk_act = mysqli_real_escape_string($con,(strip_tags($_POST["mchk_act"],ENT_QUOTES)));
                $mchk_fec = mysqli_real_escape_string($con,(strip_tags($_POST["mchk_fec"],ENT_QUOTES)));
                $mchk_plan = mysqli_real_escape_string($con,(strip_tags($_POST["mchk_plan"],ENT_QUOTES)));
                $mchk_mac= mysqli_real_escape_string($con,(strip_tags($_POST["mchk_mac"],ENT_QUOTES)));

                
                $nivel = intval($_POST['mod_nivel']);
               
             
                $user_id=intval($_POST['mod_id']);
                    
              
               

               
                    // write new user's data into database
                    $sql = "UPDATE users SET firstname='".$nombre."',chk_act='".$mchk_act."',chk_fec='".$mchk_fec."',chk_plan='".$mchk_plan."',chk_mac='".$mchk_mac."', lastname='".$apellido."', user_name='".$usuario."', user_email='".$correo."', nivel='".$nivel."',cargo='".$cargo."',cell='".$cel."',estado='".$estado."'
                            WHERE user_id='".$user_id."';";
                    $query_update = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_update) {
                        $messages[] = "La cuenta ha sido modificada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
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