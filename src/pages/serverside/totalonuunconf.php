 <?php
   require('../../config/classOLT/OLT.php');
   include '../../config/db.php';
   $sqlolt = "SELECT * FROM  olts where id=2";
    $queryolt = mysqli_query($con, $sqlolt);
    $rowss=mysqli_fetch_array($queryolt);
    
                        $ipolt=$rowss['ip'];
                          $userolt=$rowss['username'];
                            $passolt=$rowss['password'];
                              $portolt=$rowss['telnetport'];
                              $olt = new \OLT\olt();
      $num_onu = $olt->count_unconfigured($ipolt, $userolt, $passolt,$portolt);

      echo $num_onu;
      ?>