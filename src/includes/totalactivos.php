<?php
$cmd="no";
$consulta = mysql_query("select count(*) as cuenta from clientesp where disable='$cmd'", $Connect);
$result = mysql_fetch_assoc ($consulta);

echo(string) $result['cuenta'];

