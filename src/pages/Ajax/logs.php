 <?php
$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$iduser=$_SESSION['user_id'];
$nombres="$fname $lname";
$fecha = $_GET["fec"];
include('../../config/db.php');
$sql = "select u.firstname,u.lastname,l.user_id,l.fecha,l.detalle from logs l, users u where u.user_id = l.user_id and l.fecha like '%$fecha%' order by id desc";
$query = mysqli_query($con,$sql);
?>

 <table  class="table table-striped" id="example">
                  
                    <tbody>
                        <tr>
                            <?php
                            while ($row=mysqli_fetch_array($query))
                            {
                            
                            ?>
                            
                            
                            <td class="w3-text-red"><?php echo $row['fecha']."    ".$row['firstname']." ".$row['lastname']." ".$row['detalle']; ?></td>
                        </tr>
                        <?php }


                        mysqli_close($con);

                        ?>
                    </tbody>
                </table>