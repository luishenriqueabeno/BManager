<?php
	require('../../../php/conn.php');

	//Recebe dados da grid
	$categories = $_POST['categories'];	
	$userId = $_POST['userId'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	//Cria arrays para iterar os tipos e id
	$id = array();
	$type = array();

	$i = 0;

	//Guarda o id das categorias selecionadas em um array
	foreach($categories as $value){
		//É feito um tratamento para exibir ids de até dez algarismos
		//Total de categorias suportado: 9.999.999.999
		$id[$i] = substr($value, 9, +10);
		$i++;
	}

	//Separa os ids por virgula
	$finalIdArr = implode(",",$id);
	
	//Delete da tabela as categorias selecionadas que estejam abaixo do usuário master
	$deleteCategory = mysql_query("Delete From `cashflowcategories` Where id In ($finalIdArr) And userMaster = '$resMaster->userMaster'");

	//Verifica se existem despesas para as categorias que estão sendo removidas
	$checkForExpenses = mysql_query("Select * From cashflowexpenses Where categoryId In ($finalIdArr)");
	$rowsExpenses = mysql_num_rows($checkForExpenses);

	//Verifica se existem receitas para as categorias que estão sendo removidas
	$checkForIncomes = mysql_query("Select * From cashflowincome Where categoryId In ($finalIdArr)");
	$rowsIncomes = mysql_num_rows($checkForIncomes);

	//Verifica se existem despesas para as categorias selecionadas
	if($rowsExpenses > 0){
		//Deleta as despesas uma vez que a categoria não existe mais
		$deleteExpensesCategory = mysql_query("Delete From cashflowexpenses Where categoryId In ($finalIdArr) ");
	}

	if($rowsIncomes > 0){
		//Deleta as receitas uma vez que a categoria não existe mais
		$deleteIncomesCategory = mysql_query("Delete From cashflowincome Where categoryId In ($finalIdArr) ");
	}

?>