<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$rowId = $_POST['rowId'];
	$month = $_POST['month'];
	$novoConteudo = $_POST['novoConteudo'];
	$userId = $_POST['userId'];

	$novoConteudo = str_replace(',','.',str_replace('.','',$novoConteudo));

	$text = explode('_', $rowId);

	$realId = $text[1];

	$type = $text[0];

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
	} else {

	}
	
?>