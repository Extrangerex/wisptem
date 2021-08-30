
<?php
date_default_timezone_set("America/Santo_Domingo");


    if(isset($_POST['Submit'])){


$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$message = $_POST['message'];

$array_fields['phone_number'] = $numero;
$array_fields['message'] = $message;
$array_fields['device_id'] = 112422;

$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU2MzY3NTQxNCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY0ODI2LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0._UrVEzJjtvbf0oo-f5kcCN2CEBtpMpnpVSrYuJrQBfI";

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
<html>
<head>
    <title>Write</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="connect.js"></script>
</head>
 
<body>
<div class="container-fluid">
    <div class="row center-block">
        <div class="col-md-6">
<form id="form1" name="form1" method="post" >


     <div class="form-group">
                    <label for="your-name">Your name: </label>
                    <input type="text" class="form-control input-lg" id="nombre" name="nombre" placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="number">Your friends number: </label>
                    <input type="tel" class="form-control input-lg" id="numero" name="numero" placeholder="Enter your friends cell phone number">
                </div>

                

                <div class="form-group">
                    <label for="message">Enter your message: </label>
                    <textarea type="tel" class="form-control input-lg" rows="5" id="message" name="message" placeholder="Enter your message"></textarea>
                </div>
    <input name="Submit" type="submit"  value="Submit"  />
</form>

</body>
</html>










