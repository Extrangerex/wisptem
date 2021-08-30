<?php
$statusConexion=true;
function consultaUsuarios($conexion){
	$salida='';
	//Realizamos la Consulta que nos traera todos los registros de la BD
	$consulta=mysql_query('select id,nombre,edad,telefono,edad,ciudad,status
	 from user');
	 //Validamos si hay o no registros
	 if(mysql_num_rows($consulta)>0){
		 while($dato=mysql_fetch_array($consulta)){
			 $salida.='
			 	<tr>
					<td>'.$dato["id"].'</td>
					<td>'.$dato["nombre"].'</td>
					<td>'.$dato["edad"].'</td>
					<td>'.$dato["telefono"].'</td>
					<td>'.$dato["ciudad"].'</td>
					<td class="'.returnStatus($dato["status"]).'">'.$dato["status"].'</td>
					<td ><a class="btn btn-small">Editar</a></td>
				</tr>
			 ';
		 }
	 }
	 else
	 {
		 $salida='
		 	<tr id="sinDatos">
				<td colspan="7">No hay Registros en la Base de Datos, Tu codigo!!</td>
			</tr>
		 ';
	 }
	 return $salida;
}
function returnStatus($palabra){
	switch($palabra){
		case "Activo":
			$status="btn-success";
		break;
		case "Suspendido":
			$status="btn-warning";
		break;
		case "Cancelado":
			$status="btn-danger";
		break; 
	 }	
return $status;
}
if(!$conex=mysql_connect('200.50.0.200','root','pcu40854085')){
	$statusConexion=false;
}
if(!mysql_select_db('CPEWIFI',$conex)){
	$statusConexion=false;
}
else{
	mysql_query("set names 'utf-8'",$conex);
}

?>