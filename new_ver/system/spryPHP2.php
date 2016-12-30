<?php session_start(); 
$mem_id = $_SESSION['member_id'];
$usermediaid = $_SESSION['user_media_id'];
?>

<?php
//$mem = $_SESSION['member_id']

//$addClassName= $_REQUEST["getname"]; //$_REQUEST 取得表單資料
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'CSCE521';
$dbname = 'wba2012';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_query("SET NAMES utf8");

mysql_select_db($dbname);
 
$toforclass  = "SELECT * FROM anchor_class where user_id = '$mem_id' AND user_media_id = '$usermediaid'";
$tomemo  = "SELECT * FROM media_anchor";

$selectanchor = "SELECT * FROM media_anchor where  member_id =  '$mem_id' AND user_media_id = '$usermediaid'";

$toforcount = 2;
$tomecount = 2;
$tofor1 = mysql_query($toforclass);
$tofor2 = mysql_query($toforclass);
$toforc = mysql_query($toforclass);

$tome1 = mysql_query($selectanchor);

?>
<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<script language="javascript">

 function tochange(obj){
 var objid = obj.id;
	var O1value = obj.className;
	var O1= document.getElementById(O1value);
	O1.innerHTML= objid;
}

 function toaddclass(name){
	//var newClassName = document.getElementById('getname').value;
	
	/*var FatherClass = document.getElementById('TabbedPanelsTabGroup');
	var addFatherClass = document.createElement('li');	
	addFatherClass.innerText = name;
	addFatherClass.className='TabbedPanelsTab';
	FatherClass.appendChild(addFatherClass);*/
	
	var SonClass = document.getElementById('TabbedPanelsContentGroup');
	var addSonClass = document.createElement('div');
	addSonClass.innerText = '1';
	addSonClass.className='TabbedPanelsContent';
	SonClass.appendChild(addSonClass);
	
 var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
}
</script>

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style type="text/css">
table {
	background:#CCCCCC;
	letter-spacing:5;
}

td {
	font-family:verdana;
	color:#000000;
	text-align:center;
	background:#FFFFFF;
	width:100;
}
form{margin:0px;display: inline}
</style>
</head>


<body>
<!--列出所有類別欄位>
<![end]-->
<div id="TabbedPanels1" class="TabbedPanels">
  <ol id="TabbedPanelsTabGroup" class="TabbedPanelsTabGroup">
  <li class="TabbedPanelsTab" tabindex="0">All</li>
  
  <?php
	while($row = mysql_fetch_assoc($tofor1))
	{	
		
		$cname = $row['class_name'] ;
		
   ?>
		<li class="TabbedPanelsTab" tabindex="0"><?=$cname ?></li>
	<?php
	} 
	?>
  </ol>
  
 <!--列出所有表格資料>

<![end]-->
  <div id="TabbedPanelsContentGroup" class="TabbedPanelsContentGroup">
  <div class="TabbedPanelsContent">
	<div id="getclass">Member_ID: <?php echo $_SESSION['member_id'];?></div>
	
		<?php
			while($row = mysql_fetch_assoc($tome1))
			{	
				$toforcount++;
				$memoid = $row['user_media_id'] ;
				$memonoid = $row['anchor_descript'] ;
				$memoclass = $row['class_name'] ;
				
				$anchorid = $row['media_anchor_id'];
				
				$toforced = '$tofor'.$toforcount;
				$toforced = mysql_query($toforclass);
		
		?>
		
		<table width="400">
			<tr>
				<td>user_media_id</td>
				<td>anchor_descript</td>
				<td>class</td>
				<td>chioce</td>
			</tr>
			<tr>
				<td><?=$memoid ?></td>
				<td><?=$memonoid?></td>
				<td><?=$memoclass ?></td>
				<td align="center">
				<form id="form1" name="form1" method="post" action="updateMemoClass.php">
				    <select name="getclassID" id="select">
						 <?php
							while($row = mysql_fetch_assoc($toforced))
							{	
								$cid = $row['id'] ;
								$cname = $row['class_name'] ;
							?>
					 <option value="<?=$cname ?>"><?=$cname ?></option>
					 <?php } ?>
			        </select>
					<input type="submit" value="change"></input>
					<input type="hidden" name="meid" value="<?=$anchorid?>"></input>
					<input type="hidden" name="memberid" value="<?php echo $_SESSION['member_id'];?>"></input>
			    </form>
				</td>
			</tr>

		</table><br/>
		<?php 
		}
		?>
		</div>
		
	<!--按下類別跑出相對應>
		<![endif]-->
	<?php
	while($row = mysql_fetch_assoc($tofor2))
	{	
		$cname2 = $row['class_name'] ;
		$findme = "SELECT * FROM  `media_anchor` WHERE  `member_id` = '$mem_id' AND `class_name` LIKE  '$cname2' ";
		$toclassFind = mysql_query($findme);
	?>
	
		
	  <div class="TabbedPanelsContent">
	  <div id="getclass"><?php echo $_SESSION['member_id'];?></div>
	<?php
			while($row = mysql_fetch_assoc($toclassFind))
			{	
				$toforcount++;
				$memoid = $row['user_media_id'] ;
				$memonoid = $row['anchor_descript'] ;
				$memoclass = $row['class_name'] ;
				
				$anchorid = $row['media_anchor_id'];
				
				$toforced = '$tofor'.$toforcount;
				$toforced = mysql_query($toforclass);
				
		?>
		<table width="400">
			<tr>
				<td>user_media_id</td>
				<td>anchor_descript</td>
				<td>class</td>
				<td>chioce</td>
			</tr>
			<tr>
				<td><?=$memoid ?></td>
				<td><?=$memonoid ?></td>
				<td><?=$memoclass ?></td>
				<td align="center">
				<form id="form1" name="form1" method="post" action="updateMemoClass.php">
				    <select name="getclassID" id="select">
						 <?php
							while($row = mysql_fetch_assoc($toforced))
							{	
								$cid = $row['id'] ;
								$cname = $row['class_name'] ;
							?>
					 <option value="<?=$cname ?>"><?=$cname ?></option>
					 <?php } ?>
			        </select>
					<input type="submit" value="change"></input>
					<input type="hidden" name="meid" value="<?=$anchorid ?>"></input>
					<input type="hidden" name="memberid" value="<?php echo $_SESSION['member_id'];?>"></input>
			    </form>
				</td>
			</tr>

		</table><br/><?php } ?> 
</div>
	<?php }?>
	
  </div>
</div>


<form name="f1" action="addClass.php" method="post">
<input id="getname" name="getname" type="text" id="textfield" size="15" ></input>

<input type="hidden" name="userid" value="<?php echo $_SESSION['member_id'];?>" size="15" ></input>
<input type="hidden" name="usermediaid" value="<?php echo $_SESSION['user_media_id'];?>" size="15" ></input>

<input type="submit" value="add"></input>
</form>
<script language="javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</br>
</body>
</html>