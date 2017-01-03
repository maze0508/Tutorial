<?php
include_once("root.php");
$member_id = mysql_escape_string($_POST['course_stu_id']);
$user_media_id = mysql_escape_string($_POST['user_media_id']);
$select_type = mysql_escape_string($_POST['select_type']);

switch($select_type){

	case "item_Danchor":
		echo'<div id="content">
			<div class="post">
				<div class="entry">';
				
					if(!$user_media_id){
						echo "<script>document.location.href='index.php'</script>";
						return false;
					}else{
						$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,common.common_account,common.common_unit,common.common_email,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join common on common.common_id = user_media.common_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
						$result = $mysqli->query($query);
						 while($row = $result->fetch_array(MYSQL_ASSOC)){
						   $url .= $row["url"];			   
						   $ident_catalog .= $row["ident_catalog"];
						   $name .= $row["name"];
						   $common_account .= $row["common_account"];
						   $common_unit .= $row["common_unit"];
						   $common_email .= $row["common_email"];
						   $source_catalog .= $row["source_catalog"];
						   $title .= $row["title"];
						   $language .= $row["language"];
						   $description .= $row["description"];
						   $keyword .= $row["keyword"];
						   $coverage .= $row["coverage"];
						   $version .= $row["version"];
						   $role_catalog .= $row["role_catalog"];
						   $design_date .= $row["design_date"];
						   $cost .= $row["cost"];
						   $copyright .= $row["copyright"];
						   $ccdescript_catalog .= $row["ccdescript_catalog"];	
						   $found .= strstr($url,"youtube");			   
						}
					}	
					if(!$title) //如果沒影片標題代表此影片還沒發佈，所以可能是使用者亂填
					echo "<script>document.location.href='index.php'</script>";
				
				
					$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id' AND user_media.user_media_id = '$user_media_id'";
					$result = $mysqli->query($query);
					while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $learning_name = $row["learning_name"];
					   $learning_id = $row["learning_id"];
					   $user_media_id = $row["user_media_id"];
					   $learning_start = $row["learning_start"];				   
					   $learning_end = $row["learning_end"];
					   $learning_content = $row["learning_content"];
					   $edit_books_id = $row["edit_books_id"];
					   $name = $row["name"];				   
					   $subject_catalog = $row["subject_catalog"];	
					   $url = $row["url"];	
					   $found = strstr($url,"youtube");					   
						echo "
							<div style='width:100%;'>
								<label>$learning_content</label>
							</div>					
						";					
					}
					mysqli_free_result($result);
					
					echo'<div id="embed">
					<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="100%" height="350">
					<param name="movie" value="player.swf" />
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />';
				
					if($found)
					echo "<param name='flashvars' value='file=$url' />"; 
					else					
					echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; 
				
					echo'<embed type="application/x-shockwave-flash" id="player2" name="player2" src="player.swf" width="100%" height="350" allowscriptaccess="always"  allowfullscreen="true"';
				    
						if($user_media_id && $found)
						echo "flashvars='file=$url'";
						else if($user_media_id)	
						echo "flashvars='file=user_movie/$url.flv&image=user_pics/$url.jpg'";
					echo' />			
					</object>
					</div>
					
				</div>			
			</div>
		</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<label style="color:red">● 文字註記</label>
	<div id="comment">';
	
		$query="select member.name,media_anchor.media_anchor_id,media_anchor.anchor_descript,media_anchor.noteColor,media_anchor.anchor_time from member left join media_anchor on member.member_id =  media_anchor.member_id where user_media_id = '$user_media_id' AND media_anchor.member_id = '$member_id'  order by media_anchor.anchor_time";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		$name = $row['name'];
		$anchor_time = $row['anchor_time'];
		$anchor_descript = $row['anchor_descript'];
		$media_anchor_id = $row['media_anchor_id'];
		$noteColor = $row['noteColor'];
		$s   =   $anchor_time%60;
		$m   =   floor($anchor_time/60);
		//$o   =   floor($m/60);
		$m = ($m < 10)?"0".$m:$m;
		$s = ($s < 10)?"0".$s:$s;
		if($noteColor==0){
			echo "
					<table id='$media_anchor_id'>
					<tr>
						<td style='width:235px;'><div id='$anchor_time' class='antime $anchor_time' style='border-top:1px solid;cursor:pointer'>[$m:$s] $name 說：<br> $anchor_descript</div></td>
						<td style='width:16px;'><div></div></td>
					</tr>
					<table>
				";
		}
		}
	
	echo'</div>
	</div>
	<!-- end sidebar -->';

	break;
	case "item_Ianchor":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$select_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$learning_name = $row["learning_name"];
			$user_media_id = $row["user_media_id"];
			echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
		}
	break;
	case "item_Dclass":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$select_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$learning_name = $row["learning_name"];
			$user_media_id = $row["user_media_id"];
			echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
		}
	break;
	case "item_Iclass":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";
		$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$select_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$learning_name = $row["learning_name"];
			$user_media_id = $row["user_media_id"];
			echo '<option value="' . $user_media_id . '">' . $learning_name . '</option>' . "\n";
		}
	break;
	case "item_Nbook":
		echo "<option class='change' value='change'>請選擇章節 影片</option>";

	break;
}
		
?>