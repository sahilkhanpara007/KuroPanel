<?php
//include 'geo.php';
    $ip = $_SERVER['REMOTE_ADDR']; // your ip address here
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
   

    if($query && $query['status'] == 'success')
    {
            $city = $query['city'];
            $haul = '𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗜𝗧𝗬 - ' . $query['city']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗦𝗧𝗔𝗧𝗘 - ' . $query['region']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗭𝗜𝗣𝗖𝗢𝗗𝗘 - ' . $query['zip']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗖𝗢𝗢𝗥𝗗𝗜𝗡𝗔𝗧𝗘𝗦 - ' . $query['lat'] . ', ' . $query['lon']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗡𝗘𝗧𝗪𝗢𝗥𝗞 - ' . $query['as']."\n".'𝗖𝗟𝗜𝗘𝗡𝗧 𝗧𝗜𝗠𝗘𝗭𝗢𝗡𝗘 - ' . $query['timezone'];
  $apiToken = "5982824943:AAHV66f0xTTexZwW5qyYBZ3kO7EghOKslB0";
  $data = [
      'chat_id' => '@kuro_logs',
      'text' => $haul
  ];


    }
    
  if ($city == "") {
  $city = "not found";
  }


  /* echo ("<h1>".$geoplugin['geoplugin_currencyCode']."</h1><br>");
   echo ("<h1>".$geoplugin['geoplugin_currencySymbol']."</h1><br>");
   echo ("<h1>".$geoplugin['geoplugin_currencySymbol_UTF8']."</h1><br>");*/
 
 

if (session()->getFlashdata('msgDanger')) : ?>
    <div class="alert alert-danger fade show" role="alert">
        <?= session()->getFlashdata('msgDanger') ?>
    </div>
<?php elseif (session()->getFlashdata('msgSuccess')) : ?>
    <div class="alert alert-success fade show" role="alert">
        <?= session()->getFlashdata('msgSuccess') ?>
    </div>
<?php elseif (session()->getFlashdata('msgWarning')) : ?>
    <div class="alert alert-warning fade show" role="alert">
        <?= session()->getFlashdata('msgWarning') ?>
    </div>
<?php else : ?>
    <?php if (session()->has('userid')) : ?>
        <?php if (isset($messages)) : ?>
            <div class="alert alert-<?= $messages[1] ?> fade show" role="alert" class="my_text">
                <?= $messages[0] ?>
            </div>
        <?php else : ?>
     <style>
            .my_text
            {
                font-family:    Arial, Helvetica, sans-serif
               font-size:      40px;
                font-weight:    bold;
            }
        </style>
            <div class="alert alert-secondary fade show" role="alert" class="my_text">
                Welcome <?= getName($user) ?> <br> Your IP - <?= $_SERVER['REMOTE_ADDR'] ?> <br>You Live In <?= $city ?></br> </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            Welcome Stranger
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
<?php endif; ?>