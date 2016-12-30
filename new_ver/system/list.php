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

	$tolistmemo  = "select * from memo";
	//$toListMemo = "select * from memo order by anchor_list";
	$selectanchor = "SELECT * FROM media_anchor where  member_id =  '$mem_id' AND user_media_id = '$usermediaid' order by anchor_list";
	$tolist1 = mysql_query($selectanchor);
  ?>

<html lang="en" class="no-js">
<head>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  

  <script>
  var getListArr = new Array();
  var getListIdArr = new Array();
  var getListSortArr = new Array();
  <?php
  $i=0;
  while($row = mysql_fetch_assoc($tolist1))
	{	
		$listContent = $row['content'] ;
		$listId = $row['id'] ;
		echo "getListArr[".$i."]='".$listContent."';";
		echo "getListIdArr[".$i."]='".$listId."';";
		$i++;
	}
  ?>
  
	
	
 // alert(getListArr[1]);
  
  $(document).ready(function() {
    $("#sortable").sortable();
	for ( var i = 0; i < getListArr.length; i++) {
	var O1 = document.getElementById('sortable');
          //O1.appendChild(document.createHTMLNode('<li>'+getListArr[i]+'</li>'));
		  var btn=document.createElement("LI");
		  O1.appendChild(btn);
		  var t=document.createTextNode(getListArr[i]);
		  btn.appendChild(t);
     }
  });
   
    var sorting="o";
    var result = $('#sortable').sortable('toArray');
	for ( var i = 0; i < result.length; i++) {
		for ( var j = 0; j < getListArr.length; j++) {
			if(result[i]==getListArr[j]){
				getListSortArr[i]=getListIdArr[j]
				sorting+=getListSortArr[i]+",";
			}
		}
	}
	//alert(sorting);
	
  </script>
<meta charset="utf-8">
<style>
	header{
	font-family:verdana;

	}
	form#payment {
		font-family:微軟正黑體;
		background: #FFF;
		}		
	div {
		background: #AAE3FF;	
		border-color: #AAE3FF;
		<!--border-style: solid;-->
		border-width: 2px;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		-khtml-border-radius: 10px
		border-radius: 10px;
		line-height: 30px;
		list-style: none;
		padding: 5px 10px;
		margin-bottom: 2px;
	}			

</style>
</head>
<body class="home">

<header id="hd1" align="center">HTML5 TEST</header>

<form id=organizeList>
<fieldset>
<legend>列表</legend>
<ul id="sortable">
</ul>
</fieldset>
</form>
</body>
</html>