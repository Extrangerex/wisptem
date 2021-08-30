
<?php

$cadena = array("-", "(", ")", ".");

$my_apikey = "L19B88UBTI4Y7434AXZC"; 
$destination = "1(849)7545818";
$destination2 ="18094163370"; 
 $message = "Mama guebo"; 


function send_message($des,$msj,$apk){
$api_url = "http://panel.apiwha.com/send_message.php"; 
$api_url .= "?apikey=". urlencode ($apk); 
$api_url .= "&number=". urlencode ($des); 

$api_url .= "&text=". urlencode ($msj); 
$my_result_object = json_decode(file_get_contents($api_url, false)); 
echo "<br>Result: ". $my_result_object->success; 
echo "<br>Description: ". $my_result_object->description; 
echo "<br>Code: ". $my_result_object->result_code; 
}

$num = str_replace( $cadena, "", $destination);
send_message($num,$message,$my_apikey);



?>

