<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$expenseName = $_POST['expenseName'];
	$expenseValue = $_POST['expenseValue'];
	$category = $_POST['category'];
	$ano = $_POST['ano'];

	$value = str_replace(',', '.', $expenseValue);

	if($category == ''){
		$category = 0;
	}

	$expenseInsert = mysql_query("Insert Into cashflowexpenses Values ('', '$expenseName', $category, $userId, '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$ano')");

	if($expenseInsert){
		echo 1;	
	} else {
		echo 2;
	}
	
?>