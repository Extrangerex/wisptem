<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");

$plan = $_POST['p'];




$res = mysqli_query($con,"select count(*) as total from users where online=1");
$row = mysqli_fetch_array($res);
$total = $row['total'];






echo $total;
mysqli_close($con);

?>

