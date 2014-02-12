<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	
	$sql = mysql_query("Select * From tasks Where userId = $userId Order By dataInicio");

	$rows = array();

	while($res = mysql_fetch_object($sql)){
		$rows[] = $res;
	}

	echo json_encode($rows);
?>