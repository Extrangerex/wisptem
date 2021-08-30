<?php
include '/var/www/admin/html/config/db.php';

ini_set("max_execution_time", 0);
set_time_limit(0);

sleep(30);




$tablas = mysqli_query($con,"delete from trafico where fecha < now() - interval 30 DAY;");

//unset($registros);
//unset($registros2);
//unset($db);


?>