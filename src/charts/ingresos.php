

<?php include('../config/db.php'); ?>
<?php


$meses = array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept','Oct','Nov','Dic');
for($x=1;$x<=12;$x=$x+1){
    $filas[$x]=0;
    $ingreso[$x]=0;
}

$anno=date('Y');
$total=0;
$sql=mysqli_query($con,"SELECT * FROM facturas");
while($row=mysqli_fetch_array($sql)){
    $y=date("Y", strtotime($row['fecha_factura']));

    $mes=(int)date("m", strtotime($row['fecha_factura']));

    if($y==$anno){
        $filas[$mes]=$filas[$mes]+1;

        $ingreso[$mes]=$ingreso[$mes]+$row['total_venta'];
    }
}
mysqli_close($con);
?>
<html>
<head>

    <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
    </script>
    <script type = "text/javascript">
        google.charts.load('current', {packages: ['corechart']});
    </script>
</head>

<body>
<div id = "con" style = "width: auto; height: 300px; margin: 0 auto">
</div>
<script language = "JavaScript">
    function drawChart() {
        // Define the chart to be drawn.
        var data = google.visualization.arrayToDataTable([
            ['Mes', 'Ingresos'],

            <?php
            for($x=1;$x<=12;$x=$x+1){
            ?>
            ['<?php echo $meses[$x]; ?>',  <?php echo $ingreso[$x] ?>],
            <?php } ?>
        ]);

        var options = {title: 'Ingresos en Peso Dominicano'};

        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('con'));
        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(drawChart);
</script>
</body>
</html>