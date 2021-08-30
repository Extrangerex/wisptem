
<?php

$consulta = mysqli_query($con,"select count(*) as cuenta from clientesp ");
$result = mysqli_fetch_array ($consulta);

echo(string) $result['cuenta'];


