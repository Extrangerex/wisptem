<?php

require_once('../../config/classOLT/OLT.php');
$olt = new \OLT\olt();
 $up = $olt->uptime("192.168.85.1", "jitech", "Emmanise40854085",2333);

 $temp = $olt->temperature("192.168.85.1", "jitech", "Emmanise40854085",2333);

echo "$up , $temp °C";
 


?>
 