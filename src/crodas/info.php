<?php
date_default_timezone_set("America/Santo_Domingo");

require  "vendor/autoload.php";
$host = '192.168.84.200';
$date = date('Y-m-d');
foreach (glob(dirname(__FILE__) . '/lib/InfluxPHP/*.php') as $sFile) {
    require_once $sFile;
}
class Database
{
    protected $db;
    //crodas\InfluxPHP\DB
    public function __construct($sHost = "localhost", $iPort = 8086, $sUser = 'jitech', $sPassword = 'Jitech40854085', $bCheckExistence = true)
    {
        $client = new crodas\InfluxPHP\Client($sHost, $iPort, $sUser, $sPassword);
        if ($bCheckExistence) {
            $aDBs = $client->getDatabases();
            if (isset($aDBs)) {
                foreach ($aDBs as $oDB) {
                    if ($oDB->getName() == 'iws') {
                        print "iws database exists - skipping creation..\n";
                        $this->db = $oDB;
                        return;
                    }
                }
            }
            print "creating missing database for iws ts data..\n";
            $this->db = $client->createDatabase("iws");
            $client->grantPrivilege(crodas\InfluxPHP\Client::PRIV_ALL, "iws", "iws");
        } else {
            $this->db = $client->getDatabase("iws");
        }
    }
    public function insert($name, array &$data)
    {
        $this->db->insert($name, $data);
    }
    public function query($sQuery)
    {
        return $this->db->query($sQuery);
    }
    public function execute($sQuery)
    {
        $this->db->query($sQuery);
    }
}

$client = new \crodas\InfluxPHP\Client();

$db = $client->getDatabase("ntopng");
$result = $db->query()
->select('*')
    ->from('host:traffic')
    ->where(["time > now() - 1d and host = '$cliente' "]);

echo json_encode($result);

?>