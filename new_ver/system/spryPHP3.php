<?php session_start(); 
$mem_id = $_SESSION['member_id'];
$usermediaid = $_SESSION['user_media_id'];
?>


<?php
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
$tomeCollapsible = mysql_query($selectanchor);
?>
<html>
<head>
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel2.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script>
	function tonoteBlue(obj){
		obj.className="noteClassSelectBlue";
	}
	function tonoteW(obj){
		obj.className="noteClassSelect";
	}
</script>
<style type="text/css">
table.pad{
	background:#CCCCCC;
	letter-spacing:5;
}

td {
	font-family:verdana;
	color:#000000;
	text-align:center;
	background:#FFFFFF;

}
form{margin:0px;display: inline}

.Note{
	background-image: url(note.png);
	<!--background-color: #FF9;-->
	background-position:left;
	background-repeat: no-repeat;
	font-family:"·L³n¥¿¶ÂÅé";
	background-color: white;
	width:260px;
	height:250px;
	word-break:break-all;
	padding: 5px 2px 2px 20px;;
	table-layout: fixed; 
	word-wrap: break-word; 
	overflow: hidden;
	border-left: solid 1px white;
	border-right: solid 1px white;
	border-top: solid 1px white;
	border-bottom: solid 1px white;
	float: left;
	margin-left: 0.3cm;
	margin-top:0.2cm;
}

.mediaAchor{
	width:200px;
	
}

.noteClassSelectBlue{
	background-color:#BFEBFF;
}

.noteClassSelect{
	background-color:white;
}
</style>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
</head>

<body>
<div id="TabbedPanels1" class="TabbedPanels">
  <ol id="TabbedPanelsTabGroup" class="TabbedPanelsTabGroup">
  <li class="TabbedPanelsTab" tabindex="0">all</li>
<?php
	while($row = mysql_fetch_assoc($tofor1))
	{	
		$cname = $row['class_name'] ;
		$ccid = $row['id'] ;
		$cnoname = 'no'.$cname;

?>
<li class="TabbedPanelsTab" tabindex="0"><?=$cname ?>
<form name="<?=$cnoname?>" method="post" action="deleteClass.php">
	<table align="right">
		<tr >
			<td width="10"onclick="document.<?=$cnoname?>.submit();">x<input type="hidden" name="getdeleteClass" value="<?=$ccid?>"></input></td></td>
		</tr>
	</table>
</form>	
</li>
<?php } ?>

  </ol>
  <div id="TabbedPanelsContentGroup" class="TabbedPanelsContentGroup">
  <div class="TabbedPanelsContent">
		
	<div id="getclass">CLASS TEST</div>
		<?php
			while($row = mysql_fetch_assoc($tome1))
			{	
				$toforcount++;
				$memoid = $row['user_media_id'] ;
				$memoContent = $row['anchor_descript'] ;
				$anchorid = $row['media_anchor_id'];
				$memoclass = $row['class_name'] ;
				$toforced = '$tofor'.$toforcount;
				$toforced = mysql_query($toforclass);
				
				
		echo'
				<div class="Note" >
				<div id="CollapsiblePanel'.$anchorid.'" class="CollapsiblePanel">
					 <div class="CollapsiblePanelTab" tabindex="0">'.$memoclass.'</div>
					 <div class="CollapsiblePanelContent">';
					 while($row = mysql_fetch_assoc($toforced))
						{	
								$cid = $row['id'] ;
								$cname = $row['class_name'] ;
								$formClass='getclass'.$cname.$anchorid;
							
								echo '<form name="'.$formClass.'" method="post" action="updateMemoClass.php">
												<div class="noteClassSelect'.$cname.'" onmouseover="tonoteBlue(this);" 
																onmouseout="tonoteW(this);" 
																onclick="document.'.$formClass.'.submit();">'.$cname .'
														<input type="hidden" name="getclassID" value="'.$cname.'"></input>
														<input type="hidden" name="meid" value="'.$anchorid.'"></input>
														<input type="hidden" name="memberid" value="'.$_SESSION['member_id'].'"></input>
												</div>
										</form>';
					  } 	
						
					  echo'</div>
					</div><div class=mediaAchor>'
					.$memoContent .'
				</div></div>';
		} ?>
	</div>
		
		
		  
	<?php
	while($row = mysql_fetch_assoc($tofor2))
	{	
		$cname2 = $row['class_name'] ;
		$findme = "SELECT * FROM  `media_anchor` WHERE  `member_id` = '$mem_id' AND `class_name` LIKE  '$cname2' ";
		$toclassFind = mysql_query($findme);
		
	?>
	
	
	
	  <div class="TabbedPanelsContent">

	<?php
			while($row = mysql_fetch_assoc($toclassFind))
			{	
				$toforcount++;
				$memoid = $row['user_media_id'] ;
				$memoclass = $row['class_name'] ;
				$anchorid = $row['media_anchor_id'];
				$toforced = '$tofor'.$toforcount;
				$toforced = mysql_query($toforclass);
				$memoContent = $row['anchor_descript'] ;
				
			echo'
				<div class="Note" >
				<div id="CollapsiblePanel'.$memoclass.$anchorid.'" class="CollapsiblePanel">
					 <div class="CollapsiblePanelTab" tabindex="0">'.$memoclass.'</div>
					 <div class="CollapsiblePanelContent">';
					 while($row = mysql_fetch_assoc($toforced))
						{	
								$cid = $row['id'] ;
								$cname = $row['class_name'] ;
								$formClass='getclass'.$cname2.$cname.$anchorid;
							
								echo '<form name="'.$formClass.'" method="post" action="updateMemoClass.php">
												<div class="noteClassSelect'.$cname.'" onmouseover="tonoteBlue(this);" 
																onmouseout="tonoteW(this);" 
																onclick="document.'.$formClass.'.submit();">'.$cname .'
														<input type="hidden" name="getclassID" value="'.$cname.'"></input>
														<input type="hidden" name="meid" value="'.$anchorid.'"></input>
														<input type="hidden" name="memberid" value="'.$_SESSION['member_id'].'"></input>
												</div>
										</form>';
					  } 						
					  echo'</div>
					</div><div class=mediaAchor>'
					.$memoContent .'
				</div></div>';
		
		
		
		
} ?>

	</div>	
<?php }?>
</div>
</div>

<form name="f1" action="addClass.php" method="POST">
<input id="getname" name="getname" type="text" id="textfield" size="15" />

<input type="hidden" name="userid" value="<?php echo $_SESSION['member_id'];?>" size="15" ></input>
<input type="hidden" name="usermediaid" value="<?php echo $_SESSION['user_media_id'];?>" size="15" ></input>

<input type="submit" value="add"></input>
</form>
<script language="javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
<?php
	while($row = mysql_fetch_assoc($tomeCollapsible))
	{	
		$cname = $row['class_name'] ;
		$anchorid = $row['media_anchor_id'] ;
		echo 'var CollapsiblePanel'.$anchorid.'= new Spry.Widget.CollapsiblePanel("CollapsiblePanel'.$anchorid.'", {contentIsOpen:false});';
		echo 'var CollapsiblePanel'.$cname.$anchorid.'= new Spry.Widget.CollapsiblePanel("CollapsiblePanel'.$cname.$anchorid.'", {contentIsOpen:false});';
		
	}
?>

</script>
</br>
</body>
</html>