<?php
	require('../../../php/conn.php');

	//Recebe dados para carregar receitas
	$userId = $_POST['userId'];
	$ano = $_POST['ano'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = 1");
	$resMaster = mysql_fetch_object($getMaster);

	//Carrega as categorias a partir do usuário master e o ano
	$list = mysql_query("Select * From cashflowcategories Where userMaster = '$resMaster->userMaster' And ano = $ano");

	$rows = array();

	//Itera a lista
	while($res = mysql_fetch_object($list)){
		//Guarda dados em um array
		$rows[] = $res;
	}

	//Retorna json com as categorias
	echo json_encode($rows);
?>