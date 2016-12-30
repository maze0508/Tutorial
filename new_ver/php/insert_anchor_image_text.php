<?php
include_once("root.php");
$user_media_image_id = mysql_escape_string($_POST['user_media_image_id']);
$member_id = mysql_escape_string($_POST['member_id']);
$media_url = mysql_escape_string($_POST['url']);
$anchor_descript = mysql_escape_string($_POST['anchor_descript']); //文字註記輸入內容
$anchor_time = mysql_escape_string($_POST['anchor_time']);
$anchor_date = date('Y-m-d H:i:s');
$privacy = mysql_escape_string($_POST['privacy']);

//節圖
if($anchor_time){
$image_name="$user_media_id"."_"."$anchor_time".".jpg";
shell_exec("ffmpeg -i ../user_movie/$media_url.flv -ss $anchor_time -vframes 1 -y ../images/anchor/$image_name");


$query="insert into media_anchor_image(user_media_id,member_id,image,anchor_descript,anchor_date,anchor_time) values('$user_media_id','$member_id','$image_name','$anchor_descript','$anchor_date','$anchor_time')";
$result = $mysqli->query($query);
}
if($privacy)
   //XX學生的影片圖文註記顯示在我的註記區塊
	$query="SELECT member.name, media_anchor_image.media_anchor_image_id, media_anchor_image.anchor_descript, media_anchor_image.noteColor, media_anchor_image.anchor_time, media_anchor_image.image
				FROM member
				LEFT JOIN media_anchor_image ON member.member_id = media_anchor_image. member_id 
				WHERE user_media_id = '$user_media_id'
				AND media_anchor_image.member_id = '$member_id'  
				ORDER BY media_anchor_image.anchor_time
			";
else
	$query="SELECT member.name, media_anchor_image.anchor_descript, media_anchor_image.anchor_time, media_anchor_image.image,media_anchor_image.media_anchor_image_id,media_anchor_image.noteColor
			FROM member
			LEFT JOIN media_anchor_image ON member.member_id = media_anchor_image.member_id
			WHERE user_media_id ='$user_media_id'
			ORDER BY media_anchor_image.anchor_time
			";


$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
			$name = $row['name'];
			$anchor_time = $row['anchor_time'];
			$image = $row['image'];
			$noteColor = $row['noteColor'];//註記分類底色
			$anchor_descript = $row['anchor_descript'];//文字
			$media_anchor_image_id = $row['media_anchor_image_id'];//文字
			$s   =   $anchor_time%60;
			$m   =   floor($anchor_time/60);
			//$o   =   floor($m/60);
			$m = ($m < 10)?"0".$m:$m;
			$s = ($s < 10)?"0".$s:$s;
if($noteColor==0){
echo "
					
					<table id='$media_anchor_image_id' style='border-top:1px solid;cursor:pointer'>
						<tr>
							<td style='width:205px;'><div id='$anchor_time' class='antime $anchor_time' >[$m:$s] $name 說：<br> <img class='image' style='width:200px;' src='./images/anchor/$image'/><br> $anchor_descript</div></td>
							<td style='width:16px;'>
								<div><img class='delete_button' style='width:16px;'src='./images/cancel.png';></img></div>
								<div><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></div>
							</td>
						</tr>
						<table>
					";		
}}
?>