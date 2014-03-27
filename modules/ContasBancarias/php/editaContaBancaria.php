<?php
	require('../../../php/conn.php');

	//Recebe id da conta bancária a ser editada
	$bankId = $_POST['bankId'];
	
	//Carrega dados da conta bancária selecionada para edição
	$getBankDataQuery = mysql_query("Select 
										*
									From 
										contasbancarias 
									Where 
										id = ". $bankId ."
									");

	$rows = array();

	//Itera dados e armazena em um array
	while($resData = mysql_fetch_object($getBankDataQuery)){
		$rows[] = $resData;
	}

	//Retorna um json
	echo json_encode($rows);	
?>