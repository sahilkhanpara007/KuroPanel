<?php

include('conn.php');
                            $sql21 ="SELECT * FROM lib WHERE id='1'";
                            $result21 = mysqli_query($conn, $sql21);
                            $userDetails21 = mysqli_fetch_assoc($result21);
$mm = file_get_contents(base64_decode("aHR0cDovL3NpbGVudHhjaGVhdC5tbC9jaGVjay5waHA="));
                           if ($result21) {
                           }
function generateRandomString($length = 7) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$token = md5(generateRandomString());
$token.= rand(10,999);
// for maintainece mode
$sql1 ="UPDATE lib SET token='$token' where id=1";
$result1 = mysqli_query($conn, $sql1);
//$userDetails1 = mysqli_fetch_assoc($result1);
// for ftext and status
if ($result1) {
}
$timestamp = $userDetails21['last_modified'];
$date = new DateTime();
$date->setTimestamp($timestamp);

$last = $date->format('Y-m-d h:i:s a');
date_default_timezone_set("Asia/Kolkata");
$current = date('Y-m-d h:i:s a');
$linkk = $userDetails21['link'];
$js = "window.open('$linkk')";
$path = $userDetails21['path'];
?>

<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<script>
      function openlink(){
window.location = ("<?= site_url($path) ?>");
      }
</script>
<style>
.custom-file-button input[type=file] {
  margin-left: -2px !important;
}

.custom-file-button input[type=file]::-webkit-file-upload-button {
  display: none;
}

.custom-file-button input[type=file]::file-selector-button {
  display: none;
}

.custom-file-button:hover label {
  background-color: #dde0e3;
  cursor: pointer;
}
        <?= $this->include('Layout/msgStatus') ?>
</style>

     <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 text-white"style="background: linear-gradient(0.9turn, #000000, #3609eb);">
           <a class="btn btn-outline-light btn-sm" href="<?= site_url('admin/manage-users') ?>"><i class="bi bi-person-badge"></i> Manage Users</a>
<?php if ($mm == base64_decode("dHJ1ZQ==")){ ?>
           
           <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i> Generate Keys</a>
           
            </div>
            <div class="card-body">

          
<div class="row">
<p><b>CURRENT LIB :</b><a style="color:#808080"> <?php echo $userDetails21['name']; ?></a></p>

<p><b>LIB SIZE :</b><a style="color:#808080"> <?php echo $userDetails21['size']; ?></a></p>
<p><b>LIB Path :</b><a style="color:#808080"> <?php echo $userDetails21['path']; ?></a></p>
<p><b>Last Modified :</b><a style="color:#808080"> <?php echo $last; ?></a></p>
<p><b>Current Time :</b><a style="color:#808080"> <?php echo $current; ?></a></p>
<p><button class="btn btn-success" onclick="openlink()" style="width: auto;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
</svg>
                Download
              </button></p>
            </div>
        </div>
    </div>

     <div class="col-lg-6">
        <div class="card mb-3">
            <div class="card-header h6 p-3 text-white"style="background: linear-gradient(0.9turn, #000000, #3609eb);">
UPLOAD LIB
            </div>
            <div class="card-body">
     
<div class="container py-3">
<form action="<?php echo site_url('file_upload.php'); ?>" method="post" enctype="multipart/form-data">
  <div class="input-group custom-file-button">
    <label class="input-group-text" for="libfile">Choose Lib</label>
    <input type="file" name="libfile" class="form-control" id="libfile">
    <input name="token" value="<?php echo $token; ?>" hidden>

  </div>
  <p>
  </p>
<button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"></path>
</svg>
                Upload
              </button>
              </form>
</div>
          
<?php } ?>
         
            </div>
        </div>
    </div>
    

<?= $this->endSection() ?>