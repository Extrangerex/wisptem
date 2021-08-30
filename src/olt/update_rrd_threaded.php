<?php

include("classes/db_connect_class.php");
include ("classes/snmp_class.php");

class WorkerThreads extends Thread
{
    private $olt_ip_address;
	private $sn;
	public $error;
    public function __construct($olt_ip)
    {
        $this->olt_ip_address = $olt_ip;
    }
 
	public function run() {
		$snmp_obj = new snmp_oid();
		try {
			$conn = db_connect::getInstance();
			$result = $conn->db->query("SELECT CUSTOMERS.ID, CUSTOMERS.NAME, CUSTOMERS.ADDRESS, SN, SERVICE_PROFILE.PORTS, SERVICE_PROFILE.HGU, SERVICE_PROFILE.RF, OLT.NAME as OLT_NAME, INET_NTOA(OLT.IP_ADDRESS) as IP_ADDRESS, OLT.RO as RO, OLT_MODEL.TYPE, PON.NAME as PON_NAME, PON.PORT_ID as PORT_ID, PON.SLOT_ID as SLOT_ID, PON.CARDS_MODEL_ID, CARDS_MODEL.PON_TYPE, PON_ONU_ID from CUSTOMERS LEFT JOIN SERVICES on CUSTOMERS.SERVICE=SERVICES.ID LEFT JOIN SERVICE_PROFILE on SERVICES.SERVICE_PROFILE_ID=SERVICE_PROFILE.ID LEFT JOIN OLT on CUSTOMERS.OLT=OLT.ID LEFT JOIN OLT_MODEL on OLT.MODEL=OLT_MODEL.ID LEFT JOIN PON on CUSTOMERS.PON_PORT=PON.ID LEFT JOIN CARDS_MODEL on PON.CARDS_MODEL_ID=CARDS_MODEL.ID where INET_NTOA(OLT.IP_ADDRESS)='$this->olt_ip_address'");
		} catch (PDOException $e) {
			echo "Connection Failed:" . $e->getMessage() . "\n";
			exit;
		}
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$pon_type = $row{'PON_TYPE'};
			$hgu = $row{'HGU'};
			$catv_input_id = $row{'SLOT_ID'} * 10000000 + $row{'PORT_ID'} * 100000 + $row{'PON_ONU_ID'} * 1000 + 160;	
			$rf = $row{'RF'};
			$sn = $row["SN"];
			$big_onu_id = $snmp_obj->type2id($row{'SLOT_ID'}, $row{'PORT_ID'}, $row{'PON_ONU_ID'});
			$big_onu_id_2 = $row{'SLOT_ID'} * 10000000 + $row{'PORT_ID'} * 100000 + $row{'PON_ONU_ID'};
			if ($row{'PON_TYPE'} == "GPON") {
				if ($row{'PON_ONU_ID'} < 100) {
					$index_2 = 10000000 * $row{'SLOT_ID'} + 100000 * $row{'PORT_ID'} + 1000 * $row{'PON_ONU_ID'} + 1;
				}else{
					$index_2 = (3<<28)+(10000000 * $row{'SLOT_ID'} + 100000 * $row{'PORT_ID'} + 1000 * ($row{'PON_ONU_ID'}%100) + 1);
				}		
			}
			if ($row{'PON_TYPE'} == "EPON") {
				$index_2 = $row{'SLOT_ID'} * 10000000 + $row{'PORT_ID'} * 100000 + $row{'PON_ONU_ID'};
			}
			$olt_ip_address = $row["IP_ADDRESS"];	
			$rrd_traffic = dirname(__FILE__) . "/rrd/" . $sn . "_traffic.rrd"; 
			$error = "0";
			if(!is_file($rrd_traffic))
				$error = "1";
			$rrd_unicast = dirname(__FILE__) . "/rrd/" . $sn . "_unicast.rrd";
			if(!is_file($rrd_unicast))
				$error = "1";
			$rrd_broadcast = dirname(__FILE__) . "/rrd/" . $sn . "_broadcast.rrd";
			if(!is_file($rrd_broadcast))
				$error = "1";
			$rrd_multicast = dirname(__FILE__) . "/rrd/" . $sn . "_multicast.rrd";
			if(!is_file($rrd_multicast))
				$error = "1";
			if ($error == "1") {
				$customers_obj = new customers();
				$customers_obj->setSn($sn);
				$error = $customers_obj->onu_traffic_rrd();
				if (!empty($error)) {
					return $error;
				}
			}
			$error = "0";
			$rrd_power = dirname(__FILE__) . "/rrd/" . $sn . "_power.rrd";
			if(!is_file($rrd_power)) {
				$customers_obj = new customers();
				$customers_obj->setSn($sn);
				$error = $customers_obj->onu_power_rrd();
				if (!empty($error)) {
					return $error;
				}
			}
			
			$total_input_traffic = 0;
			$total_output_traffic = 0;
			$multicast_in = 0;
			$multicast_out = 0;
			if ($row{'PON_TYPE'} == "EPON") {
				$traffic_in_oid = $snmp_obj->get_pon_oid("ifHCInOctets", "OLT") . "." . $big_onu_id;
				$traffic_out_oid = $snmp_obj->get_pon_oid("ifHCOutOctets", "OLT") . "." . $big_onu_id;
				//Unicast
				$unicast_in_oid = $snmp_obj->get_pon_oid("ifHCInUcastPkts", "OLT") . "." . $big_onu_id;
				$unicast_out_oid = $snmp_obj->get_pon_oid("ifHCOutUcastPkts", "OLT") . "." . $big_onu_id;
				//Broadcast
				$broadcast_in_oid = $snmp_obj->get_pon_oid("ifHCInBroadcastPkts", "OLT") . "." . $big_onu_id;
				$broadcast_out_oid = $snmp_obj->get_pon_oid("ifHCOutBroadcastPkts", "OLT") . "." . $big_onu_id;
				//Multicast
				$multicast_in_oid = $snmp_obj->get_pon_oid("ifHCInMulticastPkts", "OLT") . "." . $big_onu_id;
				$multicast_out_oid = $snmp_obj->get_pon_oid("ifHCOutMulticastPkts", "OLT") . "." . $big_onu_id;
			}
			
			$status_oid = $snmp_obj->get_pon_oid("onu_status_oid", $row{'PON_TYPE'}) . "." . $big_onu_id;
			//Power
			$recv_power_oid = $snmp_obj->get_pon_oid("onu_recv_power_oid", $row{'PON_TYPE'}) . "." . $index_2;
			$send_power_oid = $snmp_obj->get_pon_oid("onu_send_power_oid", $row{'PON_TYPE'}) . "." . $index_2;
			//OLT RX Power
			$olt_rx_power_oid = $snmp_obj->get_pon_oid("olt_rx_power_oid", $row{'PON_TYPE'}) . "." . $big_onu_id;
			// RF Power
			$rf_input_power_oid = $snmp_obj->get_pon_oid("onu_rf_rx_power_oid", $row{'PON_TYPE'}) . "." . $catv_input_id;
			//Ethernet Ports of ONU
			$octets_in_ethernet = $snmp_obj->get_pon_oid("uni_octets_in_ethernet_oid", $row{'PON_TYPE'}) . ".";
			$octets_out_ethernet = $snmp_obj->get_pon_oid("uni_octets_out_ethernet_oid", $row{'PON_TYPE'}) . ".";
				
			$status = "0";
			//GET STATUS via SNMP
			snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
			$status_oid = $snmp_obj->get_pon_oid("onu_status_oid", $row{'PON_TYPE'}) . "." . $big_onu_id;
			$session = new SNMP(SNMP::VERSION_2C, $row{'IP_ADDRESS'}, $row{'RO'});
			$status = $session->get($status_oid);	
			
			if ($status == "1") {
				$session = new SNMP(SNMP::VERSION_2C, $row{'IP_ADDRESS'}, $row{'RO'});
		/*		$ret = rrd_update($rrd_traffic, array("N:$total_input_traffic:$total_output_traffic"));
				if( $ret == 0 )
				{
					$err = rrd_error();
					echo "ERROR occurred: $err\n";
				}
		*/
				$olt_rx_power = $session->get($olt_rx_power_oid);
				$olt_rx_power = round($olt_rx_power/10,4);
				if ($row{'PON_TYPE'} == "GPON") {
				$recv_power = $session->get($recv_power_oid);
				$recv_power = round(($recv_power-15000)/500,4);
				$send_power = $session->get($send_power_oid);
				$send_power = round(($send_power-15000)/500,4);
				}
				if ($row{'PON_TYPE'} == "EPON") {
					$recv_power = $session->get($recv_power_oid);
					$recv_power = round(10*log10($recv_power/10000),4);
					$send_power = $session->get($send_power_oid);
					$send_power = round(10*log10($send_power/10000),4);
					$total_input_traffic = $session->get($traffic_in_oid);
					
					
					
					$total_output_traffic = $session->get($traffic_out_oid);
					$ret = rrd_update($rrd_traffic, array("N:$total_input_traffic:$total_output_traffic"));
					if( $ret == 0 )
					{
						$err = rrd_error();
						echo "ERROR occurred: $err\n";
					}
					$unicast_in = $session->get($unicast_in_oid);
					$unicast_out = $session->get($unicast_out_oid);
					$ret = rrd_update($rrd_unicast, array("N:$unicast_in:$unicast_out"));
					if( $ret == 0 )
					{
						$err = rrd_error();
						echo "ERROR occurred: $err\n";
					}
					$broadcast_in = $session->get($broadcast_in_oid);
					$broadcast_out = $session->get($broadcast_out_oid);
					$ret = rrd_update($rrd_broadcast, array("N:$broadcast_in:$broadcast_out"));
					if( $ret == 0 )
					{
						$err = rrd_error();
						echo "ERROR occurred: $err\n";
					}

					$multicast_in = $session->get($multicast_in_oid);
					$multicast_out = $session->get($multicast_out_oid);
					$ret = rrd_update($rrd_multicast, array("N:$multicast_in:$multicast_out"));
					if( $ret == 0 )
					{
						$err = rrd_error();
						echo "ERROR occurred: $err\n";
					}
				}
				if ($rf == "Yes" && $row{'PON_TYPE'} == "EPON") {
					$rf_input_power = $session->get($rf_input_power_oid);
					$rf_input_power = round($rf_input_power/10,4);
					$ret = rrd_update($rrd_power, array("N:$recv_power:$send_power:$olt_rx_power:$rf_input_power"));
				} else {
					$ret = rrd_update($rrd_power, array("N:$recv_power:$send_power:$olt_rx_power:0"));
				}
				if( $ret == 0 )
				{
					$err = rrd_error();
					echo "ERROR occurred: $err\n";
				}
								if ($hgu !== "Yes") {
					for ($i=1; $i <= $row{'PORTS'}; $i++) {
						$ethernet_id = $row{'SLOT_ID'} * 10000000 + $row{'PORT_ID'} * 100000 + $row{'PON_ONU_ID'} * 1000 + $i;
						$octets_ethernet = dirname(__FILE__) . "/rrd/" . $sn . "_" . $i . ".rrd";
						if(!is_file($octets_ethernet)) {
							$opts = array( "--step", "300", "--start", "0",
							   "DS:input:DERIVE:600:0:U",
							   "DS:output:DERIVE:600:0:U",
							   "RRA:AVERAGE:0.5:1:600",
							   "RRA:AVERAGE:0.5:6:700",
							   "RRA:AVERAGE:0.5:24:775",
							   "RRA:AVERAGE:0.5:288:797",
							   "RRA:MAX:0.5:1:600",
							   "RRA:MAX:0.5:6:700",
							   "RRA:MAX:0.5:24:775",
							   "RRA:MAX:0.5:288:797"
							);
							$ret = rrd_create($octets_ethernet, $opts);

							if( $ret == 0 )
							{
								$err = rrd_error();
								return $err;
							}	
						}
						
						
						$octets_in_ethernet_id = $octets_in_ethernet . $ethernet_id;
						$octets_out_ethernet_id = $octets_out_ethernet . $ethernet_id;
						$octets_in_ethernet_val = $session->get($octets_in_ethernet_id);
						$octets_out_ethernet_val = $session->get($octets_out_ethernet_id);
						$ret = rrd_update($octets_ethernet, array("N:$octets_in_ethernet_val:$octets_out_ethernet_val"));
						if( $ret == 0 )
						{
							$err = rrd_error();
							echo "ERROR occurred: $err\n";
						}
					}
				}
			}
		}
		try {
			$conn = db_connect::getInstance();
			$result = $conn->db->query("SELECT PON.ID, PON.SLOT_ID, PON.PORT_ID, INET_NTOA(OLT.IP_ADDRESS) as IP_ADDRESS, OLT.RO from PON LEFT JOIN OLT on PON.OLT=OLT.ID where INET_NTOA(OLT.IP_ADDRESS)='$this->olt_ip_address'");
		} catch (PDOException $e) {
			echo "Connection Failed:" . $e->getMessage() . "\n";
			exit;
		}
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$ip_address = $row{'IP_ADDRESS'};
			$status_oid = "1.3.6.1.2.1.1.3.0";
			snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
			$session = new SNMP(SNMP::VERSION_2C, $row{'IP_ADDRESS'}, $row{'RO'});
			$status = $session->get($status_oid);
			if (isset($status)) {
				$port = $snmp_obj->type2ponid($row{'SLOT_ID'},$row{'PORT_ID'});
				echo $port . "\n";
				$rrd_name = dirname(__FILE__) . "/rrd/" . $ip_address . "_" . $row{'SLOT_ID'} . "000000" . $row{'PORT_ID'} . "_traffic.rrd";
				$rrd_unicast = dirname(__FILE__) . "/rrd/" . $olt_ip_address . "_" . $row{'SLOT_ID'} . "000000" . $row{'PORT_ID'} . "_unicast.rrd";
				$rrd_broadcast = dirname(__FILE__) . "/rrd/" . $olt_ip_address . "_" . $row{'SLOT_ID'} . "000000" . $row{'PORT_ID'} . "_broadcast.rrd";
				$rrd_multicast = dirname(__FILE__) . "/rrd/" . $olt_ip_address . "_" . $row{'SLOT_ID'} . "000000" . $row{'PORT_ID'} . "_multicast.rrd";
				$first_oid = "1.3.6.1.2.1.31.1.1.1.6." . $port;
				$second_oid = "1.3.6.1.2.1.31.1.1.1.10." . $port;
				//Unicast
				$unicast_in_oid = "1.3.6.1.2.1.2.2.1.11." . $port;
				$unicast_out_oid = "1.3.6.1.2.1.2.2.1.17." . $port;
				//Broadcast
				$broadcast_in_oid = "1.3.6.1.2.1.31.1.1.1.3." . $port;
				$broadcast_out_oid = "1.3.6.1.2.1.31.1.1.1.5." . $port;
				//Multicast
				$multicast_in_oid = "1.3.6.1.2.1.31.1.1.1.2." . $port;
				$multicast_out_oid = "1.3.6.1.2.1.31.1.1.1.4." . $port;

				$session = new SNMP(SNMP::VERSION_2C, $row{'IP_ADDRESS'}, $row{'RO'});
				$total_input_traffic = $session->get($first_oid);
				$total_output_traffic = $session->get($second_oid);
				$ret = rrd_update($rrd_name, array("N:$total_input_traffic:$total_output_traffic"));
				$unicast_in = $session->get($unicast_in_oid);
				$unicast_out = $session->get($unicast_out_oid);
				$ret = rrd_update($rrd_unicast, array("N:$unicast_in:$unicast_out"));
				if( $ret == 0 )
				{
					$err = rrd_error();
					echo "ERROR occurred: $err\n";
				}

				$broadcast_in = $session->get($broadcast_in_oid);
				$broadcast_out = $session->get($broadcast_out_oid);
				$ret = rrd_update($rrd_broadcast, array("N:$broadcast_in:$broadcast_out"));
				if( $ret == 0 )
				{
					$err = rrd_error();
					echo "ERROR occurred: $err\n";
				}
				
				$multicast_in = $session->get($multicast_in_oid);
				$multicast_out = $session->get($multicast_out_oid);
				$ret = rrd_update($rrd_multicast, array("N:$multicast_in:$multicast_out"));
				if( $ret == 0 )
				{
					$err = rrd_error();
					echo "ERROR occurred: $err\n";
				}
			}
		}
	}
}
try {
	$conn = db_connect::getInstance();
	$result = $conn->db->query("SELECT ID, NAME, MODEL, INET_NTOA(IP_ADDRESS) as IP_ADDRESS, RO, RW from OLT");
} catch (PDOException $e) {
	echo "Connection Failed:" . $e->getMessage() . "\n";
	exit;
}
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	$ip_address = $row["IP_ADDRESS"];
	$olt_status_oid = $snmp_obj->get_pon_oid("olt_status_oid", "OLT");
	snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
	$session = new SNMP(SNMP::VERSION_2C, $row{'IP_ADDRESS'}, $row{'RO'});
	$olt_status = $session->get($olt_status_oid);
	if (!empty($olt_status)) {
		${"workers" . $row["ID"]} = new WorkerThreads($row["IP_ADDRESS"]);
		${"workers" . $row["ID"]}->start();
		${"workers" . $row["ID"]}->join();
	}
}
/*
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	${"workers" . $row["ID"]}->join();
}
*/





?>
 