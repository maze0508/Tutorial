<?php session_start();
$member_id = $_SESSION['member_id'];
$user_media_id = mysql_escape_string($_GET['user_media_id']);
$team_id = mysql_escape_string($_GET['team_id']);
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!---<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">---->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
.temp_movie{
cursor:pointer;
width:120px;
float:left;
margin:5px;
border:1px solid #666;
padding:3px;
text-align: center;
}
.ibutton{
border:1px solid #999;
cursor:pointer;
margin-right:3px;
padding:2px;
color:#FFF
}
</style>
</head>
<body>
<div id="logo">
	<?php
	include_once("banner1_2.php");
	?>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['user_name'];?></span>
	<?php
	include_once("php/root.php");
	if($_SESSION['account'])
	echo '<a id="logout" href="php/logout.php">，登出</a>';
	?>	
	</h2>
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<div class="entry">
			<?php
				//$user_media_id = mysql_escape_string($_GET['user_media_id']);
				//$team_id = mysql_escape_string($_GET['team_id']);
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}else{
				$query = "SELECT identifier.ident_catalog,member.name,source.source_catalog,user_media.url,user_media.title,user_media.language,user_media.description,user_media.keyword,user_media.coverage,user_media.version,role.role_catalog,user_media.design_date,user_media.cost,user_media.copyright,ccdescript.ccdescript_catalog from user_media left join ccdescript on user_media.ccdescription_id = ccdescript.ccdescript_id left join identifier on user_media.identifier_id = identifier.ident_id left join role on user_media.role_id = role.role_id left join source on user_media.source_id = source.source_id left join member on member.member_id = user_media.member_id  where user_media.user_media_id='$user_media_id'  limit 0,1";
					$result = $mysqli->query($query);
					 while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $url .= $row["url"];			   
					   $ident_catalog .= $row["ident_catalog"];
					   $name .= $row["name"];
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
			?>
				<?php
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
				?>	
				<div id='embed'>
				<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="100%" height="350">
					<param name="movie" value="player.swf" />
					<param name="allowfullscreen" value="true" />
					<param name="allowscriptaccess" value="always" />
				<?php
					if($found)
					echo "<param name='flashvars' value='file=$url' />"; 
					else					
					echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; 
				?>
				<embed type="application/x-shockwave-flash" id="player2" name="player2" src="player.swf" width="100%" height="350" allowscriptaccess="always"  allowfullscreen="true"
				    <?php
						if($user_media_id && $found)
						echo "flashvars='file=$url'";
						else if($user_media_id)	
						echo "flashvars='file=user_movie/$url.flv&image=user_pics/$url.jpg'";
					?> />			
				</object>
				</div>
				<span type="text" id="anchor_time">0</span>
				<input type="text" id="anchor_descript"  size="50" maxlength="200" value=" 請將影片暫停在您欲註記的時間點.." />
				<label id="anchor" class='ibutton' style='background-color:#F60'>留下註記</label>
			</div>
			
						
			<div style="float:right;width:120px">
				<a style='text-decoration: none;' href='start_learning_class.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>'><img src="images/test/stu-cf3.png" /><!-- 整理註記 --></a>
				
			</div>
			
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<label style="color:red">● 我的註記</label>
	<div id="comment">
	<?php
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
						<td style='width:235px;'><div id='$anchor_time' class='antime $anchor_time' style='border-top:1px solid;cursor:pointer;word-break: break-all;'>[$m:$s] $name 說：<br> $anchor_descript</div></td>
						<td style='width:16px;'><div><img id='delete_button' style='width:16px;'src='./images/cancel.png';></img></div></td>
					</tr>
					</table>
				";
		}
		}
	?>
	</div>
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>

<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
var title = "<?php print $title; ?>";
var url = "<?php print $url; ?>";
$(function(){

$('#down').toggle(
function(){
	$(this).attr('src','images/up32.png').parent().css({'height':''});
	return false;
},
function(){
	$(this).attr('src','images/down32.png').parent().css({'height':'20px'});
	return false;
})




$("#anchor").click(function(){
if(member_id.length>=1){
$.post("php/insert_anchor.php",{member_id:member_id,user_media_id:user_media_id,url:url,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time").text(),privacy:"privacy"},function(data) {

alert('已留下註記!!'); $("#comment").html(data); $("#anchor_descript").val('')
});
}else
alert("請先登入");
})

$("#delete_button").live("click",function(){
if(member_id.length>=1){
var media_anchor_id=$(this).parents('table').attr('id');
$.post("php/delete_anchor.php",{media_anchor_id:media_anchor_id,button:"delete"},function(data) {
var del_anchor="table#"+media_anchor_id;

 $(del_anchor).remove(); 
});
}else
alert("請先登入");
})

$("#anchor_descript").click(function(){($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')}).one("click",function(){
$(this).val("");
})

$('body').keydown(function(){
    var keycode = window.event.keyCode;
    if( keycode == 13 )
    {
	if(member_id.length>=1){
		$.post("php/insert_anchor.php",{member_id:member_id,user_media_id:user_media_id,url:url,anchor_descript:$("#anchor_descript").val(),anchor_time:$("#anchor_time").text(),privacy:"privacy"},function(data) {
		($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')
		alert('已留下註記!!'); $("#comment").html(data); $("#anchor_descript").val('')
	});
	}else
		alert("請先登入");
    }
});

$("div.antime").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).attr("id")):thisMovie('player2').sendEvent('SEEK',$(this).attr("id"));})


})

function playerReady(obj) {
($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}

function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};


function show(obj){
	$("#anchor_time").text(Math.floor(obj.position));
	$("div.antime").css("background-color","");
	$("div."+Math.floor(obj.position)).css("background-color","#FC9");
}

</script>
</body>
</html>
