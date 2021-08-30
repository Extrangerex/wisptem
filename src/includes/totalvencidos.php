
<?php

$consulta = mysqli_query($con,"SELECT COUNT(*) as cuenta FROM clientesp WHERE TIMESTAMPDIFF(DAY, fecha_final , CURDATE()) > 1 and disable='yes' ");
 $result = mysqli_fetch_array ($consulta);

echo(string) $result['cuenta'];


?>

<br />
