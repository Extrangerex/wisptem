<?php 
require_once ("../../config/db.php");

        $id=intval($_POST['id']);
        $tabla=$_POST['action'];
       
      
    
        
        $delete1=mysqli_query($con,"DELETE FROM $tabla WHERE id=$id");
           
  mysqli_close($con);
?>