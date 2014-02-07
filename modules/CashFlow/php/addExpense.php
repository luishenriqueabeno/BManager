<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$expenseName = $_POST['expenseName'];
	$expenseValue = $_POST['expenseValue'];
	$category = $_POST['category'];
	$ano = $_POST['ano'];

	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	$value = str_replace(',','.',str_replace('.','',$expenseValue));

	if($category == ''){
		$category = 0;
	}

	$expenseInsert = mysql_query("Insert Into cashflowexpenses Values ('', '$expenseName', $category, $userId, '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$ano', '$resMaster->userMaster')");

	if($expenseInsert){
		echo 1;	
	} else {
		echo 2;
	}
	
?>