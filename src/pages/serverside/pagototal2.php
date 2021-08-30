<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");

$plan = $_POST['p'];




$res = mysqli_query($con,"select precio from planes where plan='$plan'");
$row = mysqli_fetch_array($res);
$precio = $row['precio'];






echo $precio;
mysqli_close($con);

?>

