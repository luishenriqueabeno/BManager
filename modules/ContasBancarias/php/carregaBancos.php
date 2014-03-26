<?php
	require('../../../php/conn.php');

	//Carrega todos os dados de todos os bancos
	$sqlBanks = mysql_query("Select * From bancos");

	$i = 0;
	$banks = array();

	//Guarda o resultado em um array
	while($resBanks = mysql_fetch_object($sqlBanks)){
		$banks[$i] = $resBanks;
		$i++;
	}

	//Retorna Json com o resultado
	echo json_encode($banks);

?>