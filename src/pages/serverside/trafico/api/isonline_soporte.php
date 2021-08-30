
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="traficos"></div>
</body>
</html>
<?php

require_once('api_mt_include2.php'); 
$Server = "192.168.84.1";
$Username = "sysadmin";
$Pass = "Emmanise40854085!";
$Port = 8750;
$www_port = 80;



function ValidChar($cadena){// valida nombre secret
	if (preg_match("/^([0-9a-zA-Z\@.]){1,36}$/", $cadena,$resultado)){
		return true;
	}else{
		return false;
	}
}


  	    $name = "bon53";
		$API = new routeros_api();
		$API->debug = false;
		if ($API->connect($Server , $Username , $Pass, $Port)) {
		   $API->write("/ppp/active/getall",false);
		   $API->write('?name='.$name,true);      
		   $READ = $API->read(false);
		   $ARRAY = $API->parse_response($READ);
			if(count($ARRAY)>0){   // si esta conectado
				$active_caller_id = $ARRAY[0]["caller-id"];
				$active_uptime = $ARRAY[0]["uptime"];
				$active_address = $ARRAY[0]["address"];
		
			   $API->write("/ppp/secret/getall",false);
			   $API->write('?name='.$name,true);      
			   $READ = $API->read(false);
			   $ARRAY = $API->parse_response($READ);
				
			   if(count($ARRAY)>0){ // busco el secret
					$secret_caller_id = $ARRAY[0]["caller-id"];
					$secret_profile = $ARRAY[0]["profile"];
					
					echo "<script>$('traficos').src = 'http://".$Server.":".$www_port."/graphs/queue/%3Cpppoe-".$name."%3E/weekly.gif'; 
						document.getElementById('traficos').innerHTML='';</script>";
					
				}
		   
			}else{  //el usuario esta of line
				echo '<img src="../images/icon_led_grey_solid.png"  alt="off line" />'; 
				echo '&nbsp;No conectado';
				echo '<script>api("api/log.php","?name='.$name.'","div_log","div_log",this);</script>';
				echo "<script>$('div_mrtg').src = '../images/pixel_blank.gif';</script>";	
			}
		   $API->disconnect();
		}

?>
