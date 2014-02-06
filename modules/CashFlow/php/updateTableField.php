<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$rowId = $_POST['rowId'];
	$month = $_POST['month'];
	$novoConteudo = $_POST['novoConteudo'];
	$userId = $_POST['userId'];
	$ano = $_POST['ano'];

	$novoConteudo = str_replace(',','.',str_replace('.','',$novoConteudo));

	$text = explode('_', $rowId);

	$realId = $text[1];

	$type = $text[0];

	if(strlen($month) > 3){
		$month = explode (" ", $month);
		$month = $month[0];
	}

	//echo $novoConteudo . ' - '. $type . ' - '. $realId .' - '. $month;

	if($type == 'income'){
		switch ($month){
			case 'jan': $updateIncomeJan = mysql_query("Update `cashflowincome` Set `jan` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'fev': $updateIncomeFev = mysql_query("Update `cashflowincome` Set `fev` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'mar': $updateIncomeMar = mysql_query("Update `cashflowincome` Set `mar` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'abr': $updateIncomeAbr = mysql_query("Update `cashflowincome` Set `abr` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'mai': $updateIncomeMai = mysql_query("Update `cashflowincome` Set `mai` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'jun': $updateIncomeJun = mysql_query("Update `cashflowincome` Set `jun` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'jul': $updateIncomeJul = mysql_query("Update `cashflowincome` Set `jul` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'ago': $updateIncomeAgo = mysql_query("Update `cashflowincome` Set `ago` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'set': $updateIncomeSet = mysql_query("Update `cashflowincome` Set `set` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'out': $updateIncomeOut = mysql_query("Update `cashflowincome` Set `out` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'nov': $updateIncomeNov = mysql_query("Update `cashflowincome` Set `nov` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'dez': $updateIncomeDez = mysql_query("Update `cashflowincome` Set `dez` = $novoConteudo Where id = $realId And userId = $userId"); break;
		}
	} elseif($type == 'expense') {
		switch ($month){
			case 'jan': $updateExpenseJan = mysql_query("Update `cashflowexpenses` Set `jan` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'fev': $updateExpenseFev = mysql_query("Update `cashflowexpenses` Set `fev` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'mar': $updateExpenseMar = mysql_query("Update `cashflowexpenses` Set `mar` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'abr': $updateExpenseAbr = mysql_query("Update `cashflowexpenses` Set `abr` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'mai': $updateExpenseMai = mysql_query("Update `cashflowexpenses` Set `mai` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'jun': $updateExpenseJun = mysql_query("Update `cashflowexpenses` Set `jun` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'jul': $updateExpenseJul = mysql_query("Update `cashflowexpenses` Set `jul` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'ago': $updateExpenseAgo = mysql_query("Update `cashflowexpenses` Set `ago` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'set': $updateExpenseSet = mysql_query("Update `cashflowexpenses` Set `set` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'out': $updateExpenseOut = mysql_query("Update `cashflowexpenses` Set `out` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'nov': $updateExpenseNov = mysql_query("Update `cashflowexpenses` Set `nov` = $novoConteudo Where id = $realId And userId = $userId"); break;
			case 'dez': $updateExpenseDez = mysql_query("Update `cashflowexpenses` Set `dez` = $novoConteudo Where id = $realId And userId = $userId"); break;
		}
	} else {
		$checkData = mysql_query("Select * From `cashflowsaldo` Where userId = $userId");
		$checkDataRow = mysql_num_rows($checkData);

		if($checkDataRow <= 0){
			switch ($month){
				case 'jan': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, jan, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'fev': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, fev, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'mar': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, mar, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'abr': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, abr, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'mai': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, mai, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'jun': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, jun, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'jul': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, jul, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'ago': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, ago, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'set': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, set, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'out': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, out, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'nov': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, nov, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
				case 'dez': $insertSaldo = mysql_query("Insert Into `cashflowsaldo` (id, userId, dez, ano, empresaId) Values ('', $userId, $novoConteudo, $ano, 'EmpresaX' )"); break;
			}
		} else {
			switch ($month){
				case 'jan': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `jan` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'fev': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `fev` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'mar': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `mar` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'abr': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `abr` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'mai': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `mai` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'jun': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `jun` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'jul': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `jul` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'ago': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `ago` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'set': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `set` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'out': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `out` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'nov': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `nov` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
				case 'dez': $updateSaldo = mysql_query("Update `cashflowsaldo` Set `dez` = $novoConteudo Where `userId` = $userId And `ano` = '$ano'"); break;
			}
		}		
	}
	
?>