<?php
include ("common.php");
include ("dbconnect.php");
navigation();

if ($_GET) {
        $id = $_GET['id'];
        if (!preg_match('/^[0-9]*$/', $id)) {
        print "that sux";
        exit;
        } else {
try {
     $result = $db->query("SELECT PON.ID, PON.SLOT_ID, PON.PORT_ID, INET_NTOA(OLT.IP_ADDRESS) as IP_ADDRESS from PON LEFT JOIN OLT on PON.OLT=OLT.ID where PON.ID = '$id'");
} catch (PDOException $e) {
        echo "Connection Failed:" . $e->getMessage() . "\n";
        exit;
}

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $pon_id = $row{'SLOT_ID'} . "000000" . $row{'PORT_ID'};
        $olt_ip_address = $row["IP_ADDRESS"];
        $rrd_name = dirname(__FILE__) . "/rrd/" . $olt_ip_address . "_" . $pon_id . "_traffic.rrd";

  $opts = array( "--start", "-1d", "--lower-limit=0", "--vertical-label=B/s", "--title=Daily Traffic",
                 "DEF:inoctets=$rrd_name:input:AVERAGE",
                 "DEF:outoctets=$rrd_name:output:AVERAGE",
                 "AREA:inoctets#00FF00:In traffic",
                 "LINE1:outoctets#0000FF:Out traffic\\r",
                 "CDEF:inbits=inoctets",
                 "CDEF:outbits=outoctets",
                 "GPRINT:inbits:LAST:Last In\: %6.2lf %SBps",
                 "GPRINT:inbits:AVERAGE:Avg In\: %6.2lf %SBps",
                 "COMMENT:  ",
                 "GPRINT:inbits:MAX:Max In\: %6.2lf %SBps\\r",
                 "COMMENT:\\n",
                 "GPRINT:outbits:LAST:Last Out\: %6.2lf %SBps",
                 "GPRINT:outbits:AVERAGE:Avg Out\: %6.2lf %SBps",
                 "COMMENT: ",
                 "GPRINT:outbits:MAX:Max Out\: %6.2lf %SBps\\r"
               );
  $opts2 = array( "--start", "-1w", "--lower-limit=0", "--vertical-label=B/s", "--title=Weekly Traffic",
                 "DEF:inoctets=$rrd_name:input:AVERAGE",
                 "DEF:outoctets=$rrd_name:output:AVERAGE",
                 "AREA:inoctets#00FF00:In traffic",
                 "LINE1:outoctets#0000FF:Out traffic\\r",
                 "CDEF:inbits=inoctets",
                 "CDEF:outbits=outoctets",
                 "GPRINT:inbits:LAST:Last In\: %6.2lf %SBps",
                 "GPRINT:inbits:AVERAGE:Avg In\: %6.2lf %SBps",
                 "COMMENT:  ",
                 "GPRINT:inbits:MAX:Max In\: %6.2lf %SBps\\r",
                 "COMMENT:\\n",
                 "GPRINT:outbits:LAST:Last Out\: %6.2lf %SBps",
                 "GPRINT:outbits:AVERAGE:Avg Out\: %6.2lf %SBps",
                 "COMMENT: ",
                 "GPRINT:outbits:MAX:Max Out\: %6.2lf %SBps\\r"
               );
  $opts3 = array( "--start", "-1m", "--lower-limit=0", "--vertical-label=B/s", "--title=Monthly Traffic",
                 "DEF:inoctets=$rrd_name:input:AVERAGE",
                 "DEF:outoctets=$rrd_name:output:AVERAGE",
                 "AREA:inoctets#00FF00:In traffic",
                 "LINE1:outoctets#0000FF:Out traffic\\r",
                 "CDEF:inbits=inoctets",
                 "CDEF:outbits=outoctets",
                 "GPRINT:inbits:LAST:Last In\: %6.2lf %SBps",
                 "GPRINT:inbits:AVERAGE:Avg In\: %6.2lf %SBps",
                 "COMMENT:  ",
                 "GPRINT:inbits:MAX:Max In\: %6.2lf %SBps\\r",
                 "COMMENT:\\n",
                 "GPRINT:outbits:LAST:Last Out\: %6.2lf %SBps",
                 "GPRINT:outbits:AVERAGE:Avg Out\: %6.2lf %SBps",
                 "COMMENT: ",
                 "GPRINT:outbits:MAX:Max Out\: %6.2lf %SBps\\r"
               );
  $rrd_traffic_url = $olt_ip_address . "_" . $pon_id . "_traffic.gif";
  $rrd_traffic_url_week = $olt_ip_address . "_" . $pon_id . "_traffic_week.gif";
  $rrd_traffic_url_month = $olt_ip_address . "_" . $pon_id . "_traffic_month.gif";
  $rrd_traffic = dirname(__FILE__) . "/rrd/" . $rrd_traffic_url;
  $rrd_traffic_week = dirname(__FILE__) . "/rrd/" . $rrd_traffic_url_week;
  $rrd_traffic_month = dirname(__FILE__) . "/rrd/" . $rrd_traffic_url_month;

  $ret = rrd_graph($rrd_traffic, $opts);
  $ret = rrd_graph($rrd_traffic_week, $opts2);
  $ret = rrd_graph($rrd_traffic_month, $opts3);

  if( !is_array($ret) )
  {
    $err = rrd_error();
    echo "rrd_graph() ERROR: $err\n";
  }
}
print "<center><h2>RRD Traffic Graphs for PON: $olt_ip_address :: $pon_id</h2> ";
print "<p><img src=\"rrd/" . $rrd_traffic_url . "\"></img></p>";
print "<p><img src=\"rrd/" . $rrd_traffic_url_week . "\"></img></p>";
print "<p><img src=\"rrd/" . $rrd_traffic_url_month . "\"></img></p>";
}
}
?>


