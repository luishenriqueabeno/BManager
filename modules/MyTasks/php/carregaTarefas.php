<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	
	$query = "Select * From tasks Where userId = $userId Order By taskGroupId";

	$sql = mysql_query($query);

	$rows = array();

	while($res = mysql_fetch_object($sql)){
		$rows[] = $res;
	}

	echo json_encode($rows);