<?php
require_once ("../../config/db.php");

require('../../config/api_mt_include2.php');
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_POST['id'])){
		$id=intval($_POST['id']);
		
	
		
		    $ss=mysqli_query($con,"select * from clientesp where id='".$id."'");
		    $row = mysqli_fetch_array($ss);

            
           

            $name = $row['usuario'];
            $idm = $row['id_mk'];  

            $sql="SELECT * FROM  mikrotik where idmikrotik=$idm";
		    $query = mysqli_query($con, $sql);
		    $rows=mysqli_fetch_array($query);
		
                        $mk_ip=$rows['ip'];
                   
                        $mk_usuario = $rows['mk_usuario'];
                        $mk_password = $rows['mk_password'];
                        $mk_puerto = $rows['puerto'];


            $API = new routeros_api();
           
            $API->debug = true;
            if ($API->connect($mk_ip, $mk_usuario, $mk_password, $mk_puerto)) {

                $API->write('/ppp/secret/print
                    ?name='.($name)
                );
                $find = $API->read();

                foreach ($find as $find){
                    $API->write('/ppp/secret/remove', false);
                    $API->write('=.id='.$find['.id']);
                    $API->read();
                }
                $API->disconnect();
            }
            $API = new routeros_api();
            $API->debug = false;
            if ($API->connect($mk_ip , $mk_usuario , $mk_password, $mk_puerto)) {
                $API->write("/ppp/active/getall",false);
                $API->write('?name='.$name,true);
                $READ = $API->read(false);
                $ARRAY = $API->parse_response($READ);
                if(count($ARRAY)>0){
                    $API->write("/ppp/active/remove",false);
                    $API->write("=.id=".$ARRAY[0]['.id'],true);
                    $READ = $API->read(false);
                    $ARRAY = $API->parse_response($READ);
                }
                $API->disconnect();
            }



			if ($delete1=mysqli_query($con,"update clientesp set disable='retirado' WHERE id='".$id."'")){



                	$fec = date("Y-m-d H:i:s");
				$iduser = $_SESSION['user_id'];
				$detalle = "Retiro el cliente con el usuario $name";
				 $SI  = "INSERT INTO  logs(user_id,fecha,detalle)
                            VALUES('".$iduser."','".$fec."','".$detalle."');";
                             $query = mysqli_query($con,$SI);

			}
	}
    mysqli_close($con);
?>