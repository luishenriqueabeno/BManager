<?php
	require('../../../php/conn.php');

	//Recebe tarefas
	$tasks = $_POST['tasks'];

	//Divide o id das tarefas por ','
	//Ex.: 1,2,3,4
	$arr = implode(",", $tasks);
	
	//Deleta tarefas
	$query = mysql_query("Delete From tasks Where id in ($arr)");
?>