<?php session_start();
if(!$_SESSION['account'] || $_SESSION['compet'] < 2)
echo "<script>document.location.href='sign.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Digital Teaching</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="screen" href="css/screen.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.datepicker.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
<style type="text/css">
form.cmxform label.error { display: none; }	
</style>
</head>
<body>
			<table width="100%" border="1">
			  <tr>
				<td width="50%">
					<label style="color:red">[學習主題]</label><br/>
					<form class='cmxform' id='eform' name='edit' method='post' action='php/insert_learning.php'>
					<input type="hidden" name="member_id" value="<?php print $_SESSION['member_id']; ?>">
					<label>主題名稱：</label><input type="text" name="learning_name" id="learning_name" class="required" /><br/>
					<label>是否開放：</label><select name="publish" id="publish"><option value="Y">是</option><option value="N">否</option></select><br/>
					<?php
					include_once("php/root.php");
					$edit_books_id = mysql_escape_string($_GET['edit_books_id']);
					echo "<label>主題學科：</label>";
					$query = "select subject_id,subject_catalog from subject";//*4
					$result = $mysqli->query($query);
					while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $subject_id = $row["subject_id"];
					   $subject_catalog = $row["subject_catalog"];
					   $subject_opt .= "<option value='$subject_id'>$subject_catalog</option>";
					}
					echo "<select name='subject_id' id='subject_id'>$subject_opt</select><br/>";
					?>
					<input type="hidden" name="edit_books_id" value="<?php print $edit_books_id; ?>">
					<label>主題開始時間：</label><input type="text" name="learning_start" id="learning_start" class="required" readonly="readonly" /><br/>
					<label>主題結束時間：</label><input type="text" name="learning_end" id="learning_end" class="required" readonly="readonly" /><br/>
					<label>主題敘述：</label><br/>
					<textarea name="learning_content" id="learning_content" cols="35" rows="5" class="required"></textarea><br/>
					<input class="submit" id="learning_subit" type="submit" value="建立學習主題"/>
					</form>
				</td>
				<td valign="top">
					<label style="color:red">[教材參考資訊]</label><br/>
					<?php
					
					$query = "select density.density_catalog,difficulty.difficulty_catalog,edit_books.edit_books_id ,edit_books.slesson,edit_books.learn_source,edit_books.context,edit_books.intended_user,edit_books.learn_time,edit_books.books_target,edit_books.books_content,edit_books.books_concept,edit_books.books_step from edit_books left join density on edit_books.density_id  = density.density_id left join difficulty on edit_books.difficulty_id = difficulty.difficulty_id where edit_books.edit_books_id ='$edit_books_id' limit 0,1";
					$result = $mysqli->query($query);
					while($row = $result->fetch_array(MYSQL_ASSOC)){
					   $density_catalog .= $row["density_catalog"];
					   $difficulty_catalog .= $row["difficulty_catalog"];
					   $slesson .= $row["slesson"];
					   $learn_source .= $row["learn_source"];
					   $context .= $row["context"];
					   $intended_user .= $row["intended_user"];
					   $learn_time .= $row["learn_time"];
					   $books_target .= $row["books_target"];
					   $books_content .= $row["books_content"];
					   $books_concept .= $row["books_concept"];
					   $books_step .= $row["books_step"];				   
					}
				   echo "<b>語意密度： </b>$density_catalog";
				   echo "<br><b>困難度： </b>$difficulty_catalog";
				   echo "<br><b>適用年級： </b>$slesson";				   
				   echo "<br><b>情境： </b>$context";				   
				   echo "<br><b>基本教學時數： </b>$learn_time";
				   echo "<br><b>適用對象： </b>$intended_user";
				   echo "<br><b>學習資源類型： </b>$learn_source";		
				    echo "<br><b>學習目標： </b>$books_target";
				    echo "<br><b>學習內容： </b>$books_content";
				    echo "<br><b>學習概念： </b>$books_concept";
				    echo "<br><b>學習步驟： </b>$books_step";
					?>
				</td>
			  </tr>
			</table>

<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-TW.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";

$("#eform").validate(); //驗證註冊資料

$("#learning_start").datepicker({showOn: 'both',dateFormat: 'yy-mm-dd',buttonImageOnly: true,buttonImage: 'images/calendar.gif'});
$("#learning_end").datepicker({showOn: 'both',dateFormat: 'yy-mm-dd',buttonImageOnly: true,buttonImage: 'images/calendar.gif'});

$("#learning_subit").click(function(){
if($("#learning_end").val() < $("#learning_start").val()){
alert("結束日期不能比開始日期早");
return false;
}
else
return true;
})

})
</script>
</body>
</html>
