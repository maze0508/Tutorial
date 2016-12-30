<?php
	echo 
	"<ul id='logo1'>
		<li class='first'><a href='index.php' accesskey='1' title=''><img title='回首頁' src='images/logo1.png'/></a></li>
	</ul>
	<ul id='menu2'>
		<li><a href='sign.php' accesskey='2' title='個人書房'><img id='Personal' class='logo2' src='images/Personal1.png'/></a></li>
		<li><a href='#' accesskey='2' title=''><img id='stu-video' class='logo2' src='images/stu-video1.png'/></a>
			<ul>
				<li class='Banner' ><a href='start_learning_0_2.php'>我的學習主題</a></li>
				<li class='Banner' ><a href='start_learning_0_3.php'>我的收藏</a></li>
			</ul>
		</li>
		<li><a href='start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id' accesskey='3' title=''><img id='stu-note' class='logo2' src='images/stu-note1.png'/></a>
			<ul>
				<li class='Banner' ><a href='start_learning_1.php?user_media_id=$user_media_id&team_id=$team_id'>文字註記</a></li>
				<li class='Banner' ><a href='start_learning_1_2.php?user_media_id=$user_media_id&team_id=$team_id'>圖片註記</a></li>
			</ul>
		</li>
		<li><a href='start_learning_class.php?user_media_id=$user_media_id&team_id=$team_id' accesskey='4' title=''><img id='stu-cf' class='logo2' src='images/stu-cf1.png'/></a>
			<ul>
				<li class='Banner' ><a href='start_learning_class.php?user_media_id=$user_media_id&team_id=$team_id'>文字分類</a></li>
				<li class='Banner' ><a href='start_learning_class_2.php?user_media_id=$user_media_id&team_id=$team_id'>圖片分類</a></li>
			</ul>
		</li>
		<li><a href='start_learning_arrange.php' accesskey='5' title=''><img id='stu-Integration' class='logo2' src='images/stu-Integration1.png'/></a></li>
		<li><a href='learning_books_list.php' accesskey='6' title=''><img id='stu-nbook' class='logo2' src='images/stu-nbook1.png'/></a></li>
		
	</ul>";
?>