<?php

$servername = "sql301.unaux.com";
$uparhebro = "unaux_33388654";
$password = "jd0utd";
$dbname = "unaux_33388654_a";

$conn = mysqli_connect($servername,$uparhebro,$password,$dbname);

if(!$conn) {

die(" PROBLEM WITH CONNECTION : " . mysqli_connect_error());

}
  
?>