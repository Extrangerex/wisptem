<?php
date_default_timezone_set("America/Santo_Domingo");
require_once 'include/db_functions.php';
 


$date=date("Y-m-d");
        
        $consulta="select * from planes";
        $resultado=mysqli_query($con,$consulta);

        if($resultado){
        
             while($row = mysqli_fetch_array($resultado))
                {
                     $response[] = $row;
                        
                 }

         


            echo json_encode($response);
               mysqli_close($on);
        }

  
        

?>