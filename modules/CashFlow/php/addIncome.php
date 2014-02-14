<?php
	require('../../../php/conn.php');

	//Recebe dados do formulário
	$userId = $_POST['userId'];
	$incomeName = $_POST['incomeName'];
	$incomeValue = $_POST['incomeValue'];
	$category = $_POST['category'];
	$ano = $_POST['ano'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	//Trata o valor para inserir no banco
	$value = str_replace(',','.',str_replace('.','',$incomeValue));

	//Caso não haja nenhuma categoria selecionada o valor inserido é igual a '0'
	if($category == ''){
		$category = 0;
	}

	//Insere receita
	//O valor é o mesmo para todos os meses, fica a critério do usuário alterar os valores
	$incomeInsert = mysql_query("Insert Into cashflowincome Values ('', '$incomeName', $category, $userId, '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$value', '$ano', '$resMaster->userMaster')");

	//Verifico se a despesa foi inserida
	if($incomeInsert){
		//Exibe mensagem de sucesso
		echo 1;	
	} else {
		//Exibe mensagem de erro
		echo 2;
	}

?>