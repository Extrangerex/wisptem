<?php
// include the configs / constants for the database connection
define('DB_HOST', 'db');
define('DB_USER', 'root'); //Usuario de tu base de datos
define('DB_PASS', 'admin123456'); //Contraseña del usuario de la base de datos


try {
    $DB_H = DB_HOST;
    $DB_U = DB_USER;
    $DB_P = DB_PASS;


    $con = new mysqli($DB_H, $DB_U, $DB_P);


    $query = file_get_contents("./wisptem.sql");

    $result = mysqli_query($con, $query);

    $status = "Instalando...";

    if (!$result) {
        $status = "Error";
        echo mysqli_error($con);
        die();
    } else {
        $status = "Instalacion completa";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Estado: <?php echo $status ?>
</body>

</html>