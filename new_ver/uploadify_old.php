<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
/*
// Define a destination
$targetFolder = '/wbatest/yh/upload/images/anchor'; // Relative to the root

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
*/


$targetFolder = '/wbatest/yh/upload/images/anchor'; 
$now=md5(gmdate('YmdHis', time()));//MD5（現在時間）避免檔名重複
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/wbatest/yh/upload/images/anchor';
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	
	$pos = strrpos($_FILES["Filedata"]["name"], ".");
	if ($pos === false) {
		$ext = "";
	}else{
		$ext = substr($_FILES["Filedata"]["name"], $pos);
	}
	//$image_name = $now.'.jpg';	
	move_uploaded_file($tempFile,$targetFile);  //原始檔案
}
?>