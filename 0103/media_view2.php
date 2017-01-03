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
width:132px;
float:left;
margin:5px;
border:1px solid #666;
padding:3px;
text-align: center;
height:115px
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
				<h3>【多媒體影片列表】</h3>
				<br/>
				<?php
				$query = "select user_media.user_media_id,user_media.url,user_media.title from user_media where user_media.title is not null ";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $user_media_id = $row["user_media_id"];
				   $url = $row["url"];				   
				   $title = iconv_substr($row["title"], 0, 10, 'utf-8');
				   $found = strstr($url,"youtube");				   
				   if($found)
						echo "<div class='temp_movie'><a href='img_anchor.php?user_media_id=$user_media_id'>$title<img src='' class='youtube' name='$url' /></a></div>";
				   else
						echo "<div class='temp_movie'><a href='img_anchor.php?user_media_id=$user_media_id'>$title<img src='user_pics/$url.jpg' /></a></div>";
						
				}
				mysqli_free_result($result);
				?>	
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/jyuotube.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";
var handlerA = function(){ $(this).attr("src","images/remove.jpg") };

$("img.youtube").each(function(){
$(this).attr("src", $.jYoutube($(this).attr("name"), "small")).bind("error.A",handlerA);
})





})
</script>
</body>
</html>
