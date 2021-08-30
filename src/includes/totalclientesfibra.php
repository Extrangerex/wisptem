<?php

$consulta = mysqli_query($con,"select count(*) as cuenta from clientesp where id_servicio=2 ");
$result = mysqli_fetch_array ($consulta);

echo(string) $result['cuenta'];


