<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];

	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	$list = mysql_query("Select * From cashflowcategories Where userMaster = '$resMaster->userMaster'");

	$rows = array();

	while($res = mysql_fetch_object($list)){
		$rows[] = $res;
	}

	echo json_encode($rows);

?>