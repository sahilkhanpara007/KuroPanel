<?php

include "db.php";
$emailid = $_POST['email'];
$token = $_POST['reset_link_token'];
$password = $_POST['password'];
                            $sql2 ="SELECT * FROM lib";
                            $result2 = mysqli_query($conn, $sql2);
                            $userDetails2 = mysqli_fetch_assoc($result2);
print_r($userDetails2);
?>