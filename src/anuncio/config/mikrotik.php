<?php
$ipRB = "192.168.10.1"; //IP de tu RB.
$Username = "esterlin"; //Nombre de usuario con privilegios para acceder al RB
$clave = "40854085"; //Clave del usuario con privilegios
$api_puerto=8189; //Puerto que definimos el API en IP8189
$interface = $_GET["interface"]; //"<pppoe-nombreusuario>";
require('routeros_api.class.php');
$API = new RouterosAPI();
$API->debug = false;
$API->connect($ipRB , $Username , $clave, $api_puerto);
?>