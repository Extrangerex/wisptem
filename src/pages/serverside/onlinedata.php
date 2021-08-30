<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");
$sql="SELECT * FROM users WHERE status=0";
$res=mysqli_query($con,$sql);


while ($data=mysqli_fetch_array($res)){
	$fname = $data['firstname'];
$lname = $data['lastname'];
$nombre="$fname $lname";
    $salida='<script>Push.create("Acceso al sistema", {
            body: "'.$nombre.' acaba de iniciar sesion"
          
           
        });</script>';
}
$sql="UPDATE users SET status = 1 WHERE status =0";
mysqli_query($con,$sql);
echo $salida;
mysqli_close($con);
?>