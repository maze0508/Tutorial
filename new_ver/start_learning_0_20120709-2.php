<?php session_start();
$member_id = $_SESSION['member_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Video Learning</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
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
width:100%;
margin:5px;
border-bottom:1px solid #666;
padding:3px;
}
.imgs{
border:1px solid;
padding:2px;
margin-right:2px
width:130px;
}
.team{
width:150px;
border:1px solid #360;
float:left;
margin:2px;
color:#663;
text-align:center;
cursor:pointer
}
.team_B{
width:150px;
border:1px solid;
background-color:#FFC;
float:left;
margin:2px;
color:#663;
text-align:center;
cursor:pointer
}
.showT{
background-color:#99C;
}
</style>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body background="./images/bkground.png" onload="MM_preloadImages('./images/stu-Integration2.png','./images/stu-nbook2.png','./images/stu-video2.png')">
<div id="logo">
  <h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['user_name'];?></span>
	<?php
	include_once("php/root.php");
	if($_SESSION['account'])
	echo '<a id="logout" href="php/logout.php">，登出</a>';
	?>	
	</h2>
  <table width="960" height="115">
    <tr>
      <th width="186" height="109" scope="col"><img src="./images/logo1.png" width="150" height="74" alt="logohome" /></th>
      <th width="150" scope="col"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','./images/stu-video2.png',1)"><img src="./images/stu-video1.png" width="105" height="75" border="0" id="Image5" /></a></th>
      <th width="152" scope="col"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','./images/stu-Integration2.png',1)"><img src="./images/stu-Integration1.png" width="105" height="74" border="0" id="Image3" /></a></th>
      <th width="130" scope="col"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','./images/stu-nbook2.png',1)"><img src="./images/stu-nbook1.png" width="105" height="73" border="0" id="Image4" /></a></th>
      <th width="299" scope="col">&nbsp;</th>
      <th width="15" scope="col">&nbsp;</th>
    </tr>
  </table>
</div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content" style="width:100%">
		<div class="post">
			<div class="entry" >
			  <table width="200">
			    <tr>
			      <th scope="col"><img src="./images/stu-mytheme.png" width="470" height="25" alt="stu-mylearningtheme" /></th>
		        </tr>
		      </table>
			  <br/>
				<?php
				session_start();
				$query = "select user_media.url,learning.learning_id,learning.learning_name,user_media.user_media_id,learning.learning_start,learning.learning_end,learning.learning_content,learning.edit_books_id,member.name,subject.subject_catalog,learning_team.team_id from (user_media inner join edit_books on user_media.user_media_id = edit_books.user_media_id) inner join learning on learning.edit_books_id = edit_books.edit_books_id inner join member on learning.member_id = member.member_id inner join subject on learning.subject_id = subject.subject_id inner join (learning_team right join team_member on learning_team.team_id = team_member.team_id) on learning.learning_id = learning_team.learning_id where team_member.member_id = '$member_id'";
				$result = $mysqli->query($query);
				while($row = $result->fetch_array(MYSQL_ASSOC)){
				   $learning_name = $row["learning_name"];
				   $learning_id = $row["learning_id"];
				   $user_media_id = $row["user_media_id"];
				   
					$_SESSION['user_media_id'] = $user_media_id;
				   
				   $learning_start = $row["learning_start"];				   
				   $team_id = $row["team_id"];
				   $learning_end = $row["learning_end"];
				   $learning_content = $row["learning_content"];
				   $edit_books_id = $row["edit_books_id"];
				   $name = $row["name"];				   
				   $subject_catalog = $row["subject_catalog"];	
				   $url = $row["url"];	
				   $found = strstr($url,"youtube");					   
				   ($found)? $aimgs = "<img src='' class='youtube imgs' name='$url' align='top' />" : $aimgs = "<img class='imgs' src='user_pics/$url.jpg' align='top' />";
				   	echo "
					<div class='temp_movie'>
						<div style='width:140px;float:left;'>
							$aimgs
						</div>
						<div style='width:100%;'>
							<label>【 $subject_catalog 】 <a style='text-decoration: none;' href='start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id'>$learning_name</a></label><br>
							<label>註記模式：<a style='text-decoration: none;' href='start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id'>文字註記</a><a style='text-decoration: none;' href='start_learning_1_2.php?user_media_id=$user_media_id&team_id=$team_id'>、圖片註記</a></label><br>
							<label>主題作者：$name</label><br>
							<label>學期期限：$learning_start ~ $learning_end</label><br>
							<label>學習概念：$learning_content</label>
						</div>
						<div style='width:100%;height:50px;display:none;overflow:auto'></div>
					</div>					
					";
					
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
