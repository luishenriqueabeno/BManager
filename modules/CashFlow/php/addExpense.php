<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$expenseName = $_POST['expenseName'];
	$category = $_POST['category'];
	$ano = $_POST['ano'];

	if($category == ''){
		$category = 0;
	}

	$expenseInsert = mysql_query("Insert Into cashflowexpenses Values ('', '$expenseName', $category, $userId, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$ano')");

	echo 1;

?>