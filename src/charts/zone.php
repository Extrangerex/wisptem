

<?php 
include('../config/db.php');


$sql = mysqli_query($con,"select * from sector");



?>



<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
	title:{
		text: "Cantidad De Clientes Por Sector"
	},
	legend:{
		cursor: "pointer",
		itemclick: explodePie
	},
	data: [{
		type: "pie",
		showInLegend: true,
		toolTipContent: "{name}: <strong>{y}Cliente(s)</strong>",
		indexLabel: "{name} - {y} cliente(s)",
		dataPoints: [
		<?php
		 while($row=mysqli_fetch_array($sql)){	

	$abre= $row['abreviacion'];
	$nombre=$row['nombre'];

	$consulta = mysqli_query($con,"select count(*) as cuenta from clientesp where sector='$abre'");
	$result = mysqli_fetch_assoc ($consulta);

	$total=$result['cuenta'];
		  ?>
			{ y: <?php echo $total; ?> , name: '<?php echo $abre; ?>', exploded: true },
			  <?php } ?>
		]
	}]
});
chart.render();
}

function explodePie (e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
