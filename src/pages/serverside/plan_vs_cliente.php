<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");

$plan = $_GET['p'];





$res = mysqli_query($con,"select count(*) as total from clientesp where plan='$plan'");
$row = mysqli_fetch_array($res);
$total = $row['total'];




echo $total;
mysqli_close($con);

?>

