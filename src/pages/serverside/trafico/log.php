<!-- 
////////////////////////////////////////////////////////////////////
// ESTE EJEMPLO SE DESCARGO DE www.tech-nico.com ///////////////////
// Creado por: Nicolas Daitsch. Guatrache. La Pampa ////////////////
// Contacto: administracion@tech-nico.com //////////////////////////
// RouterOS API: Busco Usuario PPPoE activo y muestro Graph o Log //
////////////////////////////////////////////////////////////////////
-->

<?php
$id=$_GET['id'];
session_start();
$_SESSION['api_ip'] ="192.168.84.1";  // Tu RouterOS
$_SESSION['api_user'] ="jitech";  
$_SESSION['api_pass'] ="Emmanise40854085";
$_SESSION['api_port'] =8728;
$_SESSION['www_port'] =80;
?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Ejemplo Tech-nico.com | Graphs y logs.</title>
	<script src="http://www.google.com/jsapi?key=ABQIAAAAH1SQdv8UELJPv6r3fP1QAhQF9qZgt8G1ZFRYnUdSISpJK7AikBSfdj69qRzDqibMDUq91s1eFWMY1A" type="text/javascript"></script>
	<script language="JavaScript" type="text/javascript">
		//<![CDATA[    
				   google.load("mootools", "1.2");
		//]]>
	</script>
	<script src="js/core.js" type="text/javascript"></script>
	<style>
		body {
			font-size: 15px;
			font-family:  Arial, Helvetica, sans-serif;
			margin:0px;
		}
		input {
			font-size: 18px;
		}
		#background{
			background-image:url("images/1back_conn337.png");
			width:  100%;
			height: 250px;
			padding-left: 10px;
			padding-top: 10px;
		}
		#div_mrtg{
			margin-top: 5px;
		}
	</style>
</head>
<body>

        <div id="background">
        	<div id="div_status"></div>
        	<div id="div_load"></div>

  	   		<input type="hidden" name="user" type="text" id="user" value="<?php echo $id; ?>"  />

			<script>


	  	   		api("api/isonline_soporte.php","?name="+$("user").value,"div_status","div_load",this);	
  	   	
				api("api/isonline_soporte.php","?name="+$("user").value,"div_status","div_load",this);
			</script>     	   
                

            <div>
            	<img name="div_mrtg" id="div_mrtg"/>
            </div>
            <div id="div_log"></div> 
        </div>
</body>
</html>
