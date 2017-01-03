<?php
session_start();
include_once("root.php");
$account = mysql_escape_string($_POST['account']);
$pwd = mysql_escape_string($_POST['pwd']);

$query = "SELECT account,member_id,compet,name FROM member WHERE account='$account' && pwd='$pwd' limit 0,1";
$result = $mysqli->query($query);
$rows = $result->fetch_assoc();
$account = $rows['account'];
$member_id = $rows['member_id'];
$compet = $rows['compet'];
$name = $rows['name'];

if($member_id){
$_SESSION['account'] = $account;
$_SESSION['member_id'] = $member_id;
$_SESSION['compet'] = $compet;
$_SESSION['user_name'] = $name;
    if($_SESSION['compet']==1){
       echo "<script>alert('登入成功');</script>";
       echo "<script>parent.location.href='../group_study.php'</script>";
    }else{
       echo "<script>alert('登入成功');</script>";
       echo "<script>parent.location.href='../sign.php'</script>"; 
    }

   //echo "<script>parent.location.reload();</script>";
   //echo "<script>parent.$.colorbox.close();</script>";
}else{
   echo "<script>alert('登入失敗')</script>";
   echo "<script>parent.$.colorbox.close();</script>";
 }

?>