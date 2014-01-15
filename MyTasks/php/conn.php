<?php
	$user = "root";
	$pass = "";
	$host = "localhost";
	$db = "mytasks";

	$conn = mysql_connect($host, $user, $pass) or die(mysql_error());
	$db = mysql_select_db($db) or die (mysql_error());
?>