<?php
	require('../../../php/conn.php');

	//Recebe id da tarefa a ser editada
	$taskId = $_POST['taskId'];
	
	//Carrega dados da tarefa selecionada para edição
	$getTaskDataQuery = mysql_query("Select 
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
										id = ". $taskId ."
									Order By 
										YEAR( dataInicio ),
			                            MONTH( dataInicio ),
										DAY( dataInicio )
									");

	$rows = array();

	//Itera dados e armazena em um array
	while($resData = mysql_fetch_object($getTaskDataQuery)){
		$rows[] = $resData;
	}

	//Retorna um json
	echo json_encode($rows);	
?>