<?php
$url = "http://192.168.84.200:4000/lua/host_details.lua?host=190.16.0.38";
	

//create a new cURL resource
$ch = curl_init($url);

//setup request to send json via POST
$data = array(
    'user' => 'admin',
    'password' => 'Emmanise40854085'
);
$payload = json_encode(array("user" => $data));

//attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

//return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
$result = curl_exec($ch);


$data = json_decode(file_get_contents('php://input'), true);


echo json_encode($result);

//close cURL resource
curl_close($ch);
?>
