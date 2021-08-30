<?php
date_default_timezone_set("America/Santo_Domingo");
	include('is_logged.php');//ArchivoverificaqueelusarioqueintentaaccederalaURLestalogueado
	/*Iniciavalidaciondelladodelservidor*/
	if(empty($_POST['nombre'])){
			$errors[]="Nombrevacío";
		}elseif(empty($_POST['apellido'])){
				$errors[]="apellido vacío";
		}elseif(empty($_POST['cell'])){
			$errors[]="Cell vacío";
		
		}elseif(empty($_POST['fechainicial'])){
			$errors[]="Debes ingresar la fecha de instalacion del cliente";
		}elseif(empty($_POST['fechafinal'])){
			$errors[]="Debes ingresar la fechadepago del cliente";
		}elseif(empty($_POST['usuario'])){
			$errors[]="Debes ingresar el Usuario del cliente";
		}elseif(!empty($_POST['usuario'])&&
				!empty($_POST['fechainicial'])&&
				!empty($_POST['fechafinal'])){
		/*ConnectToDatabase*/
		require_once ("../../config/db.php");
		require('../../config/routeros_api.class.php');
 		require('../../config/api_mt_include2.php');

 		// check if user or email address already exists
            

		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
		$cell=mysqli_real_escape_string($con,(strip_tags($_POST["cell"],ENT_QUOTES)));
		$cell2=mysqli_real_escape_string($con,(strip_tags($_POST["cell2"],ENT_QUOTES)));
		$documento=mysqli_real_escape_string($con,(strip_tags($_POST["documento"],ENT_QUOTES)));
		$fechainicial=mysqli_real_escape_string($con,(strip_tags($_POST["fechainicial"],ENT_QUOTES)));
		$fechafinal=mysqli_real_escape_string($con,(strip_tags($_POST["fechafinal"],ENT_QUOTES)));
		
		
		$plan=mysqli_real_escape_string($con,(strip_tags($_POST["plan"],ENT_QUOTES)));
		
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$password=mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)));
		$remoteaddress=mysqli_real_escape_string($con,(strip_tags($_POST["remoteaddress"],ENT_QUOTES)));
		
		$poste=mysqli_real_escape_string($con,(strip_tags($_POST["poste"],ENT_QUOTES)));
		$sector=mysqli_real_escape_string($con,(strip_tags($_POST["sector"],ENT_QUOTES)));
		$empleado=mysqli_real_escape_string($con,(strip_tags($_POST["empleado"],ENT_QUOTES)));
		
		$disable="no";
		$comentario=mysqli_real_escape_string($con,(strip_tags($_POST["comentario"],ENT_QUOTES)));
		

		$id=intval($_POST['id']);
		$dias_p = intval($_POST['dias_p']);
		$pago_instalacion=intval($_POST['pago_instalacion']);
		$pago_total=intval($_POST['pago_total']);
		$direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		
		$date_added=date("Y-m-d H:i:s");
// check if user or email address already exists
                $sql = "SELECT * FROM clientesp WHERE id = '" . $id . "' OR usuario = '" . $usuario . "';";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
     if ($query_check_user == 1) {
           $errors[] = "Lo sentimos , el ID ó el usuario ya está en uso.";
       } else 

                	$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "agrego el cliente con el usuario $usuario";


				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                           
{		

		$sql="INSERT INTO clientesp(id,nombres,apellido,documento,cell,cell2,fecha_inicial,fecha_final,plan,dias_p,pago_total,usuario,password,remoteaddress,poste,sector,id_empleado,pago_instalacion,direcion,comentario,disable,date_added)VALUES($id,'$nombre','$apellido','$documento','$cell','$cell2','$fechainicial','$fechafinal','$plan',$dias_p,$pago_total,'$usuario','$password','$remoteaddress','$poste','$sector',$empleado,$pago_instalacion,'$direccion','$comentario','$disable','$date_added')";
		$query_new_insert=mysqli_query($con,$sql);
		if($query_new_insert){
				$messages[]="Cliente ha sido ingresado satisfactoriamente.";
				 $query = mysqli_query($con,$SI);

				$ServerList=mikrotik_ip;   
				$Username=mikrotik_usuario; 
				$Pass=mikrotik_contrasena; 
				$Port=mikrotik_puerto; 

				$servicio="pppoe";
				$comment="$nombre $apellido $fechafinal";
				
				$API = new routeros_api();
   		 		$API->debug = false;

   					 if ($API->connect($ServerList , $Username , $Pass, $Port)) {
      			 			$API->write("/ppp/active/getall",false);
       						$API->write('?name='.$name,true);      
      			 			$READ = $API->read(false);
      						 $ARRAY = $API->parse_response($READ);
        					if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
  								$API = new routeros_api();
    							$API->debug = false;
								if ($API->connect($ServerList, $Username, $Pass, $Port)) { 
					
										$API->write('/ppp/secret/print
										?name='.($name)
										);
										$find = $API->read();
										
										foreach ($find as $find){
											$API->write('/ppp/secret/remove', false); // remove, enable, disable
											$API->write('=.id='.$find['.id']);
											$API->read();
										}


						  			$API->comm("/ppp/secret/add", array(
      								"name"     => $name,
      								"password" => $pas,
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
	
		
		if(isset($errors)){
			
			?>
			<div class="alert alert-danger"role="alert">
				<button type="button"class="close"data-dismiss="alert">&times;</button>
					<strong>Error!</strong>
					<?php
						foreach($errors as $error){
								echo $error;
							}
						?>
			</div>
			<?php
		}
			if(isset($messages)){
				
				?>
				<div class="alert alert-success"role="alert">
						<button type="button"class="close"data-dismiss="alert">&times;</button>
						<strong>¡Bienhecho!</strong>
						<?php
							foreach($messages as $message){
									echo $message;
								}
							?>
				</div>
				<?php
			}


?>