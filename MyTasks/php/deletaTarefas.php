<?php
	require('conn.php');

	$tasks = $_POST['tasks'];

	$arr = implode(",", $tasks);
	
	$query = "Delete From tasks Where id in ($arr)";

	$sql = mysql_query($query);

?>