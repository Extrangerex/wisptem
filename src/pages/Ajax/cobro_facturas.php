<?php


session_start();
require_once ("../../config/db.php");
$zona = $_GET['s']; 
$fecha = $_GET['f'];


		//pagination variables
		
if ($zona == "Todos"){
$query = "SELECT * FROM clientesp where fecha_final='$fecha' ORDER BY poste ASC";
}else{
$query = "SELECT * FROM clientesp where fecha_final='$fecha' and sector='$zona'  ORDER BY poste ASC";
}
$resultado = mysqli_query($con,$query) or die(mysqli_error());
$numrows = mysqli_num_rows($resultado);

if ($numrows>0){
?>
<html>


  					
  					 <table class="table table-striped table-bordered table-hover" id="listactive" >
						<thead>
							<tr>
								<th>Poste</th>
								<th>Nombres</th>
								<th>Nodo</th>
								<th>Celular</th>
								<th>Monto</th>
								<th>Fecha</th>
								<th  data-orderable="false" >Estado</th>
								<th class="all" data-orderable="false" style="min-width:46px !important;max-width:46px !important">Acción</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								   <?php while ($row = mysqli_fetch_array($resultado)) { 

								   	$fec=$row['fecha_final'];
									$actual=date('Y-m-d');
									$start_ts = strtotime($actual); 

									$end_ts = strtotime($fec); 

									$diff = $end_ts - $start_ts; 

									$ndias = round($diff / 86400); 

									$idmk = $row['id_mk'];
                  $pago =$row['pago_total'];
                  $cuota = 0;
                  $mora = 0;


                  $id = $row['id'];
                  $idpago=$row['id_pago'];
                  $mora = $row['mora'];

                  if ($idpago==2) {
              
                  $query_plazo = mysqli_query($con,"select * from financiamiento where id_cliente=$id");
                  $rows = mysqli_fetch_array($query_plazo);
                  $plazo = $rows['plazo'];
                  $cuota = $rows['monto'] / $plazo;
                  }
                  $montotal = $pago + $cuota + $mora;


									$ss = mysqli_query($con,"select nodo from mikrotik where idmikrotik=$idmk");
									$resu = mysqli_fetch_array($ss);








								   	?>



      
        <td><?php echo $row['poste']; ?></td>
        <td><?php echo $row['nombres']; ?> <?php echo $row['apellido']; ?></td>
         <td><?php echo $resu['nodo']; ?></td>
        <td><?php echo $row['cell']; ?></td>
        <td width="5"><?php echo $montotal; ?></td>
        <td width="100"><?php echo $row['fecha_final']; ?></td>
        
        <?php
		$fec=$row['fecha_final'];
		$actual=date('Y-m-d');
           if ($fec>=$actual){$text_estado="Pago";$label_class='label-success';}
						else{$text_estado="Pendiente";$label_class='label-warning';}
						if ($row['disable']=='yes'){
							$text_estado="Pendiente";$label_class='label-danger';

						}
						?>
        <td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
      <td class="text-center">
		<a href="Reportes/factura.php?id=<?php echo $id; ?>&ff=<?php echo $fec; ?>"  target="_blank" class='btn btn-default' title='Cobrar factura' onclick="cobrar('<?php echo $row['id'];?>','<?php echo $ndias; ?>');"><i class="fa fa-money fa-fw" data-taget="loadpagos()"></i></a> 
						

						
					</td>
			
      </tr>
      <?php }  

}
mysqli_close($con);
      ?>


     
						</tbody>
					</table>
					</div>
  				
  			</div>
<!-- /.row --></div>
                      
  			</div>
					</div>
					<!-- The end -->

					<!-- /.container-fluid -->

				</div>
				<!-- /#page-wrapper -->

			</div>
	
</html>


<script>
$(function() {
pagos = $('#listactive').DataTable( {
   responsive: true,


            "dom": 'Bfrtip',

            lengthMenu: [[15, 25, 50,100, -1], [ '15 Registros', '25 Registros', '50 Registros', '100 Registros', 'Mostrar todos' ] ],
           buttons: ['pageLength','colvis',
            {extend: 'collection', text: '<i class="fa fa-floppy-o"></i> <span class="caret"></span>', 
            buttons: [{extend: 'print', title:'Lista de cobro', text: '<i class="fa fa-print"></i> Imprimir', },
             {extend: 'csvHtml5', title:'Lista de cobro', text: '<i class="fa fa-file-excel-o"></i> Exportar a EXCEL', },
              {extend: 'pdfHtml5', title:'Lista de cobro', text: '<i class="fa fa-file-pdf-o"></i> Exportar a PDF', } ] }, 

             ],
             



           

            
            "bsort": true,
            "paging": true,
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
        "sNext":     ">>",
        "sPrevious": "<<"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
        } );
 
    } );


  function cobrar (id,n)
  {
  if (n>=5){
  if (confirm("Este cliente esta al dia, Desea cobrarle el proximo mes?...")) {
  $.ajax({
  url:"./Ajax/insertar_factura.php",
  method: "POST",
  data: {id: id},
  beforeSend: function(objeto){
  $('#resultados').html('');
  },
  success:function(data){
  loadpagos();
  }
  })

  }
  }else{
  $.ajax({
  url:"./Ajax/insertar_factura.php",
  method: "POST",
  data: {id: id},
  beforeSend: function(objeto){
  $('#resultados').html('');
  },
  success:function(data){
  loadpagos();
  }
  })
  
  }
  }


</script>


