<?php
	require('../../../php/conn.php');

	$categories = $_POST['categories'];	
	$userId = $_POST['userId'];

	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	$id = array();
	$type = array();

	$i = 0;

	foreach($categories as $value){
		$id[$i] = substr($value, 9, +3);
		$i++;
	}

	$finalIdArr = implode(",",$id);
	
	$deleteCategory = mysql_query("Delete From `cashflowcategories` Where id In ($finalIdArr) And userMaster = '$resMaster->userMaster'");

	$checkForExpenses = mysql_query("Select * From cashflowexpenses Where categoryId In ($finalIdArr)");
	$rowsExpenses = mysql_num_rows($checkForExpenses);

	$checkForIncomes = mysql_query("Select * From cashflowincome Where categoryId In ($finalIdArr)");
	$rowsIncomes = mysql_num_rows($checkForIncomes);

	if($rowsExpenses > 0){
		$deleteExpensesCategory = mysql_query("Delete From cashflowexpenses Where categoryId In ($finalIdArr) ");
	}

	if($rowsIncomes > 0){
		$deleteIncomesCategory = mysql_query("Delete From cashflowincome Where categoryId In ($finalIdArr) ");
	}

?>