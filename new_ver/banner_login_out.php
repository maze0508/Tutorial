<?php

echo"<div id='login'>";
	if($_SESSION['account']){
		//登出按鈕
		//echo "<div id='welcome'>歡迎光臨_<span id='ald'>".$_SESSION['user_name']."</span></div>";
		
		echo"
		<h2>歡迎光臨_<span id='ald'>".$_SESSION['user_name']."</span><br>
		<a id='logout' href='php/logout.php'><img src='images/logout.png'></a></h2>";
		
	}else{
		echo "<h2><a id='login' class='colorbox'><img src='images/login.png' ></a></h2>";
	}
	echo "</div>";
?>