<?php

 $updateClassID= $_REQUEST["getclassID"]; //$_REQUEST 取得表單資料
 $meid= $_REQUEST["meid"];
 $memberid = $_REQUEST["memberid"];
 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'CSCE521';
$dbname = 'wba2012';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_query("SET NAMES utf8");
mysql_select_db($dbname);


$updateMsg="UPDATE  `wba2012`.`media_anchor` SET  `class_name` ='$updateClassID' WHERE   `media_anchor`.`member_id` ='$memberid' AND `media_anchor`.`media_anchor_id` ='$meid'";
 mysql_query($updateMsg);
 header("location: spryPHP.php");
//header("Content-Type:text/html; charset=utf-8");
?>

