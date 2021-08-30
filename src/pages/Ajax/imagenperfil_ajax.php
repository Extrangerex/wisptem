	<?php
				/* Connect To Database*/
				require_once ("../../config/db.php");
				$id = $_GET['id'];
				
				if (isset($_FILES["avatarInput"])){
	
				$target_dir="../../images/fotos/";
				$image_name = time()."_".basename($_FILES["avatarInput"]["name"]);
				$target_file = $target_dir . $image_name;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$imageFileZise=$_FILES["avatarInput"]["size"];
				
					
				
				/* Inicio Validacion*/
				// Allow certain file formats
				if(($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) and $imageFileZise>0) {
				$errors[]= "<p>Lo sentimos, sólo se permiten archivos JPG , JPEG, PNG y GIF.</p>";
				} else if ($imageFileZise > 1048576) {//1048576 byte=1MB
				$errors[]= "<p>Lo sentimos, pero el archivo es demasiado grande. Selecciona logo de menos de 1MB</p>";
				}  else
			{
				
				
				
				/* Fin Validacion*/
				if ($imageFileZise>0){
					move_uploaded_file($_FILES["avatarInput"]["tmp_name"], $target_file);
					$logo_update="../images/fotos/$image_name";
				
				}	else { 
					$logo_update="";
				}

                    $sql = "UPDATE users SET foto='".$logo_update."' WHERE user_id=$id";
                    $query_new_insert = mysqli_query($con,$sql);

                   
                    if ($query_new_insert) {
                        
                    } else {
                        $errors[] = "Lo sentimos, actualización falló. Intente nuevamente. ".mysqli_error($con);
                    }
			}
		}	
				
				
				
		
	?>
	<?php 
		if (isset($errors)){
	?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error! </strong>
		<?php
			foreach ($errors as $error){
				echo $error;
			}
		?>
		</div>	
	<?php
			}
			mysqli_close($con);
	?>
