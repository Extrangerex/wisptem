<?php

include('is_logged.php');//ArchivoverificaqueelusarioqueintentaaccederalaURLestalogueado
/*Iniciavalidaciondelladodelservidor*/
if(empty($_POST['nombre'])){
    $errors[]="Nombre Empty";
}elseif(empty($_POST['apellido'])){
    $errors[]="apellido vacío";
}elseif(empty($_POST['cell'])){
    $errors[]="Cell vacío";
}elseif(empty($_POST['cell2'])){
    $errors[]="Tel vacío";
}elseif(empty($_POST['sexo'])){
    $errors[]="Debes el sexo";
}elseif(empty($_POST['fecnac'])){
    $errors[]="Debes ingresar la fecha de nacimiento";
}elseif(empty($_POST['direccion'])){
    $errors[]="Debes ingresar la direccion";
}elseif(empty($_POST['fecnac'])){
    $errors[]="Debes ingresar la fecha de nacimiento";
}elseif(!empty($_POST['documento'])&&
    !empty($_POST['cargo'])&&
    !empty($_POST['sexo'])){
    /*ConnectToDatabase*/
    require_once ("../../config/db.php");




    $nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
    $apellido=mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
    $cell=mysqli_real_escape_string($con,(strip_tags($_POST["cell"],ENT_QUOTES)));
    $cell2=mysqli_real_escape_string($con,(strip_tags($_POST["cell2"],ENT_QUOTES)));
    $documento=mysqli_real_escape_string($con,(strip_tags($_POST["documento"],ENT_QUOTES)));
    $fecin=mysqli_real_escape_string($con,(strip_tags($_POST["fecin"],ENT_QUOTES)));
    $fecnac=mysqli_real_escape_string($con,(strip_tags($_POST["fecnac"],ENT_QUOTES)));
    $sexo=mysqli_real_escape_string($con,(strip_tags($_POST["sexo"],ENT_QUOTES)));
    $cargo=mysqli_real_escape_string($con,(strip_tags($_POST["cargo"],ENT_QUOTES)));
    $estado=mysqli_real_escape_string($con,(strip_tags($_POST["estado"],ENT_QUOTES)));





    $direccion=mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));


    $id=intval($_POST['id']);


    // allow valid image file formats


    $date_added=date("Y-m-dH:i:s");
// check if user or email address already exists
    $sql = "SELECT * FROM empleados WHERE id = '" . $id . "' OR documento = '" . $documento . "';";
    $query_check_user_name = mysqli_query($con,$sql);
    $query_check_user=mysqli_num_rows($query_check_user_name);
    if ($query_check_user == 1) {
        $errors[] = "Lo sentimos , el ID ó el usuario ya está en uso.";
    } else {



        $ruta = "../../fotos_empleados/";
        $archivo="imagen".date("dHis").".".pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);
        $destino = $ruta.$archivo;

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"],$destino)){
            $messages[]="Subido correctamente.";

        }else{
            $errors[]="Error al subir el archivo.";
        }




        $sql="INSERT INTO empleados(id,nombre,apellido,documento,cell,cell2,sexo,fecha_nacimiento,fecha_contratacion,cargo,foto,direccion,estado,date_added)VALUES($id,'$nombre','$apellido','$documento','$cell','$cell2','$sexo','$fecnac','$fecin','$cargo','$archivo','$direccion','$estado','$date_added')";
        $query_new_insert=mysqli_query($con,$sql);

        if($query_new_insert){
            $messages[]="Cliente ha sido ingresado satisfactoriamente.";


        }else{
            $errors[]="Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
        }





    }
}else{
    $errors[]="Error desconocido.";
}


if(isset($errors)){

    ?>
    <div class="alertalert-danger"role="alert">
    <button type="button"class="close"data-dismiss="alert">&times;</button>
    <strong>Error!</strong>
    <?php
    foreach($errors as $error){
        echo $error;
    }
    ?>
    </div>
    <?php
}
if(isset($messages)){

    ?>
    <div class="alertalert-success"role="alert">
    <button type="button"class="close"data-dismiss="alert">&times;</button>
    <strong>¡Bienhecho!</strong>
    <?php
    foreach($messages as $message){
        echo $message;
    }
    ?>
    </div>
    <?php
}
mysqli_close($con);

?>