
<?php include('../config/db.php'); ?>
<?php 

	
	$meses = array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept','Oct','Nov','Dic');
	for($x=1;$x<=12;$x=$x+1){
		$filas[$x]=0;		
	}
	
	$anno=date('Y');
	
	$sql=mysqli_query($con,"SELECT * FROM clientesp");
	while($row=mysqli_fetch_array($sql)){
		$y=date("Y", strtotime($row['fecha_inicial']));
		
		$mes=(int)date("m", strtotime($row['fecha_inicial'])); 
		
		if($y==$anno){
			$filas[$mes]=$filas[$mes]+1;
		}
	}

	mysqli_close($con);
?>


 
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        
          ['Mes', 'Clientes Agregados'],
		  <?php
		  	for($x=1;$x<=12;$x=$x+1){	
		  ?>
          ['<?php echo $meses[$x]; ?>',  <?php echo $filas[$x] ?>],
		  <?php } ?>
        ]);

        var options = {
          title: 'Total de Ingresos',
          hAxis: {title: 'Grafica Reporte de Ingresos Mensual', titleTextStyle: {color: 'grey'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

</head>

<body>
	<div id="chart_div" style="width: 80%; height: 300px;"></div>
	
</body>
