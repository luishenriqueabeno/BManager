<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];

	$list = mysql_query("Select * From cashflowincome Where userId = $userId");

	$rows = array();

	while($res = mysql_fetch_object($list)){
		$rows[] = $res;
	}

	echo json_encode($rows);

?>