<?php
include("db.php");

function limpiar_numero($string) {
     $string = str_replace(array('-', '(', ')'),'',$string);
 
 return $string;
}

function User_state($name, $idm)
{
    global $con;
    $sql         = "SELECT * FROM  mikrotik where idmikrotik=$idm";
    $query       = mysqli_query($con, $sql);
    $row         = mysqli_fetch_array($query);
    $nodo        = $row['nodo'];
    $ip          = $row['ip'];
    $mk_usuario  = $row['mk_usuario'];
    $mk_password = $row['mk_password'];
    $mk_puerto   = $row['api'];
    $tipocon     = $row['tipocon'];
    
    if ($tipocon == 2) {
        $mk_ip = "$ip:$mk_puerto";
    } else {
        $mk_ip = $ip;
    }
    $API        = new routeros_api();
    $API->debug = false;
    $API - $API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
    $API->write('/ppp/active/print
?name=' . ($name));
    $READ  = $API->read(false);
    $ARRAY = $API->parse_response($READ);
    if (count($ARRAY) > 0) { // si esta conectado
        $data = 1;
    } else {
        $data = 0;
    }
    $API->disconnect();

    return $data;
    mysqli_close($con);
}
function buscar_numcli($p)
{
    global $con;
    $res   = mysqli_query($con, "select count(*) as total from clientesp where plan='$p'");
    $row   = mysqli_fetch_array($res);
    $total = $row['total'];
    return $total;
    mysqli_close($con);
}

function buscar_activozona($p)
{
    global $con;
    $res   = mysqli_query($con, "select count(*) as total from clientesp where sector='$p' and disable='no'");
    $row   = mysqli_fetch_array($res);
    $total = $row['total'];
    return $total;
    mysqli_close($con);
}


function buscar_suspendidozona($p)
{
    global $con;
    $res   = mysqli_query($con, "select count(*) as total from clientesp where sector='$p' and disable='yes'");
    $row   = mysqli_fetch_array($res);
    $total = $row['total'];
    return $total;
    mysqli_close($con);
}


function clientevsmikrotik($n)
{
    global $con;
    $sql  = "select count(*) as tot from clientesp where id_mk= '" . $n . "';";
    $cmd  = mysqli_query($con, $sql);
    $rows = mysqli_fetch_array($cmd);
    $tot  = $rows['tot'];
    return $tot;
    mysqli_close($con);
}
function Nodo_name($n)
{
    global $con;
    $sql  = "select nodo from mikrotik where idmikrotik= $n";
    $cmd  = mysqli_query($con, $sql);
    $rows = mysqli_fetch_array($cmd);
    $tot  = $rows['nodo'];
    return $tot;
    mysqli_close($con);
}


function Last_log($name, $idm)
{
    global $con;
    $sql   = "SELECT * FROM  mikrotik where idmikrotik=$idm";
    $query = mysqli_query($con, $sql);
    $row   = mysqli_fetch_array($query);
    $nodo  = $row['nodo'];
    
    $ip          = $row['ip'];
    $mk_usuario  = $row['mk_usuario'];
    $mk_password = $row['mk_password'];
    $mk_puerto   = $row['api'];
    $tipocon     = $row['tipocon'];
    
    
    if ($tipocon == 2) {
        $mk_ip = "$ip:$mk_puerto";
    } else {
        $mk_ip = $ip;
    }
    $API        = new routeros_api();
    $API->debug = false;
    $API - $API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto);
    $API->write('/ppp/secret/print
?name=' . ($name));
    $READ  = $API->read(false);
    $ARRAY = $API->parse_response($READ);
    for ($x = 0; $x < count($ARRAY); $x++) {
        $data = $ARRAY[$x]['last-logged-out'];
    }
    $API->disconnect();
    return $data;
    mysqli_close($con);
}
function tiempoTranscurridoFechas($fechaInicio, $fechaFin)
{
    $fecha1 = new DateTime($fechaInicio);
    $fecha2 = new DateTime($fechaFin);
    $fecha  = $fecha1->diff($fecha2);
    $tiempo = "";
    //años
    if ($fecha->y > 0) {
        $tiempo .= $fecha->y;
        if ($fecha->y == 1)
            $tiempo .= " año, ";
        else
            $tiempo .= " años, ";
    }
    //meses
    if ($fecha->m > 0) {
        $tiempo .= $fecha->m;
        if ($fecha->m == 1)
            $tiempo .= " mes, ";
        else
            $tiempo .= " meses, ";
    }
    //dias
    if ($fecha->d > 0) {
        $tiempo .= $fecha->d;
        if ($fecha->d == 1)
            $tiempo .= " día, ";
        else
            $tiempo .= " días, ";
    }
    //horas
    if ($fecha->h > 0) {
        $tiempo .= $fecha->h;
        if ($fecha->h == 1)
            $tiempo .= " hora, ";
        else
            $tiempo .= " horas, ";
    }
    //minutos
    if ($fecha->i > 0) {
        $tiempo .= $fecha->i;
        if ($fecha->i == 1)
            $tiempo .= " minuto";
        else
            $tiempo .= " minutos";
    } else if ($fecha->i == 0) //segundos
        $tiempo .= $fecha->s . " segundos";
    return $tiempo;
}
function formatBytes($size)
{
    $base   = log($size) / log(1024);
    $suffix = array(
        "",
        " KB",
        " MB",
        " GB",
        " TB"
    );
    $f_base = floor($base);
    return round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}

function getAvatarUrl($id)
{
    global $con;
    $query = mysqli_query($con, "select *from users where user_id=$id");
    $row   = mysqli_fetch_array($query);
    $foto  = $row['foto'];
    if (isset($foto)) {
        return $foto;
    } else {
        return '../images/avatar2.png';
    }
    mysqli_close($con);

}
