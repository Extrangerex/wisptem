<?php
define('WB_TOKEN', 'd927c48492fde6c89fddac146cb5b34d5f2e8cc4accd9');
define('WB_FROM', '18497545818');

function string_sanitize($string) {
     $string = str_replace(array('-', '(', ')'),'',$string);
 
 return $string;
}

function sendMessage ($to, $msg) {


    $to =  filter_var($to, FILTER_SANITIZE_NUMBER_INT);
    if (empty($to)) return false;
    $msg = urlencode($msg);
    $custom_uid = "msg-" . time() ;
    $url = "https://www.waboxapp.com/api/send/chat?token=" . WB_TOKEN . "&uid=" . WB_FROM . "&custom_uid=". $custom_uid ."&to=" . $to ."&text=" .$msg;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    if ($result) {
        return json_decode($result);
    }
    return false;

}
$msg =  "hola klk con klk";
$result = sendMessage('18298155818',$msg);
print_r($result);


?>