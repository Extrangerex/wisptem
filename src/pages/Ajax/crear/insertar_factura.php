
<?php require_once ("../../config/db.php"); ?>


<?php

session_start();


$id = $_POST['id'];

$idv = $_SESSION['user_id'];


$query = "select max(numero_factura)+1 as mayor from facturas";
$res = mysqli_query($con,$query) or die(mysqli_error());
$rows = mysqli_fetch_array($res);
$num = mysqli_num_rows($res);
if ($rows['mayor'] == NULL){
  $max = 1;
}else{


$max= $rows['mayor'];
}


$query = "select * from clientesp where id=$id";
$resultado = mysqli_query($con,$query) or die(mysqli_error());
$row = mysqli_fetch_assoc($resultado);
$total = mysqli_num_rows($resultado);
$dat=date('Y-m-d H:m:s');
$plazo=1;
$pago=$row['pago_total'];
$fec=$row['fecha_final'];
$actual=date('Y-m-d');
$fecha = date('Y-m-d',strtotime('+1 month', strtotime($fec)));

$ndias = $fec - $actual;



$sql="insert into facturas(numero_factura,fecha_factura,id_cliente,id_vendedor,condiciones,total_venta,estado_factura)
	  values($max,'$dat','$id',$idv,'1','$pago','1')";
$Records = mysqli_query($con, $sql) or die(mysqli_error());

$sql="update clientesp set fecha_final='$fecha' where id=$id";
$Records = mysqli_query($con,$sql) or die(mysqli_error());



 require('../../config/routeros_api.class.php');
 require('../../config/api_mt_include2.php');
$ServerList=mikrotik_ip;  // tu RouterOS. 
$Username=mikrotik_usuario; 
$Pass=mikrotik_contrasena; 
$Port=mikrotik_puerto; 

$postes=$row['poste'];
$perfil = $row['plan'];
$mac= $row['mac'];
$fechafinal=$row['fecha_final'];
$nombre=$row['nombres'];
$apellido = $row['apellido'];
$remoteaddress = $row['remoteaddress'];
$comment = "$nombre $apellido $fechafinal";
$disable= $row['disable'];
$name = $row['usuario'];
$pas = $row['password'];
$servicio = "pppoe";

if ($disable=='yes'){

   
	 $API = new routeros_api();
    $API->debug = false;
    if ($API->connect($ServerList, $Username, $Pass, $Port)) {

                 $BRIDGEINFO2 = $API->comm('/ppp/secret/print', array(
                              ".proplist" => ".id",
                              "?name"  => "$name",
                        
                  ));
                  $API->comm("/ppp/secret/set", array(
                            ".id"=>$BRIDGEINFO2[0]['.id'],
                             "name"     => $name,
                      "password" => $pas,
                      "comment"  => $comment,
                      "service"  => $servicio,
                      "profile"  => $perfil,
                      "caller-id" => $mac,
                      "remote-address" => $remoteaddress,



                  ));
                   


                $API->disconnect();
    }
}
	
$sql="update clientesp set disable='no' where id=$id";
$update = mysqli_query($con,$sql) or die(mysql_error());

mysqli_close($con);
?>

