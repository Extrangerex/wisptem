<?php
/**
 * Created by PhpStorm.
 * User: Liang
 * Date: 16-9-28
 * Time: 下午1:41
 */

namespace OLT;
require_once('Telnet.php'); //引入Telnet类

class OLT
{


    /**
     * 中兴OLT
     * @param $ip
     * @param $username
     * @param $password
     * @param $mac
     * @param $device
     * @return string
     */
    public function zte($ip, $username, $port, $password)
    {
        preg_match('/[0-9a-fA-F]{4}.[0-9a-fA-F]{4}.[0-9a-fA-F]{4}/', $mac, $isMac);
        //验证是否为有效MAC地址
        if (!$isMac) {
            $result['status'] = false;
            $result['msg']['info'] = 'MAC输入有误';
            return $result;
        }
        $telnet = new \Telnet\Telnet($ip, $port);
        $telnet->read_till(": ");
        $telnet->write("$username\r\n");
        $telnet->read_till(": ");
        $telnet->write("$password\r\n");
        $telnet->read_till("#");
        $telnet->write("conf t\r\n");
        $telnet->read_till("(config)#");
        $telnet->write("show onu unauthentication\r\n");
        $str = $telnet->read_till("(config)#");
        $onus = explode('                     ', $str);
        $PON_PORT = null;
        $PON_IDX = null;
        $OnuModel = null;
        foreach ($onus as $onu) {
            if (strstr($onu, $mac)) {
                preg_match('/Onu Model        :   \S+/', $onu, $Model);
                preg_match('/\S+$/', $Model[0], $OnuModel);
                preg_match('/Onu Interface    :   \S+/', $onu, $Interface);
                preg_match('/_\w+\/\w+\/\w+:\w+/', $Interface[0], $OnuInterface);
                $pon = explode(':', $OnuInterface[0]);
                $PON_PORT = $pon[0];
                $PON_IDX = $pon[1];
            }
        }

        if ($PON_PORT) {
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->write(chr(13) . "\r\n");
            $telnet->read_till("(config)#");
            $telnet->write("interface epon-olt$PON_PORT\r\n");
            $telnet->read_till("(config-if)#");
            $telnet->write("onu $PON_IDX type $OnuModel[0] mac $mac\r\n");
            $str = $telnet->read_till("(config-if)#");
            if (strstr($str, 'exist')) {
                $result['status'] = false;
                $result['msg']['info'] = '当前设备已注册';
                return $result;
            } else {
                $result['status'] = true;
                $result['msg']['regStatus'] = '注册成功';
                $result['msg']['devName'] = ' ';
                $result['msg']['ponPort'] = $PON_PORT ? $PON_PORT : ' ';
                $result['msg']['ponIdx'] = $PON_IDX ? $PON_IDX : ' ';
                $result['msg']['info'] = '注册成功';
                return $result;
            }

        } else {
            $result['status'] = false;
            $result['msg']['info'] = '当前设备已注册或不存在';
            return $result;
        }
    }

}
 echo zte('192.168.85.1','jitech',2333,'Emmanise40854085');

 ?>