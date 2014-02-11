<?php
	require('../../../php/conn.php');

	$incomes = $_POST['incomes'];	

	$arr = array();
	$i = 0;

	foreach($incomes as $value){
		$arr[$i] = substr($value, -1);
		$i++;
	}

	$finalArr = implode(",",$arr);
	
	$query = "Delete From `cashflowincome` Where id in ($finalArr)";

	$sql = mysql_query($query);

?>