<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="span6">
			<div class="container">
			    <div class="row">
			        <div class="col-md-5">
			            <div class="panel panel-primary">
			                <div class="panel-heading">
			                    <span class="glyphicon glyphicon-comment"></span> Chat
			                </div>
			                <div class="panel-body">
			                    <ul id="message_box" class="chat">
			                       
			                    </ul>
			                </div>
			                <div class="panel-footer">
			                    <div class="input-group">
			                    <input style="width:100px" id="name"      type="text" class="form-control input-sm" name="name"  placeholder="Your Name" maxlength="10"   />
								<input style="width:180px" id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
			                        <span class="input-group-btn">
			                            <button class="btn btn-warning btn-sm" id="btn-chat">
			                                Send</button>
			                        </span>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

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
		$('#message').val(''); //reset text
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

	$('#btn-chat').click(function(){ 
		var mymessage = $('#btn-input').val();  //get message text
		var myname = $('#name').val(); //get user name
		
		if(myname == ""){ //empty name?
			alert("Enter your Name please!");
			return;
		}
		if(mymessage == ""){ //emtpy message?
			alert("Enter Some message Please!");
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

</script>
</body>
</html>
