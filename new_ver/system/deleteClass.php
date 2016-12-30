<?php

$delClassName= $_REQUEST["saveClassId"]; //$_REQUEST 取得表單資料
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'CSCE521';
$dbname = 'wba2012';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_query("SET NAMES utf8");
mysql_select_db($dbname);

$DelClass="DELETE FROM `wba2012`.`anchor_class`WHERE `anchor_class`.`id`= '$delClassName'";
 mysql_query($DelClass);
 $updateMsg="UPDATE  `wba2012`.`media_anchor` SET  `class_name` ='' WHERE   `media_anchor`.`member_id` ='$memberid' AND `media_anchor`.`media_anchor_id` ='$meid' AND `class_name` ='$delClassName' ";
 mysql_query($updateMsg);

header("location: spryPHP.php");
?>

