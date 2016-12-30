<?php
include_once("root2.php");
$subject_id = mysql_escape_string($_POST['subject_id']);
$subject_name = mysql_escape_string($_POST['subject_name']);
echo"<div style='background-image:url(images/test/home-tit.png);background-size:auto 30px;padding:0px 0px 2px 30px;'><h3 >".$subject_name."</h3></div>";
					
$query3 = "select edit_books.edit_books_id,user_media.user_media_id,user_media.url,user_media.title from edit_books left join user_media on edit_books .user_media_id =  user_media.user_media_id WHERE subject_id='$subject_id' order by edit_books.subject_id";
					$result3 = mysql_query($query3);
					while($row3 = mysql_fetch_array($result3)){
						
					   $user_media_id = $row3["user_media_id"];
					   $url = $row3["url"];				   
					   //$title = iconv_substr($row3["title"], 0, 10, 'utf-8');
					   $title = $row3["title"];
					   $found = strstr($url,"youtube");				   
					   if($found)
							echo "<div class='temp_movie' style='float: left;margin: 5px 25px 25px 0;'>
								<a href='vedio_player.php?user_media_id=$user_media_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'>
									<img src='' class='youtube' name='$url' /><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div>";
					   else
							echo "<div class='temp_movie' style='float: left;margin: 0px 25px 25px 0;height:125px'>
									<a href='vedio_player.php?user_media_id=$user_media_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'>
										<img src='user_pics/$url.jpg' /><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div>";
					}
?>