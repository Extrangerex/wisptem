<?php
//Include database configuration file
include('../../config/db.php');

if(isset($_POST["id_mk"]) && !empty($_POST["id_mk"])){
    //Get all state data
    $query =mysqli_query($con,"SELECT * FROM remoteaddress WHERE id_mk = ".$_POST['id_mk']." LIMIT 1 ");
    
    //Count total number of rows
    $rowCount =mysqli_num_rows($query);
    
    //Display states list
    if($rowCount > 0){
        
        while($row = mysqli_fetch_array($query)){ 
            echo '<option value="'.$row['ip'].'">'.$row['ip'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }

    mysqli_close($con);
}
