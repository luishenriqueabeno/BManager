<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$categoryName = $_POST['categoryName'];
	$categoryTypeId = $_POST['categoryTypeId'];
	
	$sql = mysql_query("Select * From cashflowcategories Where userId = $userId And categoryName = '$categoryName' And categoryTypeId = $categoryTypeId");

	$res = mysql_fetch_object($sql);

	$numRows = mysql_num_rows($sql);

	if($numRows >= 1){
		echo 2;
	} else {
		$insert = mysql_query("Insert Into cashflowcategories Values ('', '$categoryName', $categoryTypeId, $userId)");

		$updateList = mysql_query("Select * From cashflowcategories Where userId = $userId");

		$rows = array();

		while($res = mysql_fetch_object($updateList)){
			$rows[] = $res;
		}

		echo json_encode($rows);
	}
?>