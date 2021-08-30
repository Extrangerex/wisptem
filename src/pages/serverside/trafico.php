
<?php 

require_once ("../../config/db.php");
$ip = $_GET['ip'];
$date = date('Y-m-d');

$meses = array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sept','Oct','Nov','Dic');
for($x=1;$x<=7;$x=$x+1){
    $filas[$x]=0;
    $subida[$x]=0;
    $bajada[$x]=0;
}

$mes=date('m');
$total=0;
$sql=mysqli_query($con,"SELECT * from trafico where ip='$ip' and fecha  > DATE_SUB(NOW(), INTERVAL 7 DAY) ");
while($row=mysqli_fetch_array($sql)){
    $m=date("m", strtotime($row['fecha']));

    $dia=(int)date("d", strtotime($row['fecha']));
 

    if($m==$mes){
        $subida[$dia]=$subida[$dia]+1;
         $bajada[$dia]=$bajada[$dia]+1;

        $subida[$dia]=$subida[$dia]+$row['subida'];
        $bajada[$dia]=$bajada[$dia]+$row['descarga'];
        
        
    }

}
mysqli_close($con);

?>

 <script type="text/javascript" src="../js/loader.js"></script>
 
  <script type="text/javascript">
      var data = [
        <?php
            for($x=1;$x<=7;$x=$x+1){
            ?>

      { y: '2014', a:  <?php echo $subida[$x] ?>, b:  <?php echo $bajada[$x] ?>},
      
      <?php } ?>
    ],
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Subida', 'Bajada'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['gray','red']
  };

config.element = 'stacked';
config.stacked = true;
Morris.Bar(config);

    </script>

</head>

<body>
	<div id="stacked" style="width: 90%; height: 500px;"></div>
</body>
