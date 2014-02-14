<?php
	require('../../../php/conn.php');

	//Recebe receitas selecionadas
	$incomes = $_POST['incomes'];	

	$arr = array();
	$i = 0;

	//Itera array recebido com as receitas
	foreach($incomes as $value){
		//É feito um tratamento para exibir ids de até dez algarismos
		//Total de receitas suportado: 9.999.999.999
		echo $arr[$i] = substr($value, 7, +10);
		$i++;
	}

	//Separa os ids por virgula
	$finalArr = implode(",",$arr);

	//Remove despesas selecionadas
	$query = mysql_query("Delete From `cashflowincome` Where id in ($finalArr)");
?>