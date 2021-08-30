<?php

require_once('../../config/classOLT/OLT.php');
$olt = new \OLT\olt();
  $onus = $olt->unconfigured_onu("192.168.85.1", "jitech", "Emmanise40854085");
echo $onus;
 


?>
 