<?php
	require('../../../php/conn.php');

	//Recebe contas
	$banks = $_POST['banks'];

	//Divide o id das contas por ','
	//Ex.: 1,2,3,4
	$arr = implode(",", $banks);
	
	//Deleta contas
	$query = mysql_query("Delete From contasBancarias Where id in ($arr)");
?>