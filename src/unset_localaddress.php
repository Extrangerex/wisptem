<?php
require_once("config/db.php");
require('config/routeros_api.class.php');
require('config/api_mt_include2.php');

$API = new routeros_api();
$API->debug = false;

$sql = "SELECT * FROM clientesp";
$query = mysqli_query($con, $sql);


$sq="SELECT * FROM  mikrotik where idmikrotik=1";
$quer = mysqli_query($con, $sq);
$rows=mysqli_fetch_array($quer);

$ServerList=$rows['ip'];

$Username = $rows['mk_usuario'];
$Pass = $rows['mk_password'];
$Port = $rows['puerto'];



while ($row = mysqli_fetch_array($query)){


$name= $row['usuario'];



if ($API->connect($ServerList, $Username, $Pass, $Port)) {
$BRIDGEINFO2 = $API->comm('/ppp/secret/print', array(
".proplist" => ".id",
"?name"  => "$name",

));


$BRIDGEINFO2 = $API->comm('/ppp/secret/unset', array(

"numbers"  => $name,
"value-name" =>"local-address",

));

$API->disconnect();
}

}


?>