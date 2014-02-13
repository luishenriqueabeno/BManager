<?php
	require('../../../php/conn.php');

	//Recebe id das tarefas
	$tasks = $_POST['tasks'];

	//Divide o id das tarefas por ','
	//Ex.: 1,2,3,4
	$arr = implode(",", $tasks);

	//Altera o status da tarefa
	$query = mysql_query("Update tasks Set taskStatus = 1 Where id in ($arr)");
?>