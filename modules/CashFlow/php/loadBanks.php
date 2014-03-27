<?php
	require('../../../php/conn.php');

	//Recebe dados para carregar contas bancárias
	$userId = $_POST['userId'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = ". $userId ."");
	$resMaster = mysql_fetch_object($getMaster);

	//Carrega as contas bancárias a partir do usuário master
	$list = mysql_query("Select * From contasbancarias Where userMaster = '". $resMaster->userMaster ."' ");

	$rows = array();

	//Itera a lista
	while($res = mysql_fetch_object($list)){
		//Guarda dados em um array
		$rows[] = $res;
	}

	//Retorna json com as contas
	echo json_encode($rows);
?>