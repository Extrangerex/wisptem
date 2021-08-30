<?php 

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado


require_once("config/db.php");
$id = intval($_GET['id']);
$sql      = "SELECT * FROM  clientesp where id=$id";
$query    = mysqli_query($con, $sql);
$row      = mysqli_fetch_array($query);
$nombre   = $row['nombres'];
$apellido = $row['apellido'];
$monto = $row['pago_total'];
$nombres  = "$nombre $apellido";
 $fecha = $row['fecha_final'];
    $fec = date("Y-m-d",strtotime($fecha."+ 6days"));
     $end = date("Y-m-d 00:00:00",strtotime($fecha."+ 7days"));

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
   <meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="Israel Junior" content="">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <title>JIB TECHNO SOLUTIONS</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/full-width-pics.css" rel="stylesheet">
  
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body class="py-5 bg-image-full" style="background-image: url('images/fondos.jpg');">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">JIB TECHNO SOLUTIONS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header - set the background image for the header in the line below -->
    <header class="py-5 bg-image-full" style="background-image: url('images/banner.jpg');">
      <img class="img-fluid d-block mx-auto" src="images/logo1.png" width="160px" height="120px"  alt="">
    </header>
    <!-- Content section -->
    <section class="py-5">
      <input type="hidden" name="fecfin" id="fecfin" value="<?php echo $end; ?>">
      <div class="container">
        <legend style="color: black;">Aviso !</legend>
        <h3  style="color: red;">
        <b>Estimado(a),  <?php echo $nombres; ?>, se ha generado la factura de este mes por un monto de RD $<?php echo $monto ?> y vence el  <?php echo $fec; ?>  .
        <br>
        Acérquese a JI VIDEO GAMES ubicado en la calle 6 esquina 3 de Korea al lado de LAVADORA ELECTI para Regularizar el Pago Respectivo.
        <br>
        O comuniquese al Télefono (829)-815-5818!
        </br>
        <br>
        Fecha de corte programado:  <?php echo $end; ?> 


    </h3>

  

      </div>
    </section>
    <!-- Image Section - set the background image for the header in the line below -->
    <section class="py-3 bg-image-full">
      <div align="center"> <img src="images/corte-internet2.png" width="600px" height="300px"></div>
      <div style="height: 10px; width: 100px"></div>
    </section>
    <!-- Content section -->
    
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; JIB TECNO SOLUTIONS 2021</p>
      </div>
      <!-- /.container -->
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript">
  
  $(document).ready(function(){
  
  //create a new WebSocket object.
  var wsUri = "ws://200.50.0.200:5050";
  websocket = new WebSocket(wsUri);
  var myip;
  // El evento se produce cuando se establece la conexión
  websocket.onopen = function(ev) {
  $('#message_box').append(createLi('','System','conectado.png','Connected !!!'));
  };
  // El evento se produce cuando hay un error
  websocket.onerror = function(ev){
  $('#message_box').append(createLi('','System','error.png','Error Occurred '+ev.data));
  };
  // El evento se produce cuando la conexión se cierra desde el servidor
  websocket.onclose = function(ev){
  $('#message_box').append(createLi('','System','desconectado.png','Connection Closed'));
  };
  // El evento se produce cuando el cliente recibe datos del servidor
  websocket.onmessage = function(ev) {
  var msg = JSON.parse(ev.data); //PHP sends Json data
  var date = msg.date;
  var type = msg.type; //message type
  var umsg = msg.message; //message text
  var uname = msg.name; //user name
  if(!uname){
  uname ='system' ;
  }
  $('#message_box').append(createMessage (date,type,umsg,uname)) ;
  $('#btn-input').val(''); //reset text
  };
  function createMessage (date,type,msg,username) {
  
  var img = 'chrome.png';
  var myname = $('#name').val(); //get user name
  
  if(username == myname){
  img = 'firefox.png';
  }
  if(username == 'system'){
  var img = 'conectado.png';
  if(type=='desconectado'){
  img = 'desconectado.png';
  }
  }
  return createLi(date,username,img,msg) ;
  }
  function createLi(date,username,img,text)
  {
  if(text)
  {
  var li = $(' <li class="left clearfix"><span class="chat-img pull-left"><img src="'+img+'" alt="User Avatar" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+date+' '+username+'</strong> </div><p>'+text+'</p></div></li>');
  var myname = $('#name').val(); //get user name
  if(username == myname){
  li = $(' <li class="right clearfix"><span class="chat-img pull-right"><img src="'+img+'" alt="User Avatar" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+date+' '+username+'</strong> </div><p>'+text+'</p></div></li>');
  }
  return li;
  }
  return "";
  }
  $('#btn-input').keypress(function(e) {
  var keycode = (e.keyCode ? e.keyCode : e.which);
  if (keycode == '13') {
  
  var mymessage = $('#btn-input').val();  //get message text
  var myname = $('#name').val(); //get user name
  
  
  if(myname == ""){ //emtpy user?
  
  alert("Ingrese su nombre!");
  $('#name').attr("autofocus",true);
  return;
  }
  if(mymessage == ""){ //emtpy message?
  
  alert("Escribe su mensaje!");
  return;
  }
  
  //prepare json data
  var msg = {
  message: mymessage,
  name: myname,
  };
  
  //convert and send data to server
  websocket.send(JSON.stringify(msg));
  return false;
  }
  });
  $('#btn-chat').click(function(){
  var mymessage = $('#btn-input').val();  //get message text
  var myname = $('#name').val(); //get user name
  
  
  if(myname == ""){ //emtpy user?
  
  alert("Ingrese su nombre!");
  $('#name').attr("autofocus",true);
  return;
  }
  if(mymessage == ""){ //emtpy message?
  
  alert("Escribe su mensaje!");
  return;
  }
  
  //prepare json data
  var msg = {
  message: mymessage,
  name: myname,
  };
  
  //convert and send data to server
  websocket.send(JSON.stringify(msg));
  });
  });
  function pulsar(e) {
  if (e.keyCode === 13 && !e.shiftKey) {
  e.preventDefault();
  var boton = document.getElementById("btn-chat");
  angular.element(boton).triggerHandler('click');
  }
  }
  </script>
</html>
<style> 
body{ 
    text-align: center; 
    background: #00ECB9; 
  font-family: sans-serif; 
  font-weight: 70; 
} 
h1{ 
  color: #396; 
  font-weight: 70; 
  font-size: 40px; 
  margin: 40px 0px 20px; 
} 
 #clockdiv{ 
    font-family: sans-serif; 
    color: #fff; 
    display: inline-block; 
    font-weight: 70; 
    text-align: center; 
    font-size: 10px; 
} 
#clockdiv > div{ 
    padding: 10px; 
    border-radius: 3px; 
    background: #00BF96; 
    display: inline-block; 
} 
#clockdiv div > span{ 
    padding: 15px; 
    border-radius: 3px; 
    background: #00816A; 
    display: inline-block; 
} 
smalltext{ 
    padding-top: 5px; 
    font-size: 10px; 
} 
</style> 
<script> 
   var end = '<?php echo $end; ?>';

  
var deadline = new Date(end).getTime();
  
var x = setInterval(function() { 
  
var now = new Date().getTime(); 
var t = deadline - now; 
var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
var seconds = Math.floor((t % (1000 * 60)) / 1000); 
document.getElementById("day").innerHTML =days ; 
document.getElementById("hour").innerHTML =hours; 
document.getElementById("minute").innerHTML = minutes;  
document.getElementById("second").innerHTML =seconds;  
if (t < 0) { 
        clearInterval(x); 
        document.getElementById("demo").innerHTML = "TIME UP"; 
        document.getElementById("day").innerHTML ='0'; 
        document.getElementById("hour").innerHTML ='0'; 
        document.getElementById("minute").innerHTML ='0' ;  
        document.getElementById("second").innerHTML = '0'; } 
}, 1000); 
</script> 