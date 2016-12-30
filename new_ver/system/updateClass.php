<?php

 $ClassID= $_REQUEST["saveClassId"]; //$_REQUEST 取得表單資料
 $newClassName= $_REQUEST["NewClassName"];

 
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'CSCE521';
$dbname = 'wba2012';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_query("SET NAMES utf8");
mysql_select_db($dbname);

$UpClass="UPDATE  `wba2012`.`anchor_class` SET  `class_name` ='$newClassName' WHERE  `anchor_class`.`id` ='$ClassID'";
 mysql_query($UpClass);

header("location: spryPHP.php");
?>

