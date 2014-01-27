<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$expenseName = $_POST['expenseName'];
	$expenseValue = $_POST['expenseValue'];
	$data = $_POST['data'];
	$category = $_POST['category'];

	$expenseInsert = mysql_query("Insert Into cashflowexpenses Values ('', '$expenseName', '$expenseValue', '$data', $category, $userId)");
	echo 1;

?>