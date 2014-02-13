<?php
	require('../../../php/conn.php');

	//Recebe id da tarefa a ser editada
	$taskId = $_POST['taskId'];
	
	//Carrega dados da tarefa selecionada para edição
	$getTaskDataQuery = mysql_query("Select * From tasks Where id = '$taskId'");

	$rows = array();

	//Itera dados e armazena em um array
	while($resData = mysql_fetch_object($getTaskDataQuery)){
		$rows[] = $resData;
	}

	//Retorna um json
	echo json_encode($rows);	
?>