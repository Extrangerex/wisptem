<?php

require_once('../../config/classOLT/OLT.php');
$olt = new \OLT\olt();
  $onus = $olt->vlan_list("192.168.85.1", "jitech", "Emmanise40854085","GPON006274E1");
echo $onus;
 
   

?>
