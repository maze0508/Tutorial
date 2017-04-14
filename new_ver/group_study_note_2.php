<?php session_start();
$member_id = $_SESSION['member_id'];
$user_media_id = mysql_escape_string($_GET['user_media_id']);
$team_id = mysql_escape_string($_GET['team_id']);
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
<link rel="stylesheet" type="text/css" href="css/component.css" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
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
#cboxLoadedContent{
		background:#000000;
		}
</style>
</head>
<body>
<div id="logo">
	<?php
	include_once("banner1_1.php");
	?>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['user_name'];?></span>
	<?php
	include_once("php/root.php");
	if($_SESSION['account'])
	include_once("banner_logout.php");//登出按鈕
	?>	
	</h2>
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
         <div class="Tit"><img src="images/test/pic-Tit.png"/>
            <a href="index.php" title="個人書房">個人書房</a> >> <a href="group_study.php" title="小組學習主題">小組學習主題</a></div><br/><br/>
		<div class="post">
			<div class="entry">
			<?php
				//$user_media_id = mysql_escape_string($_GET['user_media_id']);
				//$team_id = mysql_escape_string($_GET['team_id']);
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
			?>
				<?php
				$query = "SELECT user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id' AND user_media.user_media_id = '$user_media_id'";
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
				   $media_type .= $row['media_type']; 					   
				      	echo "
						<div style='width:100%;'>
                            <h2>$learning_name</h2>
							<h3>● 學習概念：$learning_content</h3>
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
                    if($title && $found){
                        //echo $url;
				        $UrlArray = explode("=" , $url);
                        $youtube_name = $UrlArray[1];
				        //print_r($UrlArray); 
				    ?>
				        <iframe width="1000" height="600" src="https://www.youtube.com/embed/<?php echo "$youtube_name"; ?>" frameborder="0" allowfullscreen></iframe>
				    <?php	
				    }else if($title && $media_type){
						/*else
						echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; */
						?>
				        <video id="MovieShow" preload="auto" controls loop width="1000" height="600">
				    <?php
				        if(strstr($media_type,"mp4"))
				            echo "<source src=\"user_movie/".$url.".mp4\" type = 'video/mp4'>";
				        else if(strstr($media_type,"ogg"))
				            echo "<source src=\"user_movie/".$url.".ogv\" type = 'video/ogg'>";
				        else if(strstr($media_type,"webm"))
				            echo "<source src=\"user_movie/".$url.".webm\" type = 'video/webm'>";
				        //else
				          //  echo "您的瀏覽器不支援HTML5影片播放";
				    ?>
				        </video>
				    <?php
                    }else{				
				    ?>
				<embed type="application/x-shockwave-flash" id="player2" name="player2" src="player.swf" width="1000" height="600" allowscriptaccess="always"  allowfullscreen="true"
				    <?php
						if($user_media_id && $found)
						echo "flashvars='file=$url'";
						else if($user_media_id)	
						echo "flashvars='file=user_movie/$url.flv&image=user_pics/$url.jpg'";
					?> />
                <?php
                }
                ?>
				</object>
				</div>
				<span type="text" id="anchor_time">0</span>
				<label id="anchor" class='ibutton' style='background-color:#F60'>留下註記</label>
			</div>
			
			
			<div style="float:right;width:120px">
				<a style='text-decoration: none;' href='group_note_classification_2.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>'><img src="images/test/stu-cf3.png" /><!-- 整理註記 --></a>
	</div>
	</div>
	</div>
	<!-- end content -->
<!-- start 右側滑動選單 start-->
<div class="cbp-spmenu-push">
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<h3>我的註記</h3>
	<?php
		$query="SELECT member.name, group_image.image, group_image.noteColor, group_image.group_image_id, group_image.anchor_time
				FROM member
				LEFT JOIN group_image ON member.member_id = group_image.member_id
				WHERE user_media_id = '$user_media_id'
				AND group_image.member_id = '$member_id'
				ORDER BY group_image.anchor_time
				";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$name = $row['name'];
			$anchor_time = $row['anchor_time'];
			$image = $row['image'];
			$group_image_id = $row['group_image_id'];
			$noteColor = $row['noteColor'];
			
			$s   =   $anchor_time%60;
			$m   =   floor($anchor_time/60);
			//$o   =   floor($m/60);
			$m = ($m < 10)?"0".$m:$m;
			$s = ($s < 10)?"0".$s:$s;
			
			if($noteColor==0){
				echo "
						<table id='$group_image_id' style='border-top:1px solid;cursor:pointer'>
						<tr>
							<td style='width:205px;'><div id='$anchor_time' class='antime $anchor_time' >[$m:$s] $name 說：<br> <img class='image' style='width:200px;' src='./images/anchor/$image'/></div></td>
							<td style='width:16px;'>
								<div><img class='delete_button' style='width:16px;'src='./images/cancel.png';></img></div>
								<div><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></div>
							</td>
						</tr>
						</table>
					";
			}
		}
		
	?>
		</nav>
		<div class="container">
        <button id="showRight" class="cbp-spmenu-vertical cbp-spmenu-right cbp-spmenu-open"> 我的註記 </button>
	  </div>
  </div>

		<script src="js/classie.js"></script>
		<script>
			var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRight = document.getElementById( 'showRight' );
				body = document.body;
				showRight.onclick = function() {
					classie.toggle( this, 'active' );
					classie.toggle( menuRight, 'cbp-spmenu-open' );
					disableOther( 'showRight' );
			};
			function disableOther( button ) {
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
			}
		</script>						
      <!-- end 右側滑動選單-->
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
var team_id = "<?php print $team_id; ?>";
var title = "<?php print $title; ?>";
var url = "<?php print $url; ?>";
var edit_media_image_id;
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
$.post("php/insert_anchor_image.php",{member_id:member_id,user_media_id:user_media_id,team_id:team_id,url:url,anchor_time:$("#anchor_time").text(),privacy:"privacy"},function(data) {
action='新增圖片註記';
record(member_id,action);
alert('已留下註記!!'); $("#comment").html(data); 
});
}else
alert("請先登入");
})



$('body').keydown(function(){
    var keycode = window.event.keyCode;
    if( keycode == 13 )
    {
	if(member_id.length>=1){
		$.post("php/insert_anchor_image.php",{member_id:member_id,user_media_id:user_media_id,team_id:team_id,url:url,anchor_time:$("#anchor_time").text(),privacy:"privacy"},function(data) {
		($.browser.msie)?thisMovie('player').sendEvent('play','false'):thisMovie('player2').sendEvent('play','false')
		alert('已留下註記!!'); $("#comment").html(data); 
	});
	}else
		alert("請先登入");
    }
});

$("div.antime").live("click",function(){($.browser.msie)?thisMovie('player').sendEvent('SEEK',$(this).attr("id")):thisMovie('player2').sendEvent('SEEK',$(this).attr("id"));})

$(".delete_button").live("click",function(){
	//alert("ok");
	if(member_id.length>=1){
		var button_type="image";
		var group_anchor_id=$(this).parents('table').attr('id');
		//alert(media_anchor_id);
		$.post("php/group_delete_anchor.php",{button_type:button_type,group_anchor_id:group_anchor_id,button:"delete"},function(data) {
			var del_anchor="table#"+group_anchor_id;
			action='刪除圖片註記';
			record(member_id,action);
			 $(del_anchor).remove(); 
		});
	}else
	alert("請先登入");
})
//裁剪圖片
$('.edit_button').live("mouseover",function(){
	action='編輯圖片註記';
	record(member_id,action);
	edit_group_image_id=$(this).parents('table').attr('id');
	$(this).colorbox({href:"group_crop.php?group_image_id="+edit_group_image_id+"",width:"600", height:"500",iframe:true,slideshow:true});
})
$(document).bind('cbox_closed', function(){
		$.post("php/insert_anchor_image.php",{member_id:member_id,user_media_id:user_media_id,team_id:team_id,privacy:"privacy"},
			function(data) {//alert(data);
			$("#sidebar").html(data);});
	});
/*$("#cboxClose").live("click",function(){
	var button="close";
	//var id=$('.article').attr('id');
	//var id2=$('div[class*=antime]').attr('id');
	//alert(id2);
	//alert(edit_media_image_id);
	$.post("./php/crop_archive.php",{button:button,member_id:member_id,user_media_id:user_media_id},function(data) {
	
			$("#comment").html(data); 
	});
})*/

})

function playerReady(obj) {
action='觀看影片-'+title;
record(member_id,action);
($.browser.msie)?thisMovie('player').addModelListener('TIME','show'):thisMovie('player2').addModelListener('TIME','show');}

function thisMovie(movieName) {if(navigator.appName.indexOf("Microsoft") != -1){return window[movieName];} else {return document[movieName];}};


function show(obj){
	$("#anchor_time").text(Math.floor(obj.position));
	$("div.antime").parents('table').css("background-color","");
	$('#sidebar').scrollTop();
	$("div."+Math.floor(obj.position)).parents('table').css("background-color","#FC9");
//$("#anchor_time").text(Math.floor(obj.position));
//$("div."+Math.floor(obj.position)).siblings('div.antime').css("background-color","").end().css("background-color","#FC9");
}

function record(member_id,action){
	$.post("php/record.php",{member_id:member_id,action:action},function(data) {
	});
}

</script>
</body>
</html>
