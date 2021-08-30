<?php
include '/var/www/admin/html/config/db.php';

ini_set("max_execution_time", 0);
set_time_limit(0);



$tablas = mysqli_query($con,"SELECT * FROM tmp");

while ($registros = mysqli_fetch_array($tablas)) {
   $fecha = $registros["fecha"];
    $horas = explode(" ", $fecha);
    list($fecha2, $hora) = $horas;
    $dato = $registros["consulta"];


  foreach ( explode( "\n", $dato ) as $line ) {
    if ( trim( $line )) {
        list( $src, $dst, $bytes, $packets ) = explode( ' ', trim( strip_tags( $line )));
		$tbytes = "";
        $descarga = "";
        $subida = "";
        $ips = $src;
        $ipd = $dst;
     if (!empty($ipd) && !empty($ips)) {
            $tabla_ip = mysqli_query($con,"SELECT remoteaddress FROM clientesp where remoteaddress='" . $src . "' limit 1");
            $valips = mysqli_fetch_array($tabla_ip);
            if (!empty($valips["remoteaddress"])) {
                $ips = 1;
            }
            $tabla_pd = mysqli_query($con,"SELECT remoteaddress FROM clientesp where remoteaddress='" . $dst . "' limit 1");
            $valipd = mysqli_fetch_array($tabla_pd);
            if (!empty($valipd["remoteaddress"])) {
                $ipd = 1;
            }
        }
         if ($ips == 1) {
            $tabla_ip = mysqli_query($con,"SELECT remoteaddress FROM clientesp where remoteaddress='" . $src . "' limit 1");
            $valips = mysqli_fetch_array($tabla_ip);
            if (!empty($valips["remoteaddress"])) {
                $ips = 1;
            }
        } else {
            if ($ipd == 1) {
                $tabla_pd =  mysqli_query($con,"SELECT remoteaddress FROM clientesp where remoteaddress='" . $dst . "' limit 1");
                $valipd = mysqli_fetch_array($tabla_pd);
                if (!empty($valipd["remoteaddress"])) {
                    $ipd = 1;
                }
            }
        }
           if ($ipd == 1) {
            $descarga = $bytes;
            $subida = 0;
            $ip = $dst;
            if (!empty($ip)) {
                $insert = mysqli_query($con,"insert into conexiones (src,fecha,ip,hora) values ('" . $src . "','" . $fecha2 . "','" . $ip . "','" . $hora . "')");
            }
        } else {
            if ($ips == 1) {
                $descarga = 0;
                $subida = $bytes;
                $ip = $src;
            }
        }
         if (!empty($ip)) {
         
           
            $insert = mysqli_query($con,"insert into trafico_tmp (ip,descarga,subida,fecha) values ('" . $ip . "','" . $descarga . "','" . $subida . "','" . $fecha . "')");
    
  
        }
       
    }
}


    




}
$db = mysqli_query($con,"TRUNCATE TABLE tmp");
unset($insert);
unset($registros);
unset($db);

?>