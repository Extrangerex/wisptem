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
		  if(empty($_POST['idcliente'])){
            $errors[]="Ingresa el ID del cliente";

        }elseif(empty($_POST['nodoolt'])){
            $errors[]="Debes elegir un nodo";

        }elseif(empty($_POST['onutype'])){
            $errors[]="Debes elegir el tipo de onu";
        }elseif(!empty($_POST['nodoolt'])&&
                !empty($_POST['idcliente'])&&
            
                !empty($_POST['onutype']))
        
{
            require_once ("../../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
            require_once('../../../config/classOLT/OLT.php');

			
			
        $tipoonu=mysqli_real_escape_string($con,(strip_tags($_POST["onutype"],ENT_QUOTES)));
        
        $usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
        $password=mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));
        
    
        $sn=trim(mysqli_real_escape_string($con,(strip_tags($_POST["sn"],ENT_QUOTES))));
    
        $id=intval($_POST['idcliente']);
          $board=intval($_POST['board']);
            $port=intval($_POST['port']);
              $ponidx=intval($_POST['ponidx']);
              
        $nodoolt=intval($_POST['nodoolt']);
    
        $date_added=date("Y-m-dH:i:s");
				
                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
				//$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                // check if user or email address already exists
                $sql = "SELECT * FROM onus_configured WHERE id_cliente = '" . $id . "' or sn = '" . $sn . "';";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                      $errors[] = "Lo sentimos , el ID ó el sn ya está en uso.";
                } else {

				$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "agrego el plan de $plan";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                            $query = mysqli_query($con,$SI);

					// write new user's data into database
                
     $sqlolt = "SELECT * FROM  olts where id=$nodoolt";
    $queryolt = mysqli_query($con, $sqlolt);
    $rowss=mysqli_fetch_array($queryolt);
    
                        $ipolt=$rowss['ip'];
                          $userolt=$rowss['username'];
                            $passolt=$rowss['password'];
                              $portolt=$rowss['telnetport'];
                                $vlan=$rowss['vlan'];


                                  $sqlcliente = "SELECT * FROM  clientesp where id=$id";
    $quercliente = mysqli_query($con, $sqlcliente);
    $rowsc=mysqli_fetch_array($quercliente);
    
                        $nombre=$rowsc['nombres'];
                          $apellido=$rowsc['apellido'];
                            $poste=$rowsc['poste'];
                              $sector=$rowsc['sector'];
                                
 $sqlpon = "INSERT INTO onus_configured (id_cliente, id_olt, board, port, idx, tipo_onu, sn,vlan,fecha) VALUES ($id ,$nodoolt, $board, $port, $ponidx, '$tipoonu', '$sn',$vlan,'$fec')  ";
        $query_newpon=mysqli_query($con,$sqlpon);


            if ($query_newpon){
                    $fecc = date("Y-m-d-H:i:s");
                $names = "$nombre-$apellido";
                $des = "$poste-$sector-Authdate-$fecc";
            $olt = new \OLT\olt();
            $result = $olt->fijarpon($ipolt, $userolt, $passolt,$portolt, $board, $port, $ponidx, $sn,$tipoonu,$usuario,$password,$vlan,$names,$des);
                        $messages[] = "Guardado con éxito.";

                            ?>
            <script type="text/javascript">resetform();
               $('#newclientepon').modal('hide');
        </script>
            <?php
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