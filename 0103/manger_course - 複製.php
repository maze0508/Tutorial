<?php session_start();
if(!$_SESSION['account'] || $_SESSION['compet'] < 3)
echo "<script>document.location.href='index.php'</script>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Digital Teaching</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/demo_page.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/demo_table.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.datepicker.css" />
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
width:120px;
float:left;
margin:5px;
border:1px solid #F90;
padding:3px;
text-align: center;
}
</style>
</head>
<body>
<div id="logo">
	<h1><a href="#">Digital Teaching</a></h1>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['account'];?></span>
	<?php
	if($_SESSION['account'])
	echo '<a id="logout" href="php/logout.php">，登出</a>';
	?>	
	</h2>
</div>
<div id="menu">
	<ul>
		<li class="first"><a href="#" accesskey="1" title="">Home</a></li>
		<li><a href="media_view.php" accesskey="2" title="">多媒體</a></li>
		<li><a href="#" accesskey="3" title="">Blogs</a></li>
		<li><a href="#" accesskey="4" title="">About Us</a></li>
		<li><a href="#" accesskey="5" title="">Contacts</a></li>
		<li><a href="sign.php" accesskey="6" title="">會員功能</a></li>
	</ul>
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
	<div id="content" style="width:100%">
		<div class="post">
			<h2 class="title">課程管理_(admin)</h2>
			<div class="entry">		
			<table id="example" cellpadding="0" cellspacing="0" border="0" class="display" >
			<thead>
				<tr>
				    <th width="10%"><img src="images/check.png" id="all" title="全選/取消"></th>
				    <th width="10%">課堂名</th>
					<th width="10%">教師</th>
					<th width="10%">開始日</th>
					<th width="10%">結束日</th>
					<th>課程簡介</th>
					<th width="20%">學生群</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="7"  class="dataTables_empty">資料讀取中...</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th><input type="button" id="del" value="刪除"></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
		</table>	
			</div>
		</div>

	</div>
	<!-- end content -->
	<!-- start sidebar -->

	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
<script type="text/javascript" src="js/ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-TW.js"></script>
<script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript">

$(function(){  
var member_id = "<?php print $_SESSION['member_id']; ?>";

$('#example').dataTable( {
	"bProcessing": true,
	"bServerSide": true,
	"sAjaxSource": "php/manger_course.php",
		"sPaginationType": "full_numbers",
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			$('td:eq(0)', nRow).html(
			"<input type='checkbox' class='checkbox' value='"+aData[0]+"'> <img title='儲存' name='"+aData[0]+"' id='save' style='cursor:pointer' src='images/table_save.png'> <img src='images/unlock16.png' class='unlock' style='cursor:pointer' title='編輯此列'>");
			$('td:eq(1)', nRow).html("<input type='text' class='edit' size='10' disabled='disabled' value='"+aData[1]+"'>");
			$('td:eq(2)', nRow).html(aData[2]);
			$('td:eq(3)', nRow).html("<input type='text' class='edit date' size='8' disabled='disabled' readOnly value='"+aData[3]+"'>");
			$('td:eq(4)', nRow).html("<input type='text' class='edit date' size='8' disabled='disabled' readOnly value='"+aData[4]+"'>");
			$('td:eq(5)', nRow).html("<input type='text' class='edit' size='30' disabled='disabled' value='"+aData[5]+"'>");
			$('td:eq(6)', nRow).html('<a class="colorbox" id="'+aData[0]+'" style="cursor:pointer">(按我管理學生)</a>');

		return nRow;},
		"aaSorting": [[ 1, "desc" ]], //預設排序，數字代表欄位
		"aoColumns": [{ "bSearchable": false,"bSortable": false,},null,null,null,null,null,null],
		//逗號之間區隔顯示隱藏欄位，bSearchable是說該欄位能否被搜尋到
		"fnDisplayStart":function(){
		alert('')
		}
} )

$('a.colorbox').live("mouseover",function(){
$(this).colorbox({href:"import_course_students.php?course_id="+this.id+"",width:"600", height:"500",iframe:true,slideshow:true});
})




$("#all").toggle(function(){
$("input[type=checkbox].checkbox").attr("checked", true);
},function(){
$("input[type=checkbox].checkbox").attr("checked", false);
})

$("#del").live("click",function(){
if (confirm("你確定要刪除此筆資料?") ){
var courses = $('input[type=checkbox].checkbox:checked').map(function(i,n) {return $(n).attr('value');}).get(); //get converts it to an array
if(courses.length == 0) {alert('請勾選方塊'); return false;}
$.post("php/del_course.php",{'course_id[]':courses},function(data) {alert("該會員已刪除");location.reload();}); 
}
})

$("img.unlock").live("click",function(){
$(this).parent().nextAll().children("input[type=text].edit").removeAttr("disabled")
});


$("#save").live("click",function(){
var stat = $(this).parent().nextAll();
var course_name = stat.eq(0).children("input[type=text].edit").val();

var course_start = stat.eq(2).children("input[type=text].edit").val();
var course_end = stat.eq(3).children("input[type=text].edit").val();
var course_info = stat.eq(4).children("input[type=text].edit").val();
if (confirm("更新此列資料?") ){
	$.post("php/update_course.php",{course_id:$(this).attr("name"),course_name:course_name,course_start:course_start,course_end:course_end,course_info:course_info},function(data) {
		alert('資料已更新完成');
		stat.find("input[type=text].edit").attr("disabled", true);
	});
}
})

$("input.date").live("mouseover",function(){
$(this).datepicker({dateFormat: 'yy-mm-dd'});
})



});

</script>
</body>
</html>
