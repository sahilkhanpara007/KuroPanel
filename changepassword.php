<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Reset Password In PHP MySQL</title>
<!-- CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="card">
<div class="card-header text-center">
Reset Password In PHP MySQL
</div>
<div class="card-body">
<script>
var timezone_offset_minutes = new Date().getTimezoneOffset();
timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

// Timezone difference in minutes such as 330 or -360 or 0
console.log(timezone_offset_minutes); 
</script>
<?php
$timezone_offset_minutes = 330;  // $_GET['timezone_offset_minutes']

// Convert minutes to seconds
$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

// Asia/Kolkata
//echo $timezone_name;
date_default_timezone_set($timezone_name);
?>


<?php
if($_GET['key'] && $_GET['token'])
{

include "db.php";
$email = $_GET['key'];
$token = $_GET['token'];
//$query = mysqli_query($conn, "SELECT * FROM users WHERE reset_link_token='$token', id_users='$email'");
                            $sql2 ="SELECT * FROM users WHERE reset_link_token='$token' AND id_users='$email'";
                            $result2 = mysqli_query($conn, $sql2);
                            $userDetails2 = mysqli_fetch_assoc($result2);
//$curDate = time();
$date = $userDetails2['exp_date'];
$numrows = mysqli_num_rows($result2);
$curDate = time();
if ($numrows > 0) {

if($date >= $curDate){ 
?>

<form action="update-forget-password.php" method="post">
<input type="hidden" name="email" value="<?php echo $email;?>">
<input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input type="password" name='password' class="form-control">
</div>                
<div class="form-group">
<label for="exampleInputEmail1">Confirm Password</label>
<input type="password" name='cpassword' class="form-control">
</div>
<input type="submit" name="new-password" class="btn btn-primary">
</form>
<?php
}else{
echo "<p>This forget password link has been expired</p>";
}
}
}

?>
</div>
</div>
</div>
</body>
</html>