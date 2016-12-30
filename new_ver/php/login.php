<?php
session_start();
include_once("root.php");
//$account = mysql_real_escape_string($_POST['account']);
//$pwd = mysql_real_escape_string($_POST['pwd']);
$account = mysql_escape_string($_POST['account']);
$pwd = mysql_escape_string($_POST['pwd']);

$query = "SELECT account,member_id,compet,name FROM member WHERE account='$account' && pwd='$pwd' limit 0,1";
$result = $mysqli->query($query);

$row = $result->fetch_array(MYSQL_ASSOC);
$member_id = $rows['member_id'];
echo $rows['member_id'];

if($member_id){

$_SESSION['account'] = $rows['account'];
$_SESSION['member_id'] = $member_id;
$_SESSION['compet'] = $rows['compet'];
$_SESSION['user_name'] = $rows['name'];

   echo "<script>alert('登入成功');</script>";
   echo "<script>document.location.href='../sign.php'</script>";
   //echo "<script><h2>歡迎光臨_<span id='ald'>".$_SESSION['user_name']."</span>	<a id='logout' href='php/logout.php'>，登出</a></h2>;$('#login').html(logintest);</script>";
   //echo "<script>parent.location.reload();</script>";
   //echo "<script>parent.$.colorbox.close();</script>";
}


else{
    echo "memberid=$rows['member_id']" ;
  // echo "<script>alert('登入失敗')</script>";
    //echo "<script>parent.$.colorbox.close();</script>";
 }

?>