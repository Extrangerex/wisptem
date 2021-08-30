<?php
date_default_timezone_set("America/Santo_Domingo");
require_once ("../../config/db.php");
$id = $_GET['id'];
 $query = "SELECT * FROM remoteaddress where id_mk=$id limit 8";  
      $result = mysqli_query($con, $query);
      	echo "<div class='card-body'>";
      
      echo "<div class='row' style='height: 100px; width: 50px;'>";

      echo "<table border = '0' style='width: 100px; height: 50px;'> \n";  
      while($row = mysqli_fetch_array($result))  
      {


       echo "<tr><td>".$row["ip"]."</td></tr> \n"; 
      }  
     
     
    echo "</table> \n"; 
    echo "</div>";
     echo "</div>";
     mysqli_close($con);
?>

