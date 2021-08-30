 <?php


include '/var/www/admin/html/config/db.php';

ini_set("max_execution_time", 0);
set_time_limit(0);



$sq="SELECT * FROM  mikrotik where trafico='no'";


$tablas = mysqli_query($con, $sq);



while ($registros = mysqli_fetch_array($tablas)) {
    if (empty($registros["puertoweb"]) || $registros["puertoweb"] == "80") {
        $url = "http://" . $registros["ip"] . "/accounting/ip.cgi";
    } else {
        $url = "http://" . $registros["ip"] . ":" . $registros["puertoweb"] . "/accounting/ip.cgi";
    }
    $html = file_get_contents($url);
    $fecha = date("Y-m-d H:i:s");
    if (!empty($html)) {
        $insert[] = "(\"" . $html . "\",\"" . $fecha . "\",\"" . $registros["idmikrotik"] . "\")";
    }
}
$query = "INSERT INTO tmp (consulta,fecha,idmk) VALUES" . implode(";", $insert);
$insert= mysqli_query($con,$query);
unset($query);

unset($registros);
unset($html);



?> 


