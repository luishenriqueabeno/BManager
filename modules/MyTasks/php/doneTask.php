<?php
	require('../../../php/conn.php');

	$tasks = $_POST['tasks'];

	$arr = implode(",", $tasks);

	$query = "Update tasks Set taskStatus = 1 Where id in ($arr)";

	$sql = mysql_query($query);

	echo 1;

?>