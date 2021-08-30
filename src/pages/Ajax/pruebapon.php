<?php

require_once('../../config/classOLT/OLT.php');
$olt = new \OLT\olt();
 //$onus = $olt->signal('192.168.85.1', 'jitech', 'Emmanise40854085',2333,2,1,39);

$onus = $olt->configuredlist('192.168.85.1', 'jitech', 'Emmanise40854085',2333);
echo $onus;
 


?>
 