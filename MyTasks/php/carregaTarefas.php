<?php
	require('conn.php');
	
	$query = "Select * From tasks";

	$sql = mysql_query($query);

	$rows = array();

	while($res = mysql_fetch_object($sql)){
		$rows[] = $res;
	}

	echo json_encode($rows);