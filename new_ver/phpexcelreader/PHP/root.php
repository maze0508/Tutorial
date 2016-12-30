<?php
$mysqli = new mysqli("localhost","root","7355","daiyi");
$mysqli->query("set character_set_client = utf8");           // D1
$mysqli->query("set character_set_results = utf8");         // D2
$mysqli->query("set character_set_connection = utf8");      // D3
?>