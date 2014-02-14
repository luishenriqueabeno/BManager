<?php
	require('../../../php/conn.php');

	//Recebe dados do formulário
	$userId = $_POST['userId'];
	$categoryName = $_POST['categoryName'];
	$categoryTypeId = $_POST['categoryTypeId'];
	$ano = $_POST['ano'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);
	
	//Query para verificar se a categoria já existe para a natureza selecionada e para
	//o usuário master
	$sql = mysql_query("Select 
							* 
						From 
							cashflowcategories 
						Where 
							userMaster = '$resMaster->userMaster' 
						And categoryName = '$categoryName' 
						And categoryTypeId = $categoryTypeId");

	$res = mysql_fetch_object($sql);

	//Verifica quantidade de registros
	$numRows = mysql_num_rows($sql);

	//Verifica se a quantidade de registros retornada é maior ou igual a 1
	if($numRows >= 1){
		//Caso retorne registros exibe mensagem de erro informando que a categoria já existe
		echo 2;
	} else {
		//Insere categoria
		$insert = mysql_query("Insert Into cashflowcategories Values ('', '$categoryName', $categoryTypeId, '$resMaster->userMaster', $ano)");

		//Query para carregar a lista de categorias atualizada
		$updateList = mysql_query("Select * From cashflowcategories Where userMaster = '$resMaster->userMaster' And ano = $ano");

		$rows = array();

		//Guardo todos os dados em um array
		while($res = mysql_fetch_object($updateList)){
			$rows[] = $res;
		}

		//Retorno um json com os novos dados da lista
		echo json_encode($rows);
	}
?>