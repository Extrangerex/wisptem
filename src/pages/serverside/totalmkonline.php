
<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");
require('../../config/api_mt_include2.php');

$sql   = "SELECT * FROM  mikrotik";
$query = mysqli_query($con, $sql);
$total = 0;
while ($row = mysqli_fetch_array($query)) {
    $nodo = $row['nodo'];
    $ip   = $row['ip'];
    $api  = $row['api'];
    
    $mk_usuario  = $row['mk_usuario'];
    $mk_password = $row['mk_password'];
    $mk_puerto   = $row['api'];
    $tipocon     = $row['tipocon'];
    
    if ($tipocon == 2) {
        $mk_ip = "$ip:$api";
    } else {
        $mk_ip = $ip;
    }
    $API        = new routeros_api();
    $API->debug = false;
    $API - $API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
    $API->write("/ppp/active/getall", true);
    $READ  = $API->read(false);
    $ARRAY = $API->parse_response($READ);
    if (count($ARRAY) > 0) { // si hay mas de 1 queue.
        for ($x = 0; $x < count($ARRAY); $x++) {
            $total = $total + 1;
        }
    }
    $API->disconnect();
    
}
echo $total;
mysqli_close($con);

?>