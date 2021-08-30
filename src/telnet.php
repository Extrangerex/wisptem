<?php
 header("Content-Type: text/plain");
/*
* RouterOS API
* Based on the code of SpectatorCN at http://forum.mikrotik.com/viewtopic.php?f=9&t=32957
* Modified by Ali Damji
* Free to modify, distribute, do whatever.
*
*/

define(TimeOut,125000);
# Basic Functions
function routeros_connect($host, $username, $password) {
global $fp;
   $header1=chr(0xFF).chr(0xFB).chr(0x1F).chr(0xFF).chr(0xFB).chr(0x20).chr(0xFF).chr(0xFB).chr(0x18).chr(0xFF).chr(0xFB).chr(0x27).chr(0xFF).chr(0xFD).chr(0x01).chr(0xFF).chr(0xFB).chr(0x03).chr(0xFF).chr(0xFD).chr(0x03).chr(0xFF).chr(0xFC).chr(0x23).chr(0xFF).chr(0xFC).chr(0x24).chr(0xFF).chr(0xFA).chr(0x1F).chr(0x00).chr(0x50).chr(0x00).chr(0x18).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x20).chr(0x00).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0x2C).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x27).chr(0x00).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x18).chr(0x00).chr(0x41).chr(0x4E).chr(0x53).chr(0x49).chr(0xFF).chr(0xF0);
   $header2=chr(0xFF).chr(0xFC).chr(0x01).chr(0xFF).chr(0xFC).chr(0x22).chr(0xFF).chr(0xFE).chr(0x05).chr(0xFF).chr(0xFC).chr(0x21);
   $fp=fsockopen($host,23);
   fputs($fp,$header1);
   usleep(125000);
   fputs($fp,$header2);
   usleep(125000);
   write_to_telnet($fp,$username."+ct");
   write_to_telnet($fp,$password);
   read_from_telnet($fp);
}

function routeros_cmd($command) {
global $fp;
	//$command = str_replace(";\n",';',$command);
	//echo $command."\n";
	$commands = explode("\n",$command);
	reset($commands);
	foreach ($commands as $cmd)
	{
		echo $cmd."\n";
		flush();
    	write_to_telnet($fp,trim($cmd));
    	echo read_from_telnet($fp)."\n";
   		flush();
	}
    return $rez;
}

# Telnet Related
function write_to_telnet($fp, $text){
    fputs($fp,$text."\r\n");
    usleep(TimeOut);
   return true;
}

function read_from_telnet($fp){
    $output = "";
    $count = 0;
    $count2 = 0;
    do{
        $char =fread($fp, 1);
        $output .= $char;
        if($char==">") $count++;
        if($count==1) break;
        if($char==".") $count2++;
        if($count2==3) break;
    } while(1==1);
    $output=preg_replace("/^.*?\n(.*)\n[^\n]*$/","$1",$output);
    $o=explode("\n",$output);
    for($i=1;$i<=count($o)-2;$i++) $op.=$o[$i]."\n";
    return $op;
}


$cmd = '
/ip firewall mangle
add action=mark-connection chain=forward comment="Marcado de ICMP" \
    new-connection-mark=icmp.conn passthrough=yes protocol=icmp \
    src-address-list=todos
add action=mark-packet chain=prerouting connection-mark=icmp.conn \
    new-packet-mark=icmp.pkt passthrough=no';

$ServerList [] = "192.168.85.1";

$Server = "192.168.85.1";
$Username 	= 'sysadmin';
$Pass 		= 'Emmanise40854085!';

foreach ($ServerList as $Server)
{
	routeros_connect($Server, $Username, $Pass);
	read_from_telnet($cmd);
	fclose($fp);
}


?>