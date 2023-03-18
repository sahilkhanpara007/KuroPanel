<?php
if(isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email'])
{
include "db.php";
$emailid = $_POST['email'];
$token = $_POST['reset_link_token'];
$password = $_POST['password'];
                            $sql2 ="SELECT * FROM users WHERE reset_link_token='$token' AND id_users='$emailid'";
                            $result2 = mysqli_query($conn, $sql2);
                            $userDetails2 = mysqli_fetch_assoc($result2);
//$curDate = time();
//$date = $userDetails2['exp_date'];
$row = mysqli_num_rows($result2);
//echo $row;
//$row = mysqli_num_rows($query);
if($row > 0){
$sqlop = "UPDATE users set password='$password', reset_link_token=NULL ,exp_date=NULL WHERE id_users='$emailid'";
$query = mysqli_query($conn, $sqlop);
if (mysqli_query($conn, $sqlop)) {
$date = time();
$till = $date+1;
echo '<p>Congratulations! Your password has been updated successfully✌️✌️.</p>';

} else {
echo "error";
}

}else{
echo "<p>I think the link is expired 😂😂</p>";
}
} else {
}
?>