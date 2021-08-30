<?php
date_default_timezone_set("America/Santo_Domingo");
include('is_logged.php');
/* Connect To Database*/
require_once ("../../../config/db.php");
session_start();

$nivel=$_SESSION['nivel'];
if ($nivel != 1){
    $disabled = "disabled";
}
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if (isset($_GET['id'])){
$id=intval($_GET['id']);
if ($count==0){
if ($delete1=mysqli_query($con,"DELETE FROM facturas WHERE numero_factura ='".$id."'")){
$fec = date("Y-m-d H:i:s");
$iduser = $_SESSION['user_id'];
$detalle = "Elimino la factura # $id";
$SI  = "INSERT INTO  logs(user_id,fecha,detalle)
VALUES('".$iduser."','".$fec."','".$detalle."');";
$query = mysqli_query($con,$SI);
?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Aviso!</strong> Datos eliminados exitosamente.
</div>
<?php
}else {
?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
</div>
<?php
}
} else {
?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Error!</strong> No se pudo eliminar éste  cliente. Existen facturas vinculadas a éste producto.
</div>
<?php
}
$total = 0;
}

// escaping, additionally removing everything that could be (html/javascript-) code
$q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
$sTable = "facturas, clientesp, users";
$sWhere = "";
$sWhere.=" WHERE facturas.id_cliente=clientesp.id and facturas.id_vendedor=users.user_id";
 if ( $_GET['q'] != "" )
    {
        $sWhere.= " and  (clientesp.nombres like '%$q%' or facturas.numero_factura like '%$q%'  or clientesp.apellido like '%$q%' or users.firstname like '%$q%' or users.lastname like '%$q%'  or facturas.fecha_factura like '%$q%' or clientesp.id like '%$q%')";

    }
$sWhere.=" order by facturas.numero_factura desc";
include 'pagination.php'; //include pagination file
//pagination variables
$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
$per_page = 100; //how much records you want to show
$adjacents  = 4; //gap between pages after number of adjacents
$offset = ($page - 1) * $per_page;
//Count the total number of row in your table*/
$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
$count_total =  mysqli_query($con, "SELECT SUM(total_venta) as total FROM $sTable  $sWhere");
$row= mysqli_fetch_array($count_query);
$numrows = $row['numrows'];
$tot = mysqli_fetch_array($count_total);
$total_pages = ceil($numrows/$per_page);
$reload = './facturas.php';
//main query to fetch the data
$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
$query = mysqli_query($con, $sql);
?>
<span>
    <?php 
    if ($nivel == 1){
        echo "

    <div class='col-md-8'>
        <div class='row'>
            <label>Total Facturas -> </label>
            <a type='text' >";

            echo $numrows; 
            echo "</a>
        </div>
        <div class='row'>
            <label>Monto Total: RD $ </label>
            <a>'";
            echo number_format($tot['total'],2);
        echo     "</a> </div></div> ";


}
?>
</span>
<div class="card-body">
<table class="table table-striped table-bordered table-hover" id="listfact" style="font-size:12px;">
    <thead>
        
        <th>NO FACTURA</th>
        <th>FECHA </th>
        <th>ID CLIENTE</th>
        <th>NOMBRE</th>
        <th>PAGO</th>
        <th>COBRADOR</th>
        <th>Acciones</th>
        
    </thead>
    <?php
    while ($row=mysqli_fetch_array($query)){
    $id=$row['id'];
    $count ++;
    if ($disable=="no"){$estado="Activo";$class="btn btn-success";}
    else {$estado="Cortado";$class="btn btn-danger";}
    
    
    ?>
    
    
    <tr>
        
        
        <td><?php echo $row['numero_factura']; ?> </td>
        <td><?php echo $row['fecha_factura']; ?> </td>
        <td><?php echo $row['id']; ?> </td>
        
        <?php
        if ($row['condiciones']==1){
        ?>
        <td ><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?> <img src="../images/banco.png"></td>
        <?php
        }
        else if ($row['condiciones']==2){
        ?>
        <td ><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?> <img src="../images/android.png"></td>
        <?php
        }
        else{
        ?>
        <td ><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?></td>
        <?php
        }
        ?>
        
        <td><?php echo "RD $".number_format($row['total_venta'],2); ?> </td>
        <td ><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
        <td>
            <a href="Reportes/cobro.php?id=<?php echo $id; ?>" target="_blank" class='btn btn-xs btn-default' title='Descargar factura'><i class="fa fa-print"></i></a>
            <button  onclick="eliminar_factura('<?php echo $row['numero_factura']; ?>');" class='btn btn-xs btn-default' title='Eliminar factura'<?php echo $disabled ?> ><i class="fa fa-trash-o"></i></button>
        </td>
        
        
    </tr>
    <?php
    }
    mysqli_close($con);
    ?>
    
    
</table>
</div>

<script>
$(document).ready(function() {
$('#listfact').DataTable( {
"dom": 'Bfrtip',

buttons: [

],



"bsort": true,
"paging": false,
"searching": false,

"forceResponsive": true,

"stateSave": true,
"stateDuration": 0,
"oLanguage": {
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de 0 registros",
"sInfoFiltered":   "(filtrado de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
"sFirst":    "Primero",
"sLast":     "Último",
"sNext":     "Siguiente",
"sPrevious": "Anterior"
},
"oAria": {
"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
"sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
}
} );

} );
</script>