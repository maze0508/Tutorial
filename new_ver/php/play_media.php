<?php
include_once("root.php");
//include_once("root2.php");
$user_media_id = mysql_escape_string($_POST['user_media_id']);
		
		if($user_media_id){
		$query = "SELECT title,url from user_media where user_media_id='$user_media_id'";
		$result = $mysqli->query($query);
		while($row = $result->fetch_array(MYSQL_ASSOC)){
			$url .= $row['url'];  	
			$title .= $row['title'];	
			$found .= strstr($url,"youtube");					
		}}
		echo"<div id='content'><div class='post'>
			<h2 class='title'>$title</h2>
			<div class='entry'>

				<object id='player' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' name='player' width='100%' height='350'>
					<param name='movie' value='player.swf' />
					<param name='allowfullscreen' value='true' />
					<param name='allowscriptaccess' value='always' />";
					
					if($title && $found)
					echo "<param name='flashvars' value='file=$url' />"; 
					else if($title)
					echo "<param name='flashvars' value='file=user_movie/$url.flv&image=user_pics/$url.jpg' />"; 			
					
				echo"<embed
						type='application/x-shockwave-flash'
						id='player2'
						name='player2'
						src='player.swf' 
						width='100%' 
						height='350'
						allowscriptaccess='always' 
						allowfullscreen='true'";
						
						if($title && $found)
						echo "flashvars='file=$url'";
						else if($title)	
						echo "flashvars='file=user_movie/$url.flv&image=user_pics/$url.jpg'";
					echo" />
				</object>
			</div>
		</div>";

		
?>