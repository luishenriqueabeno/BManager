<?php
	require('../../../php/conn.php');

	//Verifica o usuário logado
	$userId = $_POST['userId'];
	
	//Retorna todas as tarefas do usuário logado e ordena por data de inicio
	$sql = mysql_query("Select 
							id,
							taskName,
							`desc`,
							CONCAT( DAY( dataInicio ) ,  '/', MONTH( dataInicio ) ,  '/', YEAR( dataInicio ) ) As dataInicio,
							CONCAT( DAY( dataFim ) ,  '/', MONTH( dataFim ) ,  '/', YEAR( dataFim ) ) As dataFim,
							horaInicio,
							minutoInicio,
							horaFim,
							minutoFim,
							userId,
							taskStatus
						From 
							tasks 
						Where 
							userId = $userId 
						Order By 
							YEAR( dataInicio ),
                            MONTH( dataInicio ),
							DAY( dataInicio )
                    	");

	$rows = array();

	//Itera dados da consulta e guarda em um array
	while($res = mysql_fetch_object($sql)){
		$rows[] = $res;
	}

	//Retorna um json
	echo json_encode($rows);
?>