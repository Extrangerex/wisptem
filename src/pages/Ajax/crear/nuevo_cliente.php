<?php
date_default_timezone_set("America/Santo_Domingo");
	include('is_logged.php');
	if(empty($_POST['nombre'])){
			$errors[]="Nombre vacío";
		}elseif(empty($_POST['apellido'])){
				$errors[]="apellido vacío";
		}elseif(empty($_POST['cell'])){
			$errors[]="Cell vacío";
		
		}elseif(empty($_POST['fechainicial'])){
			$errors[]="Debes ingresar la fecha de instalacion del cliente";
		}elseif(empty($_POST['fechafinal'])){
			$errors[]="Debes ingresar la fecha de pago del cliente";
		}elseif(empty($_POST['nodo'])){
			$errors[]="Debes elegir un nodo";
		}elseif(empty($_POST['sector'])){
			$errors[]="Debes elegir un sector";
		}elseif(empty($_POST['usuario'])){
			$errors[]="Debes ingresar el Usuario del cliente";
		}elseif(empty($_POST['servicio'])){
			$errors[]="Debes elegir el tipo de servicio";
		}elseif(empty($_POST['router'])){
			$errors[]="Debes elegir a quien pertenece el router";
		}elseif(empty($_POST['tpago'])){
			$errors[]="Debes elegir el modo de pago";
		}elseif(!empty($_POST['usuario'])&&
				!empty($_POST['fechainicial'])&&
				!empty($_POST['nodo'])&&
				!empty($_POST['password'])&&
				!empty($_POST['servicio'])&&
				!empty($_POST['router'])&&
				!empty($_POST['tpago'])&&
				!empty($_POST['fechafinal'])){
		/*ConnectToDatabase*/
		require_once ("../../../config/db.php");

 		require('../../../config/api_mt_include2.php');

 		// check if user or email address already exists
            

		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
		$cell=mysqli_real_escape_string($con,(strip_tags($_POST["cell"],ENT_QUOTES)));
		$cell2=mysqli_real_escape_string($con,(strip_tags($_POST["cell2"],ENT_QUOTES)));
		$documento=mysqli_real_escape_string($con,(strip_tags($_POST["documento"],ENT_QUOTES)));
		$fechainicial=mysqli_real_escape_string($con,(strip_tags($_POST["fechainicial"],ENT_QUOTES)));
		$fechafinal=mysqli_real_escape_string($con,(strip_tags($_POST["fechafinal"],ENT_QUOTES)));
		
		
		$plan=mysqli_real_escape_string($con,(strip_tags($_POST["plan"],ENT_QUOTES)));
		$mac=mysqli_real_escape_string($con,(strip_tags($_POST["mac"],ENT_QUOTES)));
		
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$password=mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));
		$remoteaddress=mysqli_real_escape_string($con,(strip_tags($_POST["remoteaddress"],ENT_QUOTES)));
		
		$poste=mysqli_real_escape_string($con,(strip_tags($_POST["poste"],ENT_QUOTES)));
		$sector=mysqli_real_escape_string($con,(strip_tags($_POST["sector"],ENT_QUOTES)));
		$empleado=mysqli_real_escape_string($con,(strip_tags($_POST["empleado"],ENT_QUOTES)));
		
		$disable="no";
		$comentario=mysqli_real_escape_string($con,(strip_tags($_POST["comentario"],ENT_QUOTES)));
		

		$id=intval($_POST['id']);
		$pago_instalacion=intval($_POST['pago_instalacion']);
		$pago_total=intval($_POST['pago_total']);
		$nodo=intval($_POST['nodo']);
		$tpago=intval($_POST['tpago']);
		$servicio=intval($_POST['servicio']);
		$numpag=intval($_POST['numpag']);
		$router=intval($_POST['router']);
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$financimiento = 'no';
		$date_added=date("Y-m-dH:i:s");

		if ($tpago == 2) {
			$operacion ='+';
		
			 $fechai = $fechafinal;
			 $nuevafecha = strtotime ( $operacion.$numpag.' month' , strtotime ( $fechafinal ) ) ;

			 $fechaf = date('Y-m-d',$nuevafecha);

			
			 $financimiento = 'yes';

			 $ss= "insert into financiamiento(id_cliente,monto,plazo,fecha_inicial,fecha_final) VALUES ($id,$pago_instalacion,$numpag,'$fechai','$fechaf')";
				
			 $insert = mysqli_query($con,$ss);

			}	

		





// check if user or email address already exists
                $sql = "SELECT * FROM clientesp WHERE  id = '" . $id . "' or usuario = '" . $usuario . "';";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
     if ($query_check_user == 1) {
           $errors[] = "Lo sentimos , el ID ó el usuario ya está en uso.";
       } else {

                	$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "agrego el cliente con el usuario $usuario";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
             
          

		

		$sql="INSERT INTO clientesp(id,id_mk,mac,nombres,apellido,documento,cell,cell2,fecha_inicial,fecha_final,plan,pago_total,usuario,password,remoteaddress,poste,sector,id_empleado,pago_instalacion,direcion,comentario,disable,date_added,id_servicio,id_router,id_pago,financiamiento,mora)VALUES($id,$nodo,'$mac','$nombre','$apellido','$documento','$cell','$cell2','$fechainicial','$fechafinal','$plan',$pago_total,'$usuario','$password','$remoteaddress','$poste','$sector',$empleado,$pago_instalacion,'$direccion','$comentario','$disable','$date_added',$servicio,$router,$tpago,'$financiamiento',0)";
		$query_new_insert=mysqli_query($con,$sql);
		if($query_new_insert){
			?>
			<script type="text/javascript">resetform();</script>
			<?php
				
				$messages[]="Cliente ha sido ingresado satisfactoriamente.";
				 $query = mysqli_query($con,$SI);






    $sq="SELECT * FROM  mikrotik where idmikrotik=$nodo";
    $quer = mysqli_query($con, $sq);
    $rows=mysqli_fetch_array($quer);
    
                        $ip=$rows['ip'];
                    
                        $Username = $rows['mk_usuario'];
                        $Pass = $rows['mk_password'];
                        $Port = $rows['api'];

                         $tipocon = $rows['tipocon'];

                         if ($tipocon == 2) {
                         	  $ServerList = "$ip:$Port";
                         }else{
                         	$ServerList = $ip;

                         }
                     



				
				$servicio="pppoe";
				$comment="$nombre $apellido $fechafinal";
				
				$API = new routeros_api();
   		 		$API->debug = false;

   					 if ($API->connect($ServerList , $Username , $Pass, $Port)) {
      			 			$API->write("/ppp/active/getall",false);
       						$API->write('?name='.$usuario,true);      
      			 			$READ = $API->read(false);
      						 $ARRAY = $API->parse_response($READ);
        					if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
  								$API = new routeros_api();
    							$API->debug = false;
								if ($API->connect($ServerList, $Username, $Pass, $Port)) { 
					
										$API->write('/ppp/secret/print
										?name='.($usuario)
										);
										$find = $API->read();
										
										foreach ($find as $find){
											$API->write('/ppp/secret/remove', false); // remove, enable, disable
											$API->write('=.id='.$find['.id']);
											$API->read();
										}


						  			$API->comm("/ppp/secret/add", array(
      								"name"     => $usuario,
      								"password" => $password,
     						 		"comment"  => $comment,
     							 	"caller-id" => $mac,
      								"service"  => $servicio,
	 						 		"profile"  => $plan,
	 						 		"remote-address" => $remoteaddress,
	 						 		
	  
  							 		));



									$API->disconnect();
								}
        					}
						else
							{																																										
			  						$API->comm("/ppp/secret/add", array(																												
     		 						"name"     => $usuario,
     		 						"password" => $password,
     		 						"comment"  => $comment,
     		 						"caller-id" => $mac,
     		 						"service"  => $servicio,
	  		 						"profile"  => $plan,
	 								"remote-address" => $remoteaddress,
	  		 					
   									));
							}
       								$API->disconnect();

       								$sql="delete from remoteaddress where ip='$remoteaddress'";
									$Records = mysqli_query($con,$sql) or die(mysqli_error());

    				}








			}else{
				$errors[]="Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
}
		}else{
			$errors[]="Error desconocido.";
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