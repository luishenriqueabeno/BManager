<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];
	$incomeName = $_POST['incomeName'];
	$incomeValue = $_POST['incomeValue'];
	$category = $_POST['category'];
	$ano = $_POST['ano'];

	$value = str_replace(',','.',str_replace('.','',$incomeValue));

	if($category == ''){
		$category = 0;
	}

	$incomeInsert = mysql_query("Insert Into cashflowincome Values ('', '$incomeName', $category, $userId, '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$ano')");

	if($incomeInsert){
		echo 1;	
	} else {
		echo 2;
	}

?>