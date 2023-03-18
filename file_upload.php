<?php


   if(isset($_FILES['libfile'])){
include "db.php";
$token = $_POST['token'];
                            $sql2 ="SELECT * FROM lib WHERE token='$token'";
                            $result2 = mysqli_query($conn, $sql2);
                            $userDetails2 = mysqli_fetch_assoc($result2);
//$curDate = time();
//$date = $userDetails2['exp_date'];
$row = mysqli_num_rows($result2);
if ($row > 0) {
date_default_timezone_set("Asia/Kolkata");
      $errors= array();
      $file_name = $_FILES['libfile']['name'];
      $file_size =$_FILES['libfile']['size'];
      $file_tmp =$_FILES['libfile']['tmp_name'];
      $file_type=$_FILES['libfile']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['libfile']['name'])));
$sqlop = "UPDATE lib set token=NULL WHERE id='1'";
$result3 = mysqli_query($conn, $sqlop);
      $extensions= array("so");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a .so file.";
      }
      
      if($file_size > 10097152){
         $errors[]='File size must be less than 10 MB';
      }
      $path = "Pbarmyff/".$file_name;
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"Pbarmyff/".$file_name);
         $link= "http://".$_SERVER['HTTP_HOST']."/".$path;

         $t = time();
$size=round($file_size / 1024 / 1024, 2)." MB";
//$size = $file_size;
$sqlop = "UPDATE lib set name='$file_name', path='$path', size='$size', link='$link', last_modified='$t' WHERE id='1'";
$result3 = mysqli_query($conn, $sqlop);
if ($result3) {
         echo "Success";
}
      }else{
         print_r($errors);
      }
      }
   }
   
?>