 <?php

include '/var/www/admin/html/config/db.php';

$fecha = date('Y-m-d h:i:s');

$sq="SELECT * FROM  mikrotik ";
    $quer = mysqli_query($con, $sq);
  while($rows=mysqli_fetch_array($quer)){
    
                 
$RouterIP = $rows['ip'];
$WebPort =$rows['puertoweb'];
$AccountingLocation = "accounting/ip.cgi";
$idmk = $rows['idmikrotik'];

$routerconect = "http://$RouterIP:$WebPort/$AccountingLocation";

$orig = file_get_contents($routerconect);
$a = htmlentities($orig);


foreach ( explode( "\n", $orig ) as $line ) {
    if ( trim( $line )) {
        list( $src, $dst, $bytes, $packets ) = explode( ' ', trim( strip_tags( $line )));

        // Now $src, $dst, $bytes, and $packets contain your data
       $sql = "INSERT INTO conexiones (src, dst, bytes, paquetes,fecha,idmk) VALUES ('$src', '$dst', $bytes, $packets, '$fecha',$idmk)";

       $insert = mysqli_query($con, $sql);
    }
}
	
$cm = "select id,remoteaddress from clientesp";
$query1 = mysqli_query($con,$cm);
while ($data = mysqli_fetch_array($query1)) {

	$id = $data["id"];
	$ip = $data["remoteaddress"];
	$descarga = 0;
	$subida = 0;


	$cmd = "SELECT sum(bytes) as subida from conexiones WHERE src='$ip' and fecha = '$fecha'";
		$cmd2 = "SELECT sum(bytes) as descarga from conexiones WHERE dst='$ip' and fecha = '$fecha'";

	$query = mysqli_query($con,$cmd);
	$query2 = mysqli_query($con,$cmd2);

	$row = mysqli_fetch_array($query);
	$row2 = mysqli_fetch_array($query2);
	$descarga += $row2["descarga"];
	$subida += $row["subida"];

	$ins = "insert into trafico (ip,descarga,subida,id_cliente,fecha,idmk) values('$ip',$descarga,$subida,$id,'$fecha',$idmk)";

	$insert = mysqli_query($con,$ins);



	
}


}




mysqli_close($con);

?> 


