<?php 
require_once ("../../config/db.php");

        $id=intval($_POST['id']);
    
      
    
        
        $delete1=mysqli_query($con,"DELETE FROM accesorios WHERE id=$id");
           
  mysqli_close($con);
?>