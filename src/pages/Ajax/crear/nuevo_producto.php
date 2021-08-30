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
        if (empty($_POST['codigo'])){
            $errors[] = "El Codigo no puedo estar vacio";
        } elseif (empty($_POST['descripcion'])){
            $errors[] = "La descripcion no puede estar vacia";
        
        }  elseif (empty($_POST['precioVenta'])){
            $errors[] = "El precio de venta no puede estar vacio";
        
        } elseif (empty($_POST['precioCompra'])){
            $errors[] = "El precio de compra no puede estar vacio";
        
        } elseif (empty($_POST['existencia'])){
            $errors[] = "La existencia no puede estar vacia";
        
        } elseif (
            !empty($_POST['codigo'])
            && !empty($_POST['descripcion'])
             && !empty($_POST['precioCompra'])
              && !empty($_POST['precioVenta'])
               && !empty($_POST['existencia'])
            
            )
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            
                // escaping, additionally removing everything that could be (html/javascript-) code
                $codigo = mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
                
                $descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));
               
               $preciov=intval($_POST['precioVenta']);
               $precioc=intval($_POST['precioCompra']);
               $existencia=intval($_POST['existencia']);



              
                
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                //$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
                    
                // check if user or email address already exists
                $sql = "SELECT * FROM productos WHERE codigo = '".$codigo."';";
                $query_check_user_name = mysqli_query($con,$sql);
                $query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , este codigo de producto ya está existe.";
                } else {

                $fec = date("Y-m-d H:i:s");
                $iduser = $_SESSION['user_id'];
                $detalle = "agrego el producto $descripcion";


                 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

                    // write new user's data into database
                    $sql = "INSERT INTO productos (codigo, descripcion, precioVenta, precioCompra, existencia)
                            VALUES('".$codigo."','".$descripcion."','".$preciov."','".$precioc."','".$existencia."');";
                    $query_new_user_insert = mysqli_query($con,$sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $messages[] = "Guardado con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }

                    mysqli_close($con);
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