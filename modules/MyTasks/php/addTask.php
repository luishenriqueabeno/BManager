<?php
	require('../../../php/conn.php');

	//Recebe dados
	$taskId = $_POST['taskId'];
	$taskName = $_POST['taskName'];
	$taskDesc = $_POST['taskDesc'];
	$dataInicio = $_POST['dataInicio'];
	$dataFim = $_POST['dataFim'];
	$userId = $_POST['userId'];
	$horaInicio = $_POST['horaInicio'];
	$minutoInicio = $_POST['minutoInicio'];
	$horaFim = $_POST['horaFim'];
	$minutoFim = $_POST['minutoFim'];

	
	//Trata data para inserir no banco
	$DFm = explode("/",$dataInicio);
	$dataInicioTratada = $DFm[2].'-'.$DFm[1].'-'.$DFm[0];

	$DFm2 = explode("/",$dataFim);
	$dataFimTratada = $DFm2[2].'-'.$DFm2[1].'-'.$DFm2[0];


	//Caso a tarefa id venha preenchido, é feito um update da tarefa
	if($taskId != ''){
		//Atualiza tarefa
		$query = mysql_query("Update tasks Set taskName = '$taskName', `desc` = '$taskDesc', dataInicio = '$dataInicioTratada', dataFim = '$dataFimTratada', horaInicio = '$horaInicio', minutoInicio = '$minutoInicio', horaFim = '$horaFim', minutoFim = '$minutoFim' Where id = '$taskId'");

		//Carrega tarefas do usuário para atualizar na tabela
		$updateTable = mysql_query("Select * From tasks Where userId = $userId");

		$rows = array();

		//Itera os dados e guarda em um array
		while($res = mysql_fetch_object($updateTable)){
			$rows[] = $res;
		}

		//Retorna um json com as tarefas
		echo json_encode($rows);
	} else {
		//Insiro uma nova tarefa caso o campo id não venha preenchido
		$sql = mysql_query("Insert Into tasks Values ('', '$taskName', '$taskDesc', '$dataInicioTratada', '$dataFimTratada', '$horaInicio', '$minutoInicio', '$horaFim', '$minutoFim', $userId, 0)");

		//Carrego tarefas para atualizar na tabela
		$updateTable = mysql_query("Select 
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

		//Itera dados e guarda em um array
		while($res = mysql_fetch_object($updateTable)){
			$rows[] = $res;
		}

		//Retorna um json com as tarefas
		echo json_encode($rows);
	}
?>