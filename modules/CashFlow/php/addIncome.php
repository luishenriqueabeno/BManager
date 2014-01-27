<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$incomeName = $_POST['incomeName'];
	$incomeValue = $_POST['incomeValue'];
	$data = $_POST['data'];
	$category = $_POST['category'];

	if($category == ''){
		$category = 0;
	}

	$expenseInsert = mysql_query("Insert Into cashflowincome Values ('', '$incomeName', '$incomeValue', '$data', $category, $userId)");

	echo 1;

?>