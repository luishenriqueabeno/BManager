<?php
	require('../../../php/conn.php');

	$userId = $_POST['userId'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	$sqlContasBancarias = mysql_query("
		Select
			*
		From
			contasbancarias
		Where
			userMaster = '". $resMaster->userMaster ."'
	");

	$rows = array();

	//Itera dados da consulta e guarda em um array
	while($res = mysql_fetch_object($sqlContasBancarias)){
		$rows[] = $res;
	}

	//Retorna um json
	echo json_encode($rows);
?>