<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";

$user_media_id = mysql_escape_string($_GET['user_media_id']);
$team_id = mysql_escape_string($_GET['team_id']);
			
			
//href='start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id'



if (($member_id>=3 && $member_id<=33) || ($member_id>=195 && $member_id<=229) || ($member_id>=65 && $member_id<=96) || ($member_id>=230 && $member_id<=262) ||$member_id==303) {
	header("Location: video_learning.php?user_media_id=$user_media_id&team_id=$team_id");
}else{
	header("Location: start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id");
}

?>