<?php
/*Datos de conexion a la base de datos*/
define('DB_HOST','200.50.0.248');
define('DB_USER','root');//Usuario de tu base de datos
define('DB_PASS','Jitech40854085');//Contraseña del usuario de la base de datos
define('DB_NAME','jitechdata');//Nombre de la base de datos

	


date_default_timezone_set("America/Santo_Domingo");





$DB_H=DB_HOST;
$DB_U=DB_USER;
$DB_N=DB_NAME;
$DB_P=DB_PASS;



try{
		$DB_con = new PDO("mysql:host={$DB_H};dbname={$DB_N}",$DB_U,$DB_P);
		$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}




 $con= new mysqli($DB_H,$DB_U,$DB_P,$DB_N);
  mysqli_set_charset($con, 'utf8');




$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
$row=mysqli_fetch_array($query_empresa);


/*Datos de la empresa*/
define('NOMBRE_EMPRESA', $row['nombre_empresa']);
define('DIRECCION_EMPRESA', $row['direccion']);
define('TELEFONO_EMPRESA', $row['telefono']);
define('EMAIL_EMPRESA', $row['email']);
define('TAX', $row['impuesto']);
define('Mora', '100');
define('Prologa', $row['prologa']);


define('ppp_pass','408540');

define('local_address','172.16.50.1');





?>
