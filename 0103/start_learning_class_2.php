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
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2/swfobject.js"></script>
<link href="css/uploadify.css" rel="stylesheet" type="text/css" />
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
#del_class{
float:right;
}
#uploadify{
width:110px;
height:30px;
color:#FFFFFF;
background-color:#555555;
border-style:none;
font-weight:bold;

}
#cboxLoadedContent{
		background:#000000;
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
	<!-- start sidebar -->
	<div id="sidebarC" style='margin-right:0px;'>
	
	
	<div class='Class' id=''><table cellspacing="0">
	<tr>
		<td style='width: 20px;background-size: auto 58px;background-position-x: left;background-image:url(images/test/stu-red.png);padding-right: 0px;padding-left: 0px;'></td>
		<td style='width:215px;background-color:#f6dfe1;'><div id='all_class' class='go_class'>All</div></td>
		<td style='width:16px;background-color:#f6dfe1;'><div></div>
		<div></div></td>
	</tr>
	</table></div>
	<div id='other_class'>
	
	
	<?php
		$sum=1;	
		$query="SELECT member.name,  anchor_class.anchor_class_id,anchor_class.anchor_class_name FROM member  LEFT JOIN anchor_class ON member.member_id = anchor_class.member_id WHERE user_media_id ='$user_media_id' AND anchor_class.member_id ='$member_id' AND anchor_class.type ='1' ORDER BY anchor_class.anchor_class_id ";
		$result = $mysqli->query($query);
		
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		$an=$sum%5;
		
		if($an==0){
			$bg_img='images/test/stu-red.png';
			$bg_color='#f6dfe1';}
		if($an==1){
			$bg_img='images/test/stu-oran.png';
			$bg_color='#f7efdf';}
		if($an==2){
			$bg_img='images/test/stu-green.png';
			$bg_color='#eef3e2';}
		if($an==3){
			$bg_img='images/test/stu-blue.png';
			$bg_color='#dfeff7';}
		if($an==4){
			$bg_img='images/test/stu-pur.png';
			$bg_color='#f2ecf1';}
		$anchor_class_id = $row['anchor_class_id'];
		$anchor_class_name = $row['anchor_class_name'];
		
	
		
		echo "<div class='Class' id='$anchor_class_id'><table cellspacing='0'>
					<tr>
						<td style='width: 20px;background-size: auto 58px;background-position-x: left;background-image:url($bg_img);padding-right: 0px;padding-left: 0px;'></td>
						<td class='class_name' style='width:215px;background-color:$bg_color;'>
							<div id='$anchor_class_id' class='go_class'>$anchor_class_name</div>
							<div id='class_textarea'style='display:none;'><input type='text' id='class_name_new'  size='10' maxlength='20' value='$anchor_class_name' /><button id='class_change'>確定</button><button id='class_cancel'>取消</button></div>
						</td>
						<td style='width:16px;background-color:$bg_color;'>
						
							<div><img id='del_class' style='width:16px;'src='./images/cancel.png';></img></div>
							<div><img id='edit_class' style='width:16px;'src='./images/tag_blue_add.png';></img></div>
						</td>
					</tr>
					</table></div>";
		$sum++;			
		}
		
		
	?>
	
	</div>
	<p style="margin-left: 15px;margin-top: 0px;"><input type="text" id="class_name"  size="20" maxlength="50" value="" />
				<button id="add_class">新增</button>
	</p>
	<p> </p>
	<a style='text-decoration: none;' href='start_learning_arrange.php?&team_id=<?php print $team_id; ?>'><img style="margin-left: 80px;" src="images/test/stu-Integration3.png" /><br/><!-- 統整 --></a>
	</div>
	
	<!-- end sidebar -->
	<!-- start content -->
	<div id="contentC" style='background-color:#f6dfe1;margin-left:0px;'>
	<?php
		//$anchor_class_id="";
		echo"<div id='' class='class_anchor'>";
		$query="select member.name,media_image.media_image_id,media_image.image,media_image.noteColor,media_image.anchor_time,anchor_class.anchor_class_id,anchor_class.anchor_class_name  from member left join media_image on member.member_id =  media_image.member_id LEFT JOIN anchor_class ON media_image.anchor_class_id= anchor_class.anchor_class_id where media_image.user_media_id = '$user_media_id' AND media_image.member_id = '$member_id'  order by media_image.anchor_time";
		$result = $mysqli->query($query);
		
		while($row = $result->fetch_array(MYSQL_ASSOC)){
		
		
			$anchor_class_id = $row['anchor_class_id'];
			$name = $row['name'];
			$image = $row['image'];
			$media_anchor_id = $row['media_image_id'];
			$noteColor = $row['noteColor'];
			if($row['anchor_class_id']){
			
			$class_name = $row['anchor_class_name'];
			
			
			}else{
			$class_name = "未分類";
			
			}
			if($noteColor==0){
			
				echo "<div id='$media_anchor_id' class='Note' name='未分類'>
					<div name='$class_name' class='select_edit'>
					<table><tr><td style='width:165px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
					<td style='width:16px;'><img class='edit_button' style='width:16px;margin-right: 10px;'src='./images/tag_blue_add.png';></img></td></tr></table></div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<p><img class='note_descript' style='width:145px;' src='./images/anchor/$image';/></p>
						
					</div>
				</div>";
				
			}else{
				echo "<div id='$media_anchor_id' class='Note_other' name='未分類'>
					<div name='$class_name' class='select_edit'>
						<table>
							<tr>
								<td style='width:110px;'><div name='$anchor_class_id' class='select_class' >$class_name</div></td>
								<td style='width:16px;'><img class='del_note' style='width:16px;'src='./images/cancel.png';></img></td>
								<td style='width:16px;'><img class='edit_button' style='width:16px;'src='./images/tag_blue_add.png';></img></td>
							</tr>
						</table>
					</div>
					<div  style='border-top:1px solid;cursor:pointer;width: 155px;' id='$media_anchor_id' class='descript_edit'>
						<p><img class='note_descript' style='width:145px;' src='./images/anchor/$image';/></p>
						
					</div>
				</div>";
				}
		}
		echo"<div id='all_class' class='Note_other' name='未分類'>
		<div><div>新增註記</div></div>
			<div  style='border-top:1px solid;cursor:pointer;width: 155px;'>
			<div class='entry'>
				<div style='text-align:top'>
				<button type='button' name='uploadify' id='uploadify'>Browser</button>
				
				</div>
				<div id='Queue'></div>
				<div id='filesUploaded'></div>
				
			</div>
			</div>
			</div>
		
	</div>";
	echo "</div>";
	?>
	
</div>	
				
		
	
	<!-- end content -->
</div>
<!-- end page -->
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>

<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="js/menu.js"></script>
<script type="text/javascript">
var member_id = "<?php print $_SESSION['member_id']; ?>";
var compet = "<?php print $_SESSION['compet']; ?>";
var user_media_id = "<?php print $user_media_id; ?>";
//var edit_media_image_id;






$(function(){  

$("#uploadify").live("mouseover",function(){
var anchor_class_id=$(this).parents('div.Note_other').attr('id');
$(this).uploadify({
//$(document).ready(function() {
//$("#uploadify").uploadify({
		'buttonText'	 : 'Browser',
		'uploader'       : 'swf/uploadify.swf',
		'script'         : 'uploadimg.php',
		'cancelImg'      : './images/cancel.png',
		'queueID'        : 'Queue',
		'sizeLimit'		 : '1048576',	//8925684--8.8MB
		'fileExt'  		 : '*.jpg;',
		'scriptData'	 : {'member_id':member_id,'user_media_id':user_media_id,'anchor_class_id':anchor_class_id},    //這行是可以帶value到後端，但會有亂碼，所以前面才要base64編碼
		'auto'           : true,
		'multi'          : false,
		'queueSizeLimit' :'5',
		'onSelect'       :function(e, queueId, fileObj){
		if(fileObj.size > 1048576){
		alert(fileObj.name+"檔案太大，限制為1mb");
		$('#uploadify').fileUploadClearQueue(e);
		}
		},
		'onAllComplete'  :function(e, queueId, fileObj){

			var button_type="image";
			$.post("php/class_go.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		
			function(data) {
				$("#contentC").html(data);
			
			});
		}
});
});


	$("img.del_note").live("click",function(){

		var button_type="image";
		var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
		$.post("php/delete_anchor.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,media_anchor_id:media_anchor_id},
		
			function(data) {});
			
			$(this).parents('[class*=Note]').remove();

	})
	
	$('.edit_button').live("mouseover",function(){
		edit_media_image_id=$(this).parents('[class*=Note]').attr("id");
		$(this).colorbox({href:"crop.php?media_image_id="+edit_media_image_id+"",width:"600", height:"500",iframe:true,slideshow:true});
	})
	
	
	$(document).bind('cbox_closed', function(){
		var edit_note_class_id=$('div.class_anchor').attr('id');
		if(edit_note_class_id==""){
			var anchor_class_id="all_class";
		}else{
			var anchor_class_id=edit_note_class_id;
		}
		//alert(anchor_class_id);
		var button_type="image";
		$.post("php/class_go.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
			function(data) {//alert(data);
			$("#contentC").html(data);});
	});


	 $('div.select_class').live("click",function(){
		var button_type="image";
		var anchor_class_id=$(this).attr("name");
		var anchor_class_name=$(this).parents('div.select_edit').attr("name");
		var media_anchor_id=$(this).parents('[class*=Note]').attr("id");

		$.post("php/class_select.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id,anchor_class_name:anchor_class_name},
		
			function(data) {
			var anchor_id="div#"+media_anchor_id+" .select_edit";
			$(anchor_id).html(data);
			});
	})

	 $('button#select_change').live("click",function(){
		var button_type="image";
		var select_val=$(this).siblings('select').attr("value");
		var select_text=$(this).siblings('select').find("option:selected").text();
		var class_name=$(this).parents('[class*=Note]').attr("name");
		var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
		var note_type=$(this).parents('[class*=Note]').attr("class");
	
		if(class_name=="未分類"){
			$.post("php/class_select.php",{button_type:button_type,note_type:note_type,button:"class_change",member_id:member_id,user_media_id:user_media_id,anchor_class_id:select_val,anchor_class_name:select_text,media_anchor_id:media_anchor_id},
		
				function(data) {
					var anchor_id="div#"+media_anchor_id+" .select_edit";
					$(anchor_id).html(data);});
				
		}else{
		
			$.post("php/class_select.php",{button_type:button_type,note_type:note_type,button:"class_change",member_id:member_id,user_media_id:user_media_id,anchor_class_id:select_val,anchor_class_name:select_text,media_anchor_id:media_anchor_id},
		
				function(data) {
					var anchor_id="div#"+media_anchor_id+" .select_edit";
					$(anchor_id).html(data);});
				if(select_text!=class_name){
				$(this).parents('[class*=Note]').remove();
				}
		
		}

	})
	 $('button#select_canncel').live("click",function(){
		var select_val=$(this).siblings('button#select_change').attr("name");
		var select_text=$(this).attr("name");
		var media_anchor_id=$(this).parents('[class*=Note]').attr("id");
		var note_type=$(this).parents('[class*=Note]').attr("class");
		var button_type="image";
		$.post("php/class_select.php",{button_type:button_type,note_type:note_type,button:"canncel",member_id:member_id,user_media_id:user_media_id,anchor_class_id:select_val,anchor_class_name:select_text,media_anchor_id:media_anchor_id},
		
			function(data) {

				var anchor_id="div#"+media_anchor_id+" .select_edit";
				$(anchor_id).html(data);});

		

	})
	
	$("div.go_class").live("click",function(){
		var anchor_class_id=$(this).attr("id");
		var bg_color=$(this).parent('td').css('background-color');
		var button_type="image";
		$.post("php/class_go.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		
			function(data) {
			$("#contentC").css('background-color',bg_color);
			$("#contentC").html(data);});

	})



	$("#add_class").live("click",function(){
		var button_type="image";
		if(member_id.length>=1){
			$.post("php/class_add.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_name:$("#class_name").val()}
			,function(data) {
				 $("#other_class").html(data); 
				 $("#class_name").val('')
			});
		}else
			alert("請先登入");
	})

	$("#del_class").live("click",function(){
		
		var button_type="image";
		var anchor_class_id=$(this).parents("div.Class").attr("id");
		var class_name=$(this).parents('div.Class').find('td.class_name').children('[class*=go_class]').text();

		$.post("php/class_del.php",{button_type:button_type,member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		
			function(data) {$("#contentC").html(data);});
			
			$(this).parents("div.Class").remove();

	})

	 $('img#edit_class').live("click",function(){

		$(this).parents('.Class').find('div.go_class').hide();
		$(this).parents('.Class').find('div#class_textarea').show();

	})
	 $('button#class_change').live("click",function(){
		var button="class";
		var anchor_class_id=$(this).parents("div.Class").attr("id");
		var class_name_new=$(this).siblings('input#class_name_new').val();
		var class_name_old=$(this).parents('td.class_name').children('[class*=go_class]').text();

		
		$.post("php/note_edit.php",{button:button,member_id:member_id,user_media_id:user_media_id,media_anchor_id:anchor_class_id,anchor_descript_new:class_name_new},

			function(data) {
			var anchor_id="div.Class#"+anchor_class_id;
			$(anchor_id).find('td.class_name').html(data);});
			
		$.post("php/class_go.php",{member_id:member_id,user_media_id:user_media_id,anchor_class_id:anchor_class_id},
		
			function(data) {$("#contentC").html(data);});
	});
	
	 $('button#class_cancel').live("click",function(){

		var class_name_old=$(this).parent().siblings('div.go_class').text();
		$(this).siblings('input#class_name_new').val(class_name_old);
		$(this).parent().hide();
		$(this).parent().siblings('div.go_class').show();
	});

	
});

</script>
</body>
</html>
