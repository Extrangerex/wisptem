<?php

session_start();

include '../config/db.php';

  $iduser = $_SESSION['user_id'];


  $update = mysqli_query($con,"update users set online=0 where user_id= $iduser");



?>
 <script language="javascript">
        window.location.href = "../login.php?logout"
    </script>