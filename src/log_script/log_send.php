<?php
//// Script: Nicolas Daitsch 24 de noviembre de 2011
//// http://tech-nico.com/blog

////////////// CONFIGURACION ////////////////////////// 
$sendto = "Webmaster <tuemail@gmail.com>"; // DESTINO 
$sendfrom = "Log Diario Servidor <logs@tuempresa.com>"; // ORIGEN 
$sendsubject = "Log Diario mi servidor"; // ASUNTO 
$bodyofemail = "Aca esta el log que genero el Crontab."; // MENSAJE 
$COMANDO_LINUX = "tail /var/log/syslog"; // COMANDO 
////////////////////////////////////////////////////////

    $backupfile = "syslog_". date("Y-m-d") . '.txt';
    system($COMANDO_LINUX > $backupfile);
    include('Mail.php');
    include('Mail/mime.php');

    $message = new Mail_mime();
    $text = "$bodyofemail";
    $message->setTXTBody($text);
    $message->AddAttachment($backupfile);
    $body = $message->get();
    $extraheaders = array("From"=>"$sendfrom", "Subject"=>"$sendsubject");
    $headers = $message->headers($extraheaders);
    $mail = Mail::factory("mail");
    $mail->send("$sendto", $headers, $body);

    //unlink($backupfile);
?>