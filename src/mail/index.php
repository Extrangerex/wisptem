<?php
// variables
$dbhost = '20.20.20.2';
$dbname = 'daniel';
$dbuser = 'root';
$dbpass = 'Jitech40854085';
 
$backup_file = $dbname. "-" .date("Y-m-d-H-i-s"). ".sql";
 
// comandos a ejecutar
$commands = array(
        "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass -v $dbname > $backup_file",
      "bzip2 $backup_file"
);
 
// ejecución y salida de éxito o errores
foreach ( $commands as $command ) {
        system($command,$output);
        echo $output;
}
?>
