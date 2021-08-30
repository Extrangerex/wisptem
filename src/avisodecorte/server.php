<?php
$host = '200.50.0.200'; //host
$port = '5050'; //port
$null = NULL; //null var

// Create TCP/IP sream socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// reuseable port
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);

// bind socket to specified host
socket_bind($socket, $host, $port);

// listen to port
socket_listen($socket);

// create & add listening socket to the list
$clientes = array();

echo 'Server status On';

//start endless loop, so that our script doesn't stop
while (true) {
	//manage multipal connections
	$changed=array();
	$changed[]=$socket;
	$changed=array_merge($changed,$clientes);
	
	//returns the socket resources in $changed array
	$socketsCambiados=socket_select($changed, $null, $null, 5);
	if($socketsCambiados==0)
	{
		continue;
	}

	//check for new socket
	if(in_array($socket, $changed))
	{
		if (($socket_new = socket_accept($socket)) === false) {
			echo "socket_accept() falló: razón: " . socket_strerror(socket_last_error($socket)) . "\n";
			break;
		}
		if(!in_array($socket_new,$clientes))
		{
			$clientes[] = $socket_new; //add socket to client array
		}
		
		$header = socket_read($socket_new, 1024, PHP_BINARY_READ); //read data sent by the socket
		perform_handshaking($header, $socket_new, $host, $port); //perform websocket handshake
		
		// get ip address of connected socket
		socket_getpeername($socket_new, $customerIp, $customerPort);
		
		// prepare json data
		$response = mask(json_encode(array('date'=>date("d/m/Y H:m:s"), 'type'=>'system', 'message'=>$customerIp.':'.$customerPort.' connected')));
		send_message($response); //notify all users about new connection
		echo "\nEntra $customerIp:$customerPort\n";
		
		//make room for new socket
		$found_socket = array_search($socket, $changed);
		unset($changed[$found_socket]);
	}

	//loop through all connected sockets
	foreach ($changed as $changed_socket)
	{
		//check for any incomming data
		while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
		{
			$received_text = unmask($buf); //unmask data
			$tst_msg = json_decode($received_text); //json decode
			if(isset($tst_msg->name))
			{
				$user_name = $tst_msg->name; //sender name
				$user_message = $tst_msg->message; //message text
			}

			//prepare data to be sent to client
			$response_text = mask(json_encode(array('date'=>date("d/m/Y H:m:s"), 'type'=>'msg', 'name'=>$user_name, 'message'=>$user_message)));
			send_message($response_text);
			break 2;
		}
		
		$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
		if ($buf === false)
		{	// check disconnected client
			// remove client for $clientes array
			$found_socket = array_search($changed_socket, $clientes);
			unset($clientes[$found_socket]);
			@socket_getpeername($changed_socket, $customerIp);
			
			//notify all users about disconnected connection
			$response = mask(json_encode(array('date'=>date("d/m/Y H:m:s"), 'type'=>'system', 'message'=>$customerIp.' disconnected')));
			echo "\nSale $customerIp:$customerPort\n";
			send_message($response);
		}
	}
}
// close the listening socket
socket_close($socket);
echo 'Server status Off' ;

/**
 * function to send message to all users connected
 * Most receive:
 *	$msg - message in format json
 */
function send_message($msg)
{
	global $clientes;
	foreach($clientes as $client)
	{
		socket_write($client,$msg,strlen($msg));
	}
	return true;
}


// Unmask incoming framed message
function unmask($text)
{
// 	echo "\n1 umask:".$text;
	$length = ord($text[1]) & 127;
	if($length == 126) {
		$masks = substr($text, 4, 4);
		$data = substr($text, 8);
	}elseif($length == 127) {
		$masks = substr($text, 10, 4);
		$data = substr($text, 14);
	}else{
		$masks = substr($text, 2, 4);
		$data = substr($text, 6);
	}
	$text = "";
	for ($i = 0; $i < strlen($data); ++$i) {
		$text .= $data[$i] ^ $masks[$i%4];
	}
// 	echo "\n2 umask:".$text;
	return $text;
}

// Encode message for transfer to client.
function mask($text)
{
	$b1 = 0x80 | (0x1 & 0x0f);
	$length = strlen($text);
	
	if($length <= 125)
		$header = pack('CC', $b1, $length);
	elseif($length > 125 && $length < 65536)
		$header = pack('CCn', $b1, 126, $length);
	elseif($length >= 65536)
		$header = pack('CCNN', $b1, 127, $length);
// 	echo "\nmask:".$header.$text;
	return $header.$text;
}

/**
 * Function to return the header for handshaking
 * Most receive:
 *	$received_header - header received in the coneccition from user
 *	$customerSocket - socket from customer
 *	$host - host from server
 *	$port - port from server
 */
function perform_handshaking($received_header,$customerSocket, $host, $port)
{
	$headers = array();
	$lines = preg_split("/\r\n/", $received_header);
	foreach($lines as $line)
	{
		if(preg_match('/\A(\S+): (.*)\z/', trim($line), $matches))
		{
			$headers[$matches[1]] = $matches[2];
		}
	}

	$secKey = $headers['Sec-WebSocket-Key'];
	$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
	//hand shaking header
	$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"WebSocket-Origin: $host\r\n" .
	"WebSocket-Location: ws://$host:$port\r\n".
	"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
	socket_write($customerSocket,$upgrade,strlen($upgrade));
}
