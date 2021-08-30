<?php
//Include database configuration file
include('../../config/db.php');

if(isset($_POST["id"]) && !empty($_POST["id"])){
    //Get all state data
    $query =mysqli_query($con,"SELECT * FROM sms_plantilla WHERE id = ".$_POST['id']." ");
    
    //Count total number of rows
    $rowCount =mysqli_num_rows($query);
    
    //Display states list
    if($rowCount > 0){
        
        while($row = mysqli_fetch_array($query)){ 
            echo $row['mensaje'];
        }
    }else{
        echo '';
    }

    mysqli_close($con);
}
