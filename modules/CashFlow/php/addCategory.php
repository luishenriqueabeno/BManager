<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$categoryName = $_POST['categoryName'];
	$categoryTypeId = $_POST['categoryTypeId'];

	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);
	
	$sql = mysql_query("Select * From cashflowcategories Where userMaster = '$resMaster->userMaster' And categoryName = '$categoryName' And categoryTypeId = $categoryTypeId");

	$res = mysql_fetch_object($sql);

	$numRows = mysql_num_rows($sql);

	if($numRows >= 1){
		echo 2;
	} else {
		$insert = mysql_query("Insert Into cashflowcategories Values ('', '$categoryName', $categoryTypeId, '$resMaster->userMaster')");

		$updateList = mysql_query("Select * From cashflowcategories Where userMaster = '$resMaster->userMaster'");

		$rows = array();

		while($res = mysql_fetch_object($updateList)){
			$rows[] = $res;
		}

		echo json_encode($rows);
	}
?>