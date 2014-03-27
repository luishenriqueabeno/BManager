<?php
	require('../../../php/conn.php');

	//Suprime warnings
	error_reporting(E_ERROR | E_PARSE);

	//Recebe dados do grid
	$rowId = $_POST['rowId'];
	$month = $_POST['month'];
	$novoConteudo = $_POST['novoConteudo'];
	$userId = $_POST['userId'];
	$ano = $_POST['ano'];

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	//Trata valor para inserir no banco
	$novoConteudo = str_replace(',','.',str_replace('.','',$novoConteudo));

	//Divide o tipo de campo e o id em um array
	$text = explode('_', $rowId);

	//O id do campo é adicionado em uma variavel
	$realId = $text[1];

	//O tipo de campo é adicionado em uma variavel
	$type = $text[0];

	//Guarda o nome do mês em um array. Como o saldo possui mais de uma classe além do nome do mês,
	//é verificado se o nome do mês (clase) é maior que 3
	if(strlen($month) > 3){
		//Explode o nome da classe a partir do espaço
		$month = explode (" ", $month);

		//Pega primeira posição que contém o mês (jan, fev, mar...)
		$month = $month[0];
	}	

	//Verifica qual o tipo de campo (receita, despesa ou saldo)
	if($type == 'income'){
		//Atualiza tabela de receitas de acordo com o mês a ser editado
		switch ($month){
			case 'jan': $updateIncomeJan = mysql_query("Update `cashflowincome` Set `jan` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'fev': $updateIncomeFev = mysql_query("Update `cashflowincome` Set `fev` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'mar': $updateIncomeMar = mysql_query("Update `cashflowincome` Set `mar` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'abr': $updateIncomeAbr = mysql_query("Update `cashflowincome` Set `abr` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'mai': $updateIncomeMai = mysql_query("Update `cashflowincome` Set `mai` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'jun': $updateIncomeJun = mysql_query("Update `cashflowincome` Set `jun` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'jul': $updateIncomeJul = mysql_query("Update `cashflowincome` Set `jul` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'ago': $updateIncomeAgo = mysql_query("Update `cashflowincome` Set `ago` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'set': $updateIncomeSet = mysql_query("Update `cashflowincome` Set `set` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'out': $updateIncomeOut = mysql_query("Update `cashflowincome` Set `out` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'nov': $updateIncomeNov = mysql_query("Update `cashflowincome` Set `nov` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'dez': $updateIncomeDez = mysql_query("Update `cashflowincome` Set `dez` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
		}
	} elseif($type == 'expense') {
		//Atualiza tabela de despesas de acordo com o mês a ser editado
		switch ($month){
			case 'jan': $updateExpenseJan = mysql_query("Update `cashflowexpenses` Set `jan` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'fev': $updateExpenseFev = mysql_query("Update `cashflowexpenses` Set `fev` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'mar': $updateExpenseMar = mysql_query("Update `cashflowexpenses` Set `mar` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'abr': $updateExpenseAbr = mysql_query("Update `cashflowexpenses` Set `abr` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'mai': $updateExpenseMai = mysql_query("Update `cashflowexpenses` Set `mai` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'jun': $updateExpenseJun = mysql_query("Update `cashflowexpenses` Set `jun` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'jul': $updateExpenseJul = mysql_query("Update `cashflowexpenses` Set `jul` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'ago': $updateExpenseAgo = mysql_query("Update `cashflowexpenses` Set `ago` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'set': $updateExpenseSet = mysql_query("Update `cashflowexpenses` Set `set` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'out': $updateExpenseOut = mysql_query("Update `cashflowexpenses` Set `out` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'nov': $updateExpenseNov = mysql_query("Update `cashflowexpenses` Set `nov` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
			case 'dez': $updateExpenseDez = mysql_query("Update `cashflowexpenses` Set `dez` = ". $novoConteudo ." Where id = ". $realId ." And userMaster = '". $resMaster->userMaster ."'"); break;
		}
	}
?>