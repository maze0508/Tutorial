<?php
include_once('php/root.php');
$member_id = mysql_escape_string($_POST['member_id']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$anchor_class_id = mysql_escape_string($_POST['anchor_class_id']);
$anchor_date = date('Y-m-j');
$now=md5(gmdate('YmdHis', time()));//MD5（現在時間）避免檔名重複
$targetFolder = '/wba/images/anchor'; 
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile =  rtrim($targetPath,'/') . '/' . $now . $_FILES['Filedata']['name'];
	
	$pos = strrpos($_FILES["Filedata"]["name"], ".");
	if ($pos === false) {
		$ext = "";
	}else{
		$ext = substr($_FILES["Filedata"]["name"], $pos);
	}
	$image_name = $now . $_FILES['Filedata']['name'];	
	move_uploaded_file($tempFile,$targetFile);  //原始檔案
		
}
if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}
$query = "insert into media_image(member_id,user_media_id,image,anchor_class_id,anchor_date,noteColor) values('$member_id','$user_media_id','$image_name','$anchor_class_id','$anchor_date','1')";
$result = $mysqli->query($query);
		
//$query = "insert into user_media(member_id,url) values('$member_id','$now')";
//$result = $mysqli->query($query);
		
	//	echo "1";
	// } else {
	// 	echo 'Invalid file type.';
	// }
	

?>