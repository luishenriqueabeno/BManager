<?php
	require('../../../php/conn.php');

	$taskId = $_POST['taskId'];
	
	$getTaskDataQuery = "Select * From tasks Where id = '$taskId'";

	$getTaskDataSql = mysql_query($getTaskDataQuery);

	$rows = array();

	while($resData = mysql_fetch_object($getTaskDataSql)){
		$rows[] = $resData;
	}

	echo json_encode($rows);
	
?>