<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Digital Teaching</title>
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
	<h1><a href="#">Digital Teaching</a></h1>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['account'];?></span>
	<?php
	include_once("php/root.php");
	if($_SESSION['account'])
	echo '<a id="logout" href="php/logout.php">，登出</a>';
	?>	
	</h2>
</div>
<div id="menu">
	<?php
	include_once("banner.php");
	?>
	<div id="search">
		<form method="get" action="">
			<fieldset>
			<input id="s" type="text" name="s" value="" />
			<input id="x" type="image" name="imageField" src="images/img10.jpg" />
			</fieldset>
		</form>
	</div>
</div>
<hr />
<div id="banner"><img src="images/img04.jpg" alt="" width="960" height="147" /></div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<div class="entry">
				<?php
					$user_media_id = mysql_escape_string($_GET['user_media_id']);
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
						   $member_id .= $row["member_id"];
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
			echo "<h3>$title</h3>";
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
				</div> <!-- embed -->
				<?php
				echo "<div><span type='text' id='anchor_time'>0</span></div>";
				echo "<label class='ibutton' style='background-color:#69C' title='$ccdescript_catalog'>版權 $copyright</label>";
				echo "<label class='ibutton' style='background-color:#CC0'>付費 $cost</label>";
				echo "<label class='ibutton' style='background-color:#99C'>語言 $language</label>";
				echo "<label id='add_fav' class='ibutton' style='background-color:#C30'><img src='images/favorite16.png' align='top' />加入收藏</label>";
				if($_SESSION['compet']>1)
					echo "<a href='fav_books.php?user_media_id=$user_media_id' class='ibutton' style='background-color:#969'><img src='images/book16.png' align='top' />教材製作</a>";
				?>	
				<div id="input2">
					<table style="border:1px solid #000000; width:400px; "align ="center" valign="middle" frame="border" rules="none"> 
						<tr style="height:200px;">
							<td colspan=2 align ="center"><img id="anchor_pic" class='ibutton' style='width:200px;' border="1" src='./images/anchor/index.jpg';></img><br/></td>
						</tr>
						<tr>
							<td align ="center"><input type=text id="start_time" class="0" value="00:00:00" size="6"></input>
							<label id="start" class='ibutton' style='background-color:#F60'>開始</label></td>
							<td align ="center"><input type=text id="stop_time"  class="0" value="00:00:00" size="6"></input>
							<label id="stop" class='ibutton' style='background-color:#F60'>結束</label></td>
						</tr>
						<tr style=" height:40px;">
						<td colspan=2 align ="center"><input type="text" id="script"  size="50" maxlength="50" value=" 留下註記"></input></td>
						</tr>
						<tr style=" height:30px;">
							<td colspan=2 align ="center"><label id="new" class='ibutton' style='background-color:#F60'>新增</label><br/></td>
						</tr>
					</table>
				</div> <!-- input2 -->
			</div> <!-- entry -->
		</div> <!-- post -->
	</div> <!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	<div id="comment" style="height:700px;overflow:auto">
	<?php
		$query="select member.name,img_anchor.img_anchor_id,img_anchor.image,img_anchor.script,img_anchor.start_time,img_anchor.stop_time from member left join img_anchor on member.member_id =  img_anchor.member_id where img_anchor.user_media_id = '$user_media_id' AND img_anchor.member_id = '$member_id'order by img_anchor.start_time";
		$result = $mysqli->query($query);
		//echo "<br>QUERY=".$query."<br><br>";
		
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			
			$name = $row['name'];
			$img_anchor_id = $row['img_anchor_id'];
			$image = $row['image'];
			$start_time = $row['start_time'];
			$stop_time = $row['stop_time'];
			$script = $row['script'];
			$start_s   =   $start_time%60;
			$start_m   =   floor($start_time/60);
			$start_h   =   floor($start_time/360);
			if($start_h < 10) $start_h = "0".$start_h;
			if($start_m < 10) $start_m = "0".$start_m;
			if($start_s < 10) $start_s = "0".$start_s;

			$stop_s   =   $stop_time%60;
			$stop_m   =   floor($stop_time/60);
			$stop_h   =   floor($stop_time/360);
			if($stop_h < 10) $stop_h = "0".$stop_h;
			if($stop_m < 10) $stop_m = "0".$stop_m;
			if($stop_s < 10) $stop_s = "0".$stop_s;
			
			echo "<div id='$img_anchor_id' title='$start_time' class='antime $start_time'>
				<table style='border:1px solid #000000; width:300px;height:250px; 'align ='center' valign='middle' frame='border' rules='all'> 
					<tr style=' height:30px;'>
						<td colspan=2 align ='right'>
							<label id='play' class='ibutton' style='background-color:#F60'>播放</label>
							<label id='edit' class='ibutton' style='background-color:#F60'>更改</label>
							<label id='delete' class='ibutton' style='background-color:#F60'>刪除</label>
						</td>
					</tr>
					<tr>
						<td colspan=2 align ='center'><img id='jpg2' style='width:200px;' src='$image'/><br/>
						<textarea id='script' border='1px' cols='25' rows='2' disabled>$script</textarea></td>
					</tr>
					<tr style=' height:30px;'>
						<td align ='center'><a>開始時間</a><input type=text id='startT' value='$start_h:$start_m:$start_s' disabled size='6' ></input></td>
						<td align ='center'><a>結束時間</a><input type=text id='stopT' value='$stop_h:$stop_m:$stop_s' disabled size='6' ></input></td>
					</tr>
					
				</table>
			</div>";
		
}
	?>
	</div>
	</div>
	
	<!-- end sidebar -->

</div> <!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
var media_url = "<?php print $url; ?>";
//var user_media_id = "<?php print $user_media_id; ?>";
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



$("#add_fav").click(function(){
if(member_id.length>=1){
$.post("php/favorite_add.php",{member_id:member_id,user_media_id:user_media_id},function(data) {alert('已加入收藏!!'); });
}else
alert("請先登入");
})

$("#start").click(function(){
	$.post("php/insert2_anchor.php",{button:"start",anchor_time:$("#anchor_time").text()},
			function(data) {
				$("#start_time").attr('value',data);
			}
			);
})
$("#stop").click(function(){
	$.post("php/insert2_anchor.php",{button:"stop",anchor_time:$("#anchor_time").text()},
			function(data) {
				$("#stop_time").attr('value',data);
			}
			);
})
/*$("#imgB").click(function(){

	$.post("php/insert2_anchor.php",{button:"img",user_media_id:user_media_id,media_url:media_url,anchor_time:$("#anchor_time").text()},
			function(data) {
				
				//alert(data);
				$("#anchor_pic").attr('src',data);
			}
			);
})*/
$("#anchor_pic").click(function(){
	$.post("php/insert2_anchor.php",{button:"img",user_media_id:user_media_id,media_url:media_url,anchor_time:$("#anchor_time").text()},
			function(data) {
				//alert(user_media_id);
				$("#anchor_pic").attr('src',data);
			}
			);
})
$("#script").click(function(){($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')}).one("click",function(){
$(this).val("")
})
$("#new").click(function(){
	startS=parseInt($("#start_time").val().slice(6,8));
	startM=parseInt($("#start_time").val().slice(3,5))*60;
	startH=parseInt($("#start_time").val().slice(0,2))*360;
	startT=startS+startM+startH;
	
	stopS=parseInt($("#stop_time").val().slice(6,8));
	stopM=parseInt($("#stop_time").val().slice(3,5))*60;
	stopH=parseInt($("#stop_time").val().slice(0,2))*360;
	stopT=stopS+stopM+stopH;
	
	if(stopT > startT){
		//$.post("change_anchor.php",{start_time:$("#startT").val(),stop_time:$("#stopT").val(),anchor_pic:anchor_Pic},
		$.post("php/new_anchor.php",{user_media_id:user_media_id,member_id:member_id,image:$("#anchor_pic").attr('src'),anchor_script:$("#script").val(),start_time:startT,stop_time:stopT},
			function(data) {
				//alert(data);
					$("#comment").html(data);
				}
		);
	}else{
		alert("結束時間請大於開始時間");
	}

})
$("#delete").live("click",function(){
	//alert("ok");
	//alert($(this).parent());
	id=$(this).parents("div.antime").attr("id");
	$.post("php/insert2_anchor.php",{button:"delete",img_anchor_id:id},
		function(data) {
		}
	);
			
	$(this).parents("div.antime").remove();
	
	
	
	
})

$("#edit").live("click",function(){
	$(this).toggle(
		function(){
			$(this).text("確認");
			$(this).parents("div.antime").find('input').removeAttr('disabled');
			$(this).parents("div.antime").find('textarea').removeAttr('disabled');},
		function(){
			startS=parseInt($(this).parents("div.antime").find("#startT").val().slice(6,8));
			startM=parseInt($(this).parents("div.antime").find("#startT").val().slice(3,5))*60;
			startH=parseInt($(this).parents("div.antime").find("#startT").val().slice(0,2))*360;
			startT=startS+startM+startH;
			
			stopS=parseInt($(this).parents("div.antime").find("#stopT").val().slice(6,8));
			stopM=parseInt($(this).parents("div.antime").find("#stopT").val().slice(3,5))*60;
			stopH=parseInt($(this).parents("div.antime").find("#stopT").val().slice(0,2))*360;
			stopT=stopS+stopM+stopH;
			img_anchor_id=$(this).parents("div.antime").attr('id');
			image=$(this).parents("div.antime").find("#jpg2").attr('src');
			script=$(this).parents("div.antime").find("#script").attr('value');
			alert(script);
			if(stopT > startT){
				
				$.post("php/edit_anchor.php",{user_media_id:user_media_id,member_id:member_id,img_anchor_id:img_anchor_id,image:image,script:script,start_time:startT,stop_time:stopT},
					function(data) {

							$("#comment").html(data);
						}
				);
			$(this).parents("div.antime").find('input').attr('disabled',true);
			$(this).parents("div.antime").find('textarea').attr('disabled',true);
			$(this).text("更改");
			}else{
				alert("結束時間請大於開始時間");

			}
			}
	).trigger('click');}
	)







$("#play").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).parents("div.antime").attr("title")):thisMovie('player2').sendEvent('SEEK',$(this).parents("div.antime").attr("title"));})

})

function playerReady(obj) {($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}

function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};


function show(obj){
$("#anchor_time").text(Math.floor(obj.position));
//$("div."+Math.floor(obj.position)).siblings('div.antime').css("background-color","").end().css("background-color","#FC9");
$("div."+obj.position).siblings('div.antime').css("background-color","").end().css("background-color","#FC9");
}
</script>
</body>
</html>
