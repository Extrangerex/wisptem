<?php
date_default_timezone_set("America/Santo_Domingo");
require_once 'include/db_functions.php';
 


$id=$_GET['id'];
    

$date=date("Y-m-d");
        
        $consulta="select * from sector";
        $resultado=mysqli_query($con,$consulta);

        if($resultado){
        
             while($row = mysqli_fetch_array($resultado))
                {
                     $response[] = $row;
                        
                 }

         


            echo json_encode($response);
               mysqli_close($con);
        }

  
        

?>