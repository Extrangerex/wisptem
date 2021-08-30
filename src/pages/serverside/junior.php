<?php 




$url = "http://localhost:8086/query";


 
$dataArray = array("q"=>'SELECT * FROM "ntopng"."autogen"."host:flows" where time > now()');




$ch = curl_init();
$data = http_build_query($dataArray);
$getUrl = $url."?".$data;
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_URL, $getUrl);
curl_setopt($ch, CURLOPT_TIMEOUT, 80);

$response = curl_exec($ch);

if(curl_error($ch)){
	echo 'Request Error:' . curl_error($ch);
}
else
{
	echo $response;
}

curl_close($ch);
?>
