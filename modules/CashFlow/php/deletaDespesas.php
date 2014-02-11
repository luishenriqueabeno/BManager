<?php
	require('../../../php/conn.php');

	$expenses = $_POST['expenses'];	

	$arr = array();
	$i = 0;

	foreach($expenses as $value){
		$arr[$i] = substr($value, -1);
		$i++;
	}

	$finalArr = implode(",",$arr);
	
	$query = "Delete From `cashflowexpenses` Where id in ($finalArr)";

	$sql = mysql_query($query);

?>