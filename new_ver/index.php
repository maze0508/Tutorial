<?php session_start();
$member_id = $_SESSION['member_id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<!---<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>---->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>


<script>//判斷目前裝置是否為手機，若是則跳到行動版網址
var urlPath ='index';
var urlHref = location.href;

// 如果是手機端訪問首頁， 跳至行動手機版網頁
var arrUrl_webgolds = ['index','post'];  // 緩存頁面做跳轉，除特殊首頁/
for(i in arrUrl_webgolds) {
  if(arrUrl_webgolds[i] == urlPath) {
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { //使用javascript回傳使用者瀏覽裝置的版本
      urlHref = urlHref.replace(urlPath,'m/'+urlPath);
	  if(location.pathname === '/') {//特殊情況首頁
        urlHref='/m'
      }
	  urlHref+='m'; //直接轉到行動版首頁
      window.location = urlHref; //轉址
      break;
    }

  }
}
</script>

<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
#search {
	float: right;

}
img {
     height: auto;
     max-width: 100%;
 }

</style>
</head>
<body>
<div id="logo">
	<?php
	if($_SESSION['compet']==2 || $_SESSION['compet']==3){
		include_once("banner.php");
	}else{
		include_once("banner_stu.php");
	}
	include_once("php/root.php");
	echo"<div id='login'>";
	if($_SESSION['account']){
		echo "<h2>歡迎光臨_<span id='ald'>".$_SESSION['user_name']."</span>	<a id='logout' href='php/logout.php'>，登出</a></h2>";
	}else{
		echo "<h2><a class='colorbox'>登入</a></h2>";
	}
	echo "</div>";
	?>
	
</div>
<!-- start page -->
<div id="page"  >
	<!-- start sidebar -->
	<div id="sidebarI" >

	<?php
		include_once('php/root.php');	
		$query="select subject_id,subject_catalog FROM subject ORDER BY subject_id";
		$result = $mysqli->query($query);
		$sum=1;
		
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		$subject_id = $row['subject_id'];
		$subject_name = $row['subject_catalog'];
			if($sum==1){
				echo "<div class='Class' id='$subject_id' style='background-image:url(images/test/class-up.png);background-size:100%'><table >
							
							</table></div>";
			}
			echo "<div class='Class' id='$subject_id'><table >
						<tr>
							<td><img src='images/test/class-pink.png' style='width:18px;margin:0 10px 0 10px;' /></td>
							
							<td class='Subject' style='width:180px;'>
								<div id='$subject_id' class='go_subject'>$subject_name</div>
							</td>
						</tr>
						</table></div>";
				
			$sum++;
		}
		echo "<div  ><table >
					<tr>
						<td ></td>
						<td  style='width:180px;height:30px'>
							
						</td>
					</tr>
					</table></div>";
		echo "<div  style='background-image:url(images/test/class-down.png);background-size:100%'><table style='height:58px;'>
					<tr>
						<td></td>
						<td  style='width:180px;height:30px'>
							
						</td>
					</tr>
					</table></div>";
		
	?>
	</div>
	
	<!-- end sidebar -->
	<!-- start content -->
	<div id="contentI"  >
		<div id="search">
			<!----<form method="get" action="">---->
				<fieldset>
				<input id="search_key" type="text" name="s" value="" />
				<input id="search_b" type="image" name="imageField" src="images/img10.jpg" />
				</fieldset>
			<!----</form>--->
		</div>
		<div id="media" >
		<?php
			include_once('php/root2.php');	
			$query="select subject_id,subject_catalog FROM subject ORDER BY subject_id";
			$result = $mysqli->query($query);
            $sum=0;
			while($row = $result->fetch_array(MYSQL_ASSOC)){
				$subject_id = $row['subject_id'];
				$subject_name = $row['subject_catalog'];
				
				$query2 = "SELECT * FROM edit_books WHERE subject_id=$subject_id";
				$result2 = $mysqli->query($query2);
				$row2 = $result2->fetch_array(MYSQL_ASSOC);

				if($row2 != null){
					if(($sum%2)==0){
							$bg_color='#e8f5fd';
						}else{
							$bg_color='#f5e7ea';}
					echo"<div style='background-image:url(images/test/home-tit.png);background-size:auto 30px;padding:0px 0px 2px 30px;'><h3 >".$subject_name."</h3></div>";
					echo"<div id='$subject_id ' style='background-color:$bg_color;width: 700px;min-height: 120px;padding: 25px 0px 25px 25px;border-radius:10px;-mos-border-radius:10px;'>";	
					$query3 = "select edit_books.edit_books_id,user_media.user_media_id,user_media.url,user_media.title from edit_books left join user_media on edit_books .user_media_id =  user_media.user_media_id WHERE subject_id='$subject_id' order by edit_books.edit_books_id DESC LIMIT 4";
					$result3 = $mysqli->query($query3);
					
					while($row3 = $result3->fetch_array(MYSQL_ASSOC)){
						
					   $user_media_id = $row3["user_media_id"];
					   $url = $row3["url"];				   
					   $edit_books_id = $row3["edit_books_id"];				   
					   //$title = iconv_substr($row3["title"], 0, 10, 'utf-8');
					   $title = $row3["title"];
					   $found = strstr($url,"youtube");		
                    
					   if($found){
                            $UrlArray = explode("=" , $url);
							$youtube_name = $UrlArray[1];
							echo "<div class='temp_movie' style='float: left;margin: 25px;'><a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'><img style='width: 120px;' src='http://img.youtube.com/vi/$youtube_name/2.jpg'/><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div><br/>";
                       }else{
							echo "<div class='temp_movie' style='float: left;margin-right: 25px;'><a href='vedio_player.php?user_media_id=$user_media_id&edit_books_id=$edit_books_id&subject_id=$subject_id' style='width: 120px;font-size: 13px;font-family: 微軟正黑體;word-break: break-all;'><img style='width: 120px;' src='user_pics/$url.jpg' /><br/><div style='width: 120px;word-break: break-all;'>$title</div></a></div>";
					}
                    }
					$sum++;
					echo"</div><br/><br/>";	
				}
			}
		?>
		</div>
		<!-- end content -->
	</div>
	
<!-- end page -->
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>

</div>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";

$(function(){  
	$('a.colorbox').live("click",function(){
		$(this).colorbox({href:"index2.php",width:"600", height:"500",iframe:true,slideshow:true});
	})
	
	$("div.go_subject").live("click",function(){
		var subject_id=$(this).attr("id");
		var subject_name=$(this).text();
		$.post("php/subject_go.php",{subject_name:subject_name,subject_id:subject_id},function(data) {$("#contentI").html(data);});
	})
	$("div.go_subject").live({
		mouseenter:
			function(){
				$(this).parents('tr').find('img').attr('src','images/test/class-green.png');
				$(this).parents('div.Class').css('background-color','#dcedc9');
				},
		mouseleave:
			function(){
				$(this).parents('tr').find('img').attr('src','images/test/class-pink.png');
				$(this).parents('div.Class').css('background-color','#ffffff');
				}
	});
	$("#search_b").live("click",function(){
		var search_key = $('#search_key').val();
		$.post("php/seartch.php",{search_key:search_key},function(data) {$("#media").html(data);});
	})
})

</script>
</body>
</html>
