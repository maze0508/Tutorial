<?php
$addClassName= $_REQUEST["getname"]; //$_REQUEST 取得表單資料
$userid = $_REQUEST["userid"];
$usermediaid = $_REQUEST["usermediaid"];

/*
if($userid)
{
	echo "<script>alert('OK')</script>";
}
else
{
	echo "<script>alert('error')</script>";
}
*/


$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'CSCE521';
$dbname = 'wba2012';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_query("SET NAMES utf8");
mysql_select_db($dbname);

$addMsg="INSERT INTO  `wba2012`.`anchor_class` (`id` ,`user_id` , `user_media_id` ,`class_name`)VALUES (NULL , '$userid', '$usermediaid',  '$addClassName')";



mysql_query($addMsg);
header("location: spryPHP.php");

//header("Content-Type:text/html; charset=utf-8");
?>

