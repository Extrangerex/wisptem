
<?php

include('/srv/www/htdocs/config/db.php');



//$query = mysqli_query($con,"SELECT * FROM clientesp WHERE TIMESTAMPDIFF(DAY, fecha_final , CURDATE()) > $prologa ");
$query = mysqli_query($con,"SELECT * FROM clientesp WHERE fecha_final = 'aqui va fecha de pago' ");





while($row = mysqli_fetch_array($query)){
	

	
    $nombre=$row['nombres'];

    $apellido=$row['apellido'];
    $numero =$row['cell'];
    $monto = $row['pago_total'];
    $fecha = $row['fecha_final'];
    $fec = date("Y-m-d",strtotime($fecha."+ 5days"));

    $message = "Estimado $nombre $apellido, Junior le informa que su factura de este mes es de: RD$monto ,favor pague antes de $fec. Si pago obviar mensaje .Whatsapp del cobrador: +15045133586 Fido ";







	$array_fields['phone_number'] = $numero;
$array_fields['message'] = $message;
$array_fields['device_id'] = 106138;

$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0NTY0Nzc5NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY0ODI2LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.aK5wKWhFb2fmMY8m3DWeZyU1qEE30oz4sBHEqnQzH5c";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://smsgateway.me/api/v4/message/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "[  " . json_encode($array_fields) . "]",
    CURLOPT_HTTPHEADER => array(
        "authorization: $token",
        "cache-control: no-cache"
    ),
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
 




	

}

?>
