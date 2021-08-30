<div class="card-body bg-dark">
<?php 
require_once ("../../config/db.php");

require_once('../../config/api_mt_include2.php'); 





?>
<?php

$idmk = $_POST['nodo_mk'];
$sql="SELECT * FROM  mikrotik where idmikrotik=$idmk";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
     
                       

$Username =$row['mk_usuario'];
$Pass =$row['mk_password'];
    $mk_puerto = $row['api'];
                        $tipocon = $row['tipocon'];
                        $api=$row['api']; 
                         $ip=$row['ip'];
                        
                        if ($tipocon == 2) {
                          $ipRouteros = "$ip:$api";
                        }else{
                             $ipRouteros = $ip;
                        }
                  




$ping_address = $_POST['ip_cli'];  // ip a pingear que puede venir de un formulario
$ping_count = 10; // cantidad de pings que quiero ejecutar.

	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $mk_puerto)) {
		$rows = array(); $rows2 = array();	
		   $API->write("/ping",false);
		   $API->write("=address=".$ping_address,false);  
		   $API->write("=count=".$ping_count,true);
		   $READ = $API->read(false);
		   $ARRAY = $API->parse_response($READ);
			if(count($ARRAY)>0){
				for($n=0;$n<count($ARRAY);$n++){
					if($ARRAY[$n]["received"]!=$ARRAY[$n]["sent"] || $ARRAY[$n]["status"]=="timeout"){
						echo $ARRAY[$n]["status"]."<BR/>";
					}else{
						echo "Respuesta desde ".$ping_address.": bytes=".$ARRAY[$n]["size"]." tiempo=".$ARRAY[$n]["time"]." TTL=".$ARRAY[$n]["ttl"].".<BR/>";
					}
				}

			}else{  
				echo $ARRAY['!trap'][0]['message'];	 
			} 
	}else{
		echo "<font color='#ff0000'>La conexion ha fallado. Verifique si el Api esta activo.</font>";
	}
	$API->disconnect();
	//$result = array();
	//array_push($result,$rows);
	//array_push($result,$rows2);
	//print json_encode($result, JSON_NUMERIC_CHECK);
	mysqli_close($con);
?>
</div>