<?php
date_default_timezone_set("America/Santo_Domingo");
require_once 'include/db_functions.php';
 
// json response array
$response = array("error" => FALSE);

 
if (isset($_GET['usuario']) && isset($_GET['pwd'])) {
 
    // receiving the post params
    $usuario = $_GET['usuario'];
    $password = $_GET['pwd'];

   
 
    // get the user by email and password
    $user = getUserByUserAndPassword($usuario);

	if ($user['user_name'] != " ") {
    
       if (password_verify($password, $user['user_password_hash'])) {


	    $response["error"] = FALSE;
        $response["user"]["user_name"] = $user["user_name"];
        $response["user"]["firstname"] = $user["firstname"];
        $response["user"]["lastname"] = $user["lastname"];
        $response["user"]["user_id"] = $user["user_id"];
		
		
       				 echo json_encode($response);
    	} 

    	else

    	 {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Usuario o contraseña incorrectos !";
    
        echo json_encode($response);
		}			 
   	}
} else {
    //required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Error de Conexion a la base de datos";
    echo json_encode($response);
}

?>