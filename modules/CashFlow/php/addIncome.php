<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$incomeName = $_POST['incomeName'];
	$category = $_POST['category'];
	$ano = $_POST['ano'];

	if($category == ''){
		$category = 0;
	}

	$expenseInsert = mysql_query("Insert Into cashflowincome Values ('', '$incomeName', $category, $userId, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$ano')");

	echo 1;

?>