<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
	<h1><a href="#">Video Learning</a></h1>
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
				$user_media_id = mysql_escape_string($_GET['user_media_id']);
				$team_id = mysql_escape_string($_GET['team_id']);
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
			if(!$title){ //如果沒影片標題代表此影片還沒發佈，所以可能是使用者亂填
				echo "<script>document.location.href='index.php'</script>";
			}else{
				echo "<div style='width:100%;'>
						<label>$description</label>
					</div>";	
			}
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
				</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<label style="color:red">● 我們這組的註記</label>
	<div id="comment" style="height:370px;overflow:auto">
	<?php
		$query="select member.name,media_anchor.noteColor,media_anchor.anchor_descript,media_anchor.anchor_time from member left join media_anchor on member.member_id =  media_anchor.member_id where user_media_id = '$user_media_id' AND media_anchor.member_id in (select member_id from team_member where team_id = '$team_id')  order by media_anchor.anchor_time";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		$name = $row['name'];
		$anchor_time = $row['anchor_time'];
		$anchor_descript = $row['anchor_descript'];
		$noteColor = $row['noteColor'];
		$s   =   $anchor_time%60;
		$m   =   floor($anchor_time/60);
		//$o   =   floor($m/60);
		$m = ($m < 10)?"0".$m:$m;
		$s = ($s < 10)?"0".$s:$s;
		if($noteColor==0){
			echo "<div id='$anchor_time' class='antime $anchor_time' style='border-top:1px solid;cursor:pointer'>[$m:$s] $name 說：<br> $anchor_descript</div>";
		}
		}
	?>
	</div>
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->

<div id="footer">
	<div style="width:100%;float:left;margin-bottom:10px">
		<div style="width:420px;float:left">
			<label>◎同步討論區..(請稍待)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="button" id="newd" value="瀏覽對話內容記錄">
			<div id="roomlist" style="width:400px;height:320px;border:1px solid;background-color:#F5FCEE;overflow:auto"></div>
			<input type="text" id="speak" size="55" style="background-color:#E6F8D4">
			<input type="button" id="send_A" value="送出">
			
		</div>
		<div style="width:450px;float:left;">
			<label>※子問題列表</label>
			<div id="chil_list" style="height:320px;background-color:#FCEEFC;width:430px;overflow:auto">
			<?php
			$query="select name,date,children_content from children where user_media_id='$user_media_id' AND team_id='$team_id' order by children_id desc";
			$result = $mysqli->query($query);
			while($row = $result->fetch_array(MYSQL_ASSOC)){
				$name = $row['name'];
				$date = $row['date'];
				$children_content = $row['children_content'];
				echo "<div style='border-bottom:1px solid;color:#701FBD'>[$date] $children_content (由 $name 發表)</div> ";
			}
			?>
			</div>
			<input type="text" id="children_content" size="60" style="background-color:#F8D4F8">
			<input type="button" id="send_B" value="送出">
		</div>
	</div>
		<div style="width:100%">
			<div style="width:120px;float:left;text-align:left;">
				<a style='color:#3799FF' href="start_learning_1.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>"><img src="images/left128.png" />Step1-2 主題瀏覽</a>
			</div>
			<div style="width:120px;float:right;text-align:right">
				<a style='color:#3799FF' href="start_learning_3.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>"><img src="images/right128.png" />Step4 小組討論</a>
			</div>
		</div>	
	<p/>	
	<!--	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
	-->
</div>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
var team_id = "<?php print $team_id; ?>";
var name = "<?php print $_SESSION['user_name']; ?>";
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


$("#anchor_descript").click(function(){($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')})

$("div.antime").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).attr("id")):thisMovie('player2').sendEvent('SEEK',$(this).attr("id"));})

$("#send_A").click(function(){
if($("#speak").val() != ""){
	$.post("php/insert_room.php",{user_media_id:user_media_id,team_id:team_id,name:name,speak:$("#speak").val(),step:"3"},function(data) {
		$("#speak").val("")
	});}
})

$("#send_B").click(function(){
if($("#children_content").val() != ""){
	$.post("php/insert_room_children.php",{user_media_id:user_media_id,team_id:team_id,name:name,children_content:$("#children_content").val()},function(data) {
		alert("子問題發表成功")
		location.reload();
	});}
})

$("#newd").click(function(){
window.open ("window.php?content="+$("#roomlist").html(), 'newwindow', 'height=400, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=yes, resizable=no,location=no, status=no') 
})

$('body').keydown(function(){
    var keycode = window.event.keyCode;
    if( keycode == 13 )
    {
		if($("#speak").val() != ""){
		$.post("php/insert_room.php",{user_media_id:user_media_id,team_id:team_id,name:name,speak:$("#speak").val(),step:"3"},function(data) {
			$("#speak").val("")
		});}
    }
});

setInterval("chatroom()", 1000); 

})

function playerReady(obj) {($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}

function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};


function show(obj){
$("#anchor_time").text(Math.floor(obj.position));
$("div."+Math.floor(obj.position)).siblings('div.antime').css("background-color","").end().css("background-color","#FC9");
}

function chatroom(){
　　$.post("php/select_room.php",{user_media_id:user_media_id,team_id:team_id,step:"3"},function(data) {
	if(data)
		$("#roomlist").html(data).scrollTop($('#roomlist')[0].scrollHeight)
	});
}

</script>
</body>
</html>
