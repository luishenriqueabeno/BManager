<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	
	$convertPass = mysql_query("Select password as pass From users Where id = $userId");
	$res = mysql_fetch_object($convertPass);

	$getUserDataQuery = "Select * From users Where id = '$userId'";

	$getUserDataSql = mysql_query($getUserDataQuery);

	$rows = array();

	while($resData = mysql_fetch_object($getUserDataSql)){
		$rows[] = $resData;
	}

	echo json_encode($rows);
	
?>