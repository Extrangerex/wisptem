<?php


require 'autoload.php';
  use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;
  use SMSGatewayMe\Client\Api\DeviceApi;

$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$message = $_POST['message'];


    if(isset($_POST['Submit'])){




// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0MzU2MTY5MCwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY0ODI2LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.uIx2PnpC1Bq4XBaUqR_KSy4iVQHVZJpdD4G0X_UkTsw');

  $apiClient = new ApiClient($config);

  // Create device client
  $deviceClient = new DeviceApi($apiClient);

  // Get device information
  $device = $deviceClient->getDevice(106138);
  print_r($device);

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
                    <input type="text" class="form-control input-lg" id="nombre" placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="number">Your friends number: </label>
                    <input type="tel" class="form-control input-lg" id="numero" placeholder="Enter your friends cell phone number">
                </div>

                

                <div class="form-group">
                    <label for="message">Enter your message: </label>
                    <textarea type="tel" class="form-control input-lg" rows="5" id="message" placeholder="Enter your message"></textarea>
                </div>
    <input name="Submit" type="submit"  value="Submit"  />
</form>

</body>
</html>