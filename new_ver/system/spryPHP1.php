<?php 
session_start(); 
$mem_id = $_SESSION['member_id'];
$usermediaid = $_SESSION['user_media_id'];
$team_id = $_SESSION['team_id'];
if(!$_SESSION['account'])
echo "<script>document.location.href='index.php'</script>";
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

$tomatch = mysql_query($toforclass);
$toSaveAllMemo = mysql_query($selectanchor);

$tofor1 = mysql_query($toforclass);
$tofor2 = mysql_query($toforclass);
$toforc = mysql_query($toforclass);
$tome1 = mysql_query($selectanchor);
$tomeCollapsible = mysql_query($selectanchor);
$toAddNote = mysql_query($toforclass);



?>
<html>
<head>
<script src="SpryAssets/SpryCollapsiblePanel.js" type="text/javascript"></script>
<link href="SpryAssets/SpryCollapsiblePanel2.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/dialog.css" rel="stylesheet" type="text/css"/>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<script>
  $(document).ready(function() {	
  $( "#dialog" ).dialog({ 
		position:[0, 0] , 
		width: 210,
		height: 125,	
		modal: false,
		draggable: false,
		resizable: false,
		autoOpen: false,
	});   
  //取得滑鼠位置
      var mousex;
	  var mousey;
	  var classname;
	  var classid;
	  
	  $('.edit').click(function(e){
		classid= $(this).attr('value1');
		classname= $(this).attr('value2');
		mousey=e.pageY;
		mousex=e.pageX;
		
		$("#outputClass").text(classname);
		$(".SaveClassId").attr('value',classid);
		
		if (!$("#dialog").dialog("isOpen")) {
				$("#dialog").dialog("open");
			}
		$( "#dialog" ).dialog({ 
		position:[mousex+10, mousey-15] , 
		width: 210,
		height: 125,	
		modal: false,
		draggable: false,
		resizable: false,
		autoOpen: false,
	});   
		});

	
	//按x關閉Dialog
	$(".btn").click(function() {
		$("#dialog").dialog("close");
	});
  });

  
	function tonoteBlue(obj){
		obj.className="noteClassSelectBlue";
	}
	function tonoteW(obj){
		obj.className="noteClassSelect";
	}
	function changeClass(obj){
		var NewNoteClassId=obj.getAttribute("value");
		var storeClass=obj.innerText;
		document.getElementById('AddColl').innerText=storeClass;
		//NewNoteClassId= $(this).attr('value');
		$("#newNoteClass").attr('value',NewNoteClassId);
	}
	
	function deleteclass(){
		var reply = confirm('若刪除類別，類別內的註記將改為未分類，請問是否確定刪除？') ; 
		if(reply){
			document.deleteClass.submit();
		}
	
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
	background-image: url(noteS.png);
	background-position:left;
	background-repeat: no-repeat;
	font-family:"微軟正黑體";
	background-color: white;
	width:170px;
	height:175px;
	padding: 0px 2px 2px 17px;
	table-layout: fixed; 
	word-wrap: break-word; 
	overflow: hidden;
	border-left: solid 1px white;
	border-right: solid 1px white;
	border-top: solid 1px white;
	border-bottom: solid 1px white;
	float: left;
	margin-left: 0.15cm;
	margin-top:0.2cm;
}
.NoteB{
	background-image: url(note2S.png);
	<!--background-color: #FF9;-->
	background-position:left;
	background-repeat: no-repeat;
	font-family:"微軟正黑體";
	background-color: white;
	width:170px;
	height:175px;
	word-break:break-all;
	padding: 0px 2px 2px 17px;
	table-layout: fixed; 
	word-wrap: break-word; 
	overflow: hidden;
	border-left: solid 1px white;
	border-right: solid 1px white;
	border-top: solid 1px white;
	border-bottom: solid 1px white;
	float: left;
	margin-left: 0.15cm;
	margin-top:0.2cm;
}

.NoteAdd{
	background-image: url(note2S.png);

	background-position:left;
	background-repeat: no-repeat;
	font-family:"微軟正黑體";
	background-color: white;
	width:170px;
	height:175px;
	word-break:break-all;
	padding: 0px 2px 2px 17px;
	table-layout: fixed; 
	word-wrap: break-word; 
	overflow: hidden;
	border-left: solid 1px white;
	border-right: solid 1px white;
	border-top: solid 1px white;
	border-bottom: solid 1px white;
	float: left;
	margin-left: 0.15cm;
	margin-top:0.2cm;
}


.mediaAchor{
	width:150px;
	
}

.noteClassSelectBlue{
	background-color:#BFEBFF;
}

.noteClassSelect{
	background-color:white;
}
</style>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8">
<?php
$SaveClassNamearr=array();
$SaveCIDarr=array();
while($row = mysql_fetch_assoc($tomatch))
{	
	$findedClass = $row['class_name'] ;
	$findedCID = $row['id'] ;
	array_push($SaveClassNamearr,$findedClass);
	array_push($SaveCIDarr,$findedCID);
}


$SaveMIDarr=array();
$SaveClass_Idarr=array();
$SaveContentarr=array();
$SavenoteColorarr=array();
while($row = mysql_fetch_assoc($toSaveAllMemo))
{
	$SaveMID = $row['media_anchor_id'] ;
	$SaveClass_id = $row['class_name'] ;
	$SaveContent = $row['anchor_descript'] ;
	$SavenoteColor = $row['noteColor'] ;
	array_push($SaveMIDarr,$SaveMID);
	array_push($SaveClass_Idarr,$SaveClass_id);
	array_push($SaveContentarr,$SaveContent);
	array_push($SavenoteColorarr,$SavenoteColor);
}
?>
</head>
<body>
<div id="logo">
	<h1><a href="#">Video Learning</a></h1>
	<h2>歡迎光臨_<span id="ald"><?php echo $_SESSION['account'];?></span>
	<?php
	if($_SESSION['account'])
	echo '<a id="logout" href="php/logout.php">，登出</a>';
	?>	
	</h2>
</div>
<div id="page">
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
		<img class="edit" src="change.png" align="right" value1="<?=$ccid?>" value2="<?=$cname?>"/>
	</li>
<?php } ?>

  </ol>
  <div id="TabbedPanelsContentGroup" class="TabbedPanelsContentGroup">
  <div class="TabbedPanelsContent">
		
	<div id="getclass"></div>
		<?php
			while($row = mysql_fetch_assoc($tome1))
			{	
				$toforcount++;
				$memoid = $row['user_media_id'] ;
				$memoContent = $row['anchor_descript'] ;
				$anchorid = $row['media_anchor_id'];
				$memoclass = $row['class_name'] ;
				$memberid = $row['member_id'] ;
				$toforced = '$tofor'.$toforcount;
				$toforced = mysql_query($toforclass);
				$noteColor = $row['noteColor'] ;
				$SaveClassName;		
				$NullCount=0;
				for($k=0;$k<sizeof($SaveCIDarr);$k++){
					if($memoclass==$SaveCIDarr[$k]){
						$SaveClassName=$SaveClassNamearr[$k];
					}
					if($memoclass==''){
						$SaveClassName="未分類";
						}
				}
		
					if($noteColor==0){
						echo '<div class="Note" >';
					}else{
						echo '<div class="NoteB" >';
					}
				echo'<div id="CollapsiblePanel'.$anchorid.'" class="CollapsiblePanel">
					 <div class="CollapsiblePanelTab" tabindex="0">'.$SaveClassName.'</div>
					 <div class="CollapsiblePanelContent">';
						
					$formClass1=array();				
					for($i=0;$i<sizeof($SaveCIDarr);$i++){
							$formClass2='getclass'.$SaveClassNamearr[$i].$anchorid;
							array_push($formClass1,$formClass2);
								echo '<form name="'.$formClass1[$i].'" method="post" action="updateMemoClass.php">
												<div class="noteClassSelect'.$SaveClassNamearr[$i].'" onmouseover="tonoteBlue(this);" 
																onmouseout="tonoteW(this);" 
																onclick="document.'.$formClass1[$i].'.submit();">'.$SaveClassNamearr[$i] .'
														<input type="hidden" name="getclassID" value="'.$SaveCIDarr[$i].'"></input>
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

		<div class="NoteAdd" >
			<div id="CollapsiblePanel" class="CollapsiblePanel">
				<div id="AddColl" class="CollapsiblePanelTab" tabindex="0">--請選擇類別--</div>
				<div id="noteClassSel" class="CollapsiblePanelContent">
					<?php 
						while($row = mysql_fetch_assoc($toAddNote))
						{	
							$cid = $row['id'] ;
							$cname = $row['class_name'] ;
							echo'
									<div class="noteClassSelect'.$cname.'" onmouseover="tonoteBlue(this);" 
										onmouseout="tonoteW(this);" 
										onclick="changeClass(this);" value="'.$cid.'">'.$cname .'
										<input type="hidden" name="getclassID" value="'.$cid.'"></input>
									</div>';
							}
						?>
				</div>
			</div>
				<form name="AddNote" method="post" action="AddNewNote.php">
			<input id="newNoteClass" name="NewNoteClass"type="hidden"/>
			<input type="hidden" name="memberId" value="<?php echo $_SESSION['member_id'];?>" ></input>
			<input type="hidden" name="usermediaid" value="<?php echo $_SESSION['user_media_id'];?>"></input>
				<label>
					<textarea name="textarea" style="background:transparent; border-style:none;overflow:hidden;" id="textarea" cols="15" rows="7"></textarea>
				</label>
		<div style="padding-left:75px; font-size:20px;cursor: pointer;" onclick="document.AddNote.submit();">✔</div>
				<form>
		</div>
	</div>

		
		  
	<?php
	while($row = mysql_fetch_assoc($tofor2))
	{	
		$cname2 = $row['id'] ;
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
				$noteColor = $row['noteColor'] ;
				$findclassName="SELECT * FROM  `anchor_class` WHERE  `id` LIKE  '$memoclass' LIMIT 0 , 30";
				$findClass = mysql_query($findclassName);
				while($row = mysql_fetch_assoc($findClass))
				{	
					$findedClass = $row['class_name'] ;
				
				if($noteColor==0){
					echo '<div class="Note" >';
				}else{
					echo '<div class="NoteB" >';
				}
				echo'<div id="CollapsiblePanel'.$findedClass.$anchorid.'" class="CollapsiblePanel">
					 <div class="CollapsiblePanelTab" tabindex="0">'.$findedClass.'</div>
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
														<input type="hidden" name="getclassID" value="'.$cid.'"></input>
														<input type="hidden" name="meid" value="'.$anchorid.'"></input>
														<input type="hidden" name="memberid" value="'.$_SESSION['member_id'].'"></input>
												</div>
										</form>';
					  } 						
					  echo'</div>
					</div><div class=mediaAchor>'
					.$memoContent .'
				</div></div>';
		
			}
		} ?>

	</div>	
<?php }?>
</div>
</div>

<form name="f1" action="addClass.php" method="POST">
<input id="getname" name="getname" type="text" id="textfield" size="9" />

<input type="hidden" name="userid" value="<?php echo $_SESSION['member_id'];?>" size="15" ></input>
<input type="hidden" name="usermediaid" value="<?php echo $_SESSION['user_media_id'];?>" size="15" ></input>

<input type="submit" value="add"></input>
</form>
<script language="javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var CollapsiblePanel= new Spry.Widget.CollapsiblePanel("CollapsiblePanel", {contentIsOpen:false});

<?php
		$CollNullCount;
		for($k=0;$k<sizeof($SaveMIDarr);$k++){
			$CollMID=$SaveMIDarr[$k];
			$CollCID=$SaveClass_Idarr[$k];
			for($j=0;$j<sizeof($SaveCIDarr);$j++){
				if($CollCID==$SaveCIDarr[$j]){
					$CollClassName=$SaveClassNamearr[$j];
					echo 'var CollapsiblePanel'.$CollClassName.$CollMID.'= new Spry.Widget.CollapsiblePanel("CollapsiblePanel'.$CollClassName.$CollMID.'", {contentIsOpen:false});';
				}
				echo 'var CollapsiblePanel'.$CollMID.'= new Spry.Widget.CollapsiblePanel("CollapsiblePanel'.$CollMID.'", {contentIsOpen:false});';
			}
		}
?>
</script>
</br>
<div id="dialog" class="dialogC" title="Class Editer">
	<div style="font-size:14px;white-space:nowrap;">
		<div style="display: inline;color: #666;font-size:15px">編輯｜</div>
		<form name="deleteClass" method="post" action="deleteClass.php">
			<div style="display: inline; cursor: pointer;color: #69C;"onclick="deleteclass();">刪除此類別 </div>
			<input class="SaveClassId"  name="saveClassId" type="hidden" />
		</form>
		<div style="display: inline;">　　</div>
		<div class="btn" style="display: inline; cursor: pointer; zoom:1.5;">×</div>
	</div>
	<div style="font-size:14px;white-space:nowrap;">
	<div style="display: inline;">目前類別名稱｜</div>
	<form name="updateClass" method="post" action="updateClass.php">
		<div id="outputClass" style="display: inline;"></div>
		<input class="SaveClassId"  name="saveClassId" type="hidden" />
		</div>	

		修改為 <input name="NewClassName" type="text" size="12"></input>
		
		　　　　<input type="submit" value="確定修改"/>
	</form>
</div>
<div style="float:right;">
<a style='text-decoration: none;' href='start_learning_1.php?user_media_id=<?=$usermediaid?>&team_id=<?=$team_id?>'></br><img src="images/right128.png" />回影片註記</a>
</div>
</div>
<div id="footer">
	
	<p class="legal">靜宜大學</p>
	<p class="credit">Wang, Dai-Yi </p>
</div>
</body>
</html>