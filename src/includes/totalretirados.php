<?php
$cmd="retirado";
$consulta = mysqli_query($con,"select count(*) as cuenta from clientesp where disable='$cmd'");
$result = mysqli_fetch_array($consulta);

echo(string) $result['cuenta'];

?>
