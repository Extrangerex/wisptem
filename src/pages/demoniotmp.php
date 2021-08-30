<?php
include '/var/www/admin/html/config/db.php';

ini_set("max_execution_time", 0);
set_time_limit(0);

sleep(30);

$fecha_actual = date("Y-m-d");


$tablas = mysqli_query($con,"select id,remoteaddress from clientesp where disable='no'");

while ($registros = mysqli_fetch_array($tablas)) {
    $cliente = $registros["id"];
   
   $ips = $registros["remoteaddress"];
       $ip = explode(",", $ips);
       	

    $tabla_trafico = mysqli_query($con, "SELECT * FROM trafico where cliente='" . $cliente . "' and fecha='" . $fecha_actual . "' limit 1");


    $trafi = mysqli_fetch_array($tabla_trafico);

    $descarga = "0";
    $subida = "0";

    for ($i = 0; $i < count($ip); $i++) {
    
    	
        $conntrafico = mysqli_query($con,"SELECT COALESCE(sum(descarga),0) as descarga,COALESCE(sum(subida),0) as subida from trafico_tmp where fecha LIKE '" . $fecha_actual . "%' and ip='" . $ip[$i] . "'");
        $datatrafico = mysqli_fetch_array($conntrafico);
        $descarga += $datatrafico["descarga"];
        $subida += $datatrafico["subida"];





    }
    if (empty($trafi["id"])) {
        $db = mysqli_query($con,"insert into trafico (cliente,fecha,bytes) values ('" . $cliente . "','" . $fecha_actual . "','0/0')");
     

       
    } else {
    	 if (!empty($trafi["id"])) {
       
            $bytes = explode("/", $trafi["bytes"]);
            $subida += $bytes[0];
            $descarga += $bytes[1];
            $tbytes = $subida . "/" . $descarga;
             
           
             
               

                $db = mysqli_query($con,"UPDATE trafico SET bytes='" . $tbytes . "',time='" . date("Y-m-d H:i:s") . "' Where id='" . $trafi["id"] . "'");
           
               
            
      }
    }
    
}
$db = mysqli_query($con,"TRUNCATE TABLE trafico_tmp");
//unset($registros);
//unset($registros2);
//unset($db);


?>