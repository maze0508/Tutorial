<?php
$memberId = $_REQUEST["memberId"];
$usermediaid = $_REQUEST["usermediaid"];
$content= $_REQUEST["textarea"];
$updateClassID= $_REQUEST["NewNoteClass"]; //$_REQUEST 取得表單資料

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'CSCE521';
$dbname = 'wba2012';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_query("SET NAMES utf8");
mysql_select_db($dbname);



$updateMsg="INSERT INTO  `wba2012`.`media_anchor` (`media_anchor_id` ,`member_id` ,`user_media_id` ,`anchor_descript` ,`image` ,`class_name` ,`anchor_time` ,`anchor_date` ,`noteColor`)VALUES (NULL ,  '$memberId',  '$usermediaid',  '$content',  '',  '$updateClassID',  '0',  '',  '1')";
 mysql_query($updateMsg);
 header("location: spryPHP.php");

 ?>

