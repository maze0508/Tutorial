<?php
include_once("root.php");
$button_type = mysql_escape_string($_POST['button_type']);
$group_anchor_id = mysql_escape_string($_POST['group_anchor_id']);
if($button_type=='image'){
	$query= "delete from group_image where group_image_id='$group_anchor_id' ";
}else{
	$query= "delete from group_anchor where group_anchor_id='$group_anchor_id' ";
}
$result = $mysqli->query($query);
?>