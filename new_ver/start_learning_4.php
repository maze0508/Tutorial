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
.child{
border-bottom:1px solid;cursor:pointer;
color:#701FBD;
}
</style>
</head>
<body>
<div id="logo">
	<h1><a href="#">Video Learning</a></h1>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['account'];?></span>
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
	<div id="content" style="width:100%">
		<div class="post">
			<div class="entry"   style="float:left">
			<?php
				$user_media_id = mysql_escape_string($_GET['user_media_id']);
				$team_id = mysql_escape_string($_GET['team_id']);
				if(!$user_media_id){
				echo "<script>document.location.href='index.php'</script>";
				return false;
				}
			?>
				<div style="width:410px;float:left">
					<label>◎一起解答子問題同步討論區..(請稍待)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="button" id="newd" value="瀏覽對話內容">
					<div id="roomlist" style="width:405px;height:400px;border:1px solid;background-color:#F5FCEE;overflow:auto"></div>
					<input type="text" id="speak" size="55" style="background-color:#E6F8D4">
					<input type="button" id="send_A" value="送出">
					
				</div>
				<div style="width:450px;float:left">
					<label>※子問題列表-(點擊可下拉看相關資料)</label><br/>				
						<div id="chil_list" style="height:400px;background-color:#FCEEFC;width:440px;overflow:auto">
						<?php
						$query="select children_id,name,date,children_content,children_area from children where user_media_id='$user_media_id' AND team_id='$team_id'  order by children_id desc";
						$result = $mysqli->query($query);
						while($row = $result->fetch_array(MYSQL_ASSOC)){
							$name = $row['name'];
							$date = $row['date'];
							$children_id = $row['children_id'];				
							$children_content = $row['children_content'];
							$children_area = $row['children_area'];
							echo "
							<div id='$children_id' class='child'><img src='images/down32.png' /> [$date] $children_content (由 $name 發表)
								<div style='color:#000;margin-left:50px;' class='relate_list'></div>
								<textarea rows='7' cols='45' class='anser' style='margin-left:35px;background-color:#DC7100' >$children_area </textarea>	
								<input type='button' value='更改結論' class='cheange' style='margin-left:35px' id='$children_id'>
							</div> ";
						}
						?>
						</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->

	<!-- end sidebar -->
</div>
<!-- end page -->

<div id="footer">
	<div style="width:120px;float:left;text-align:left;">
		<a style='color:#3799FF' href="start_learning_3.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>"><img src="images/left128.png" />Step4 小組討論</a>
	</div>
	<div style="width:120px;float:right;text-align:right">
		<a style='color:#3799FF' href="start_learning_5.php?user_media_id=<?php print $user_media_id; ?>&team_id=<?php print $team_id; ?>"><img src="images/right128.png" />Step6 撰寫個人心得</a>
	</div>	
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

$("#send_A").click(function(){
if($("#speak").val() != ""){
	$.post("php/insert_room.php",{user_media_id:user_media_id,team_id:team_id,name:name,speak:$("#speak").val(),step:"5"},function(data) {
		$("#speak").val("")
	});}
})

setInterval("chatroom()", 1000); 


$("div.child").click(function(){
var tmp = $(this);
tmp.children("div.relate_list").show().end().siblings("div.child").children("div.relate_list").hide();
	$.post("php/select_children_relate.php",{children_id:$(this).attr("id")},function(data) {
		tmp.children("div.relate_list").html(data)
	})
})

$("input:button.cheange").live("click",function(){
	$.post("php/update_answer.php",{children_id:$(this).attr("id"),children_area:$(this).prev("textarea").val()},function(data) {
		alert("已儲存變更結論")
	})
})

$("#newd").click(function(){
window.open ("window.php?content="+$("#roomlist").html(), 'newwindow', 'height=400, width=400, top=0, left=0, toolbar=no, menubar=no, scrollbars=yes, resizable=no,location=no, status=no') 
})

$('body').keydown(function(){
    var keycode = window.event.keyCode;
    if( keycode == 13 )
    {
		if($("#speak").val() != ""){
			$.post("php/insert_room.php",{user_media_id:user_media_id,team_id:team_id,name:name,speak:$("#speak").val(),step:"5"},function(data) {
				$("#speak").val("")
		});}
    }
});


})



function chatroom(){
　　$.post("php/select_room.php",{user_media_id:user_media_id,team_id:team_id,step:"5"},function(data) {
		if(data)
		$("#roomlist").html(data).scrollTop($('#roomlist')[0].scrollHeight)
	});
}

</script>
</body>
</html>
