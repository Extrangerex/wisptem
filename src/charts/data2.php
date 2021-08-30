<?php
////////////////////////////////////////////////////////////////////
// ESTE EJEMPLO SE DESCARGO DE www.tech-nico.com ///////////////////
// Creado por: Nicolas Daitsch. Guatrache. La Pampa ////////////////
// Contacto: administracion@tech-nico.com //////////////////////////
// RouterOS API: Grafica en tiempo real usando highcharts //////////
//////////////////////////////////////////////////////////////////// ?>
<?php 
require_once('api_mt_include2.php');
include '../config/db.php';


$id = $_GET["id"]; 
 $sql="SELECT * FROM  mikrotik where idmikrotik=$id";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
$ip = $row['ip'];
$Username=$row['mk_usuario'];
$Pass=$row['mk_password'];
$api_puerto=8728;
$tipocon = $row['tipocon'];
$api = $row['api'];

     if ($tipocon == 2) {
          $ipRouteros = "$ip:$api";
      }else{
          $ipRouteros = $ip;
      }



$interface = $_GET["interface"]; 

	$API = new routeros_api();
	$API->debug = false;
	if ($API->connect($ipRouteros , $Username , $Pass, $api_puerto)) {
		$rows = array(); $rows2 = array();	
		   $API->write("/interface/monitor-traffic",false);
		   $API->write("=interface=".$interface,false);  
		   $API->write("=once=",true);
		   $READ = $API->read(false);
		   $ARRAY = $API->parse_response($READ);
			if(count($ARRAY)>0){  
				$rx = number_format($ARRAY[0]["rx-bits-per-second"]/1024,1);
				$tx = number_format($ARRAY[0]["tx-bits-per-second"]/1024,1);
				$rows['name'] = 'Tx';
				$rows['data'][] = $tx;
				$rows2['name'] = 'Rx';
				$rows2['data'][] = $rx;
			}else{  
				echo $ARRAY['!trap'][0]['message'];	 
			} 
	}else{
		echo "<font color='#ff0000'>La conexion ha fallado. Verifique si el Api esta activo.</font>";
	}
	$API->disconnect();

	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	print json_encode($result, JSON_NUMERIC_CHECK);

	mysqli_close($con);

?>
