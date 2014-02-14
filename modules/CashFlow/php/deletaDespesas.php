<?php
	require('../../../php/conn.php');

	//Recebe despesas selecionadas
	$expenses = $_POST['expenses'];	

	$arr = array();
	$i = 0;

	//Itera array recebido com as despesas
	foreach($expenses as $value){
		//É feito um tratamento para exibir ids de até dez algarismos
		//Total de despesas suportado: 9.999.999.999
		$arr[$i] = substr($value, 8, +10);
		$i++;
	}

	//Separa os ids por virgula
	$finalArr = implode(",",$arr);

	//Remove despesas selecionadas
	$query = mysql_query("Delete From `cashflowexpenses` Where id in ($finalArr)");
?>