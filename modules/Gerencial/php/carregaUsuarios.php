<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];

	$getMaster = mysql_query ("Select userMaster from users Where id = '$userId'");

	$resMaster = mysql_fetch_object($getMaster);

	$getUsersDown = mysql_query("Select * From users Where userMaster = '$resMaster->userMaster'");

	$rows = array();

	while($res = mysql_fetch_object($getUsersDown)){
		$rows[] = $res;
	}

	echo json_encode($rows);

?>