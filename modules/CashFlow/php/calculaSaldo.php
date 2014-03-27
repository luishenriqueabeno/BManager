<?php
	require('../../../php/conn.php');

	//Suprime warnings
	error_reporting(E_ERROR | E_PARSE);

	//Recebe dados do formulário
	$banks = $_POST['banks'];
	$userId = $_POST['userId'];
	$ano = $_POST['ano'];

	//Trata contas selecionadas
	$newBanks = implode(',', $banks);

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	//Variavel que recebe tabela, dessa forma não é necessário modificar o DOM
	//a cada iteração
	$table = "";

	echo "OK";
