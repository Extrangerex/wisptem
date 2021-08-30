<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");

$plan = $_POST['p'];
$fi = $_POST['fi'];
$ff = $_POST['ff'];




$res = mysqli_query($con,"select precio from planes where plan='$plan'");
$row = mysqli_fetch_array($res);
$precio = $row['precio'];


function Diff($start, $end) {

    $start_ts = strtotime($start);

    $end_ts = strtotime($end);

    $diff = $end_ts - $start_ts;

    return round($diff / 86400);

}

$day = Diff($fi,$ff);


$total = $day*$precio/30;

if ($day>24){
			$total = $precio;
		}
		if ($day<=5){

			 $total= 0;
		}

echo $total;
mysqli_close($con);

?>

