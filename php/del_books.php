<?php
include_once("root.php");
$edit_books_id = mysql_escape_string($_POST['edit_books_id']);
$query= "delete from edit_books where edit_books_id='$edit_books_id' ";
$result = $mysqli->query($query);
		

?>