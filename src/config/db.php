<?php
/*Datos de conexion a la base de datos*/
define('DB_HOST','db');
define('DB_USER','root');//Usuario de tu base de datos
define('DB_PASS','admin123456');//Contraseña del usuario de la base de datos
define('DB_NAME','3940');//Nombre de la base de datos

	


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
define('Mora', '0');
define('jitechserver', 'admin.jitechwisp.club:4085');
define('Prologa', $row['prologa']);


define('ppp_pass','');

define('local_address','172.16.50.1');

define('NAME_EMPRESA', $row['nombre_empresa']);
define('DIR_EMPRESA', '       '.$row['direccion']);
define('CITYNAME', '      Santiago de los Caballeros');
define('CELL_EMPRESA', $row['telefono']);
define('CELL_OFICINA', $row['telefono']);
define('RNC_COMP', '   RNC: '.$row['rnc']);

define('Token', '914014782:AAH_lovY8VUjYxS6JcGZGhKvz86CaiJ68800000k');
define('ChatId', '-378479300631');
