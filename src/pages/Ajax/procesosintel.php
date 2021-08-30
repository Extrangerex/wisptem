<style type="text/css">
		pl {
		color: #F00;
		}
		a:hover {
		color: #F00;
		}
		.weeee {
		color: #F00;
		}
		body {
		background-color: #000;
		}
</style>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1 align="center" class="weeee"> Espera Por Favor</h1>
<p>&nbsp;</p>
<p align="center"><img src="../../images/ajax-loader.gif" width="128" height="15" /></p>
<p align="center">Bo</p>
<?php include('../../config/db.php'); ?>
<?php
require('../../config/routeros_api.class.php');
require('../../config/api_mt_include2.php');
$day=$_GET['f'];
$sector=$_GET['s'];
$query = "SELECT * FROM clientesp WHERE fecha_final='$day' and sector = '$sector'";
$Recordset2 = mysqli_query($con, $query) or die(mysql_error());
$row_Recordset2 = mysqli_fetch_array($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);
$ServerList=mikrotik_ip;  // tu RouterOS.
$Username=mikrotik_usuario;
$Pass=mikrotik_contrasena;
$Port=mikrotik_puerto;
//$name = $row_Recordset1['usuario'];  // ---- nombre del usuario pppoe
$servicio="pppoe";
//$mac= $row_Recordset1['mac'];
do{
$fechainicial=$row_Recordset2['fecha_final'];
$nombre=$row_Recordset2['nombres'];
$postes=$row_Recordset2['poste'];
$pas="pcu1212";
$apellido=$row_Recordset2['apellido'];
$comentario = "$direcion $cell $fechainicial";
$name=$row_Recordset2['usuario'];
$id=$row_Recordset2['id'];
$sql="update clientesp set disable='yes' where id=$id";
$Records = mysqli_query($con,$sql) or die(mysql_error());
$perfil="cortado";
$API = new routeros_api();
$API = new routeros_api();
$API->debug = false;
if ($API->connect($ServerList, $Username, $Pass, $Port)) {
//Busca ID por Nome
$API->write('/ppp/secret/print
?name='.($name)
);
$find = $API->read();
//Remove ID encontrado de Acordo com o Nome.
foreach ($find as $find){
$API->write('/ppp/secret/remove', false); // remove, enable, disable
$API->write('=.id='.$find['.id']);
$API->read();
}
$API->comm("/ppp/secret/add", array(
"name"     => $name,
"password" => $pas,
"comment"  => $comentario,
"service"  => $servicio,
"profile"  => $perfil,
"caller-id" => $mac,
));
$API->disconnect();
}
$API = new routeros_api();
$API->debug = false;
if ($API->connect($ServerList , $Username , $Pass, $Port)) {
$API->write("/ppp/active/getall",false);
$API->write('?name='.$name,true);
$READ = $API->read(false);
$ARRAY = $API->parse_response($READ);
if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
$API->write("/ppp/active/remove",false);
$API->write("=.id=".$ARRAY[0]['.id'],true);
$READ = $API->read(false);
$ARRAY = $API->parse_response($READ);
}
$API->disconnect();
}
}
while ($row_Recordset2 = mysqli_fetch_array($Recordset2));
?>
<script>
window.location.href = 'administrador.php';
</script>